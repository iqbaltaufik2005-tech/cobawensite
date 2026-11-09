<?php
namespace Bluerhinos;

class phpMQTT {
    private $broker;
    private $port;
    private $clientId;
    private $conn;
    private $debug = false;
    private $keepalive = 10;
    private $lastSent = 0;
    private $metrics = array('publishes' => 0, 'data_received' => 0);
    public $topics = array();

    function __construct($broker, $port, $clientId) {
        $this->broker = $broker;
        $this->port = $port;
        $this->clientId = $clientId;
    }

    public function connect($clean = true, $will = NULL, $username = NULL, $password = NULL) {
        $address = "tcp://{$this->broker}:{$this->port}";
        $this->conn = stream_socket_client($address, $errno, $errstr, 60, STREAM_CLIENT_CONNECT);
        if (!$this->conn) {
            if ($this->debug) echo "Connection failed: $errno ($errstr)\n";
            return false;
        }
        stream_set_timeout($this->conn, 5);
        
        $header = chr(0x10);
        $byte = 0x00;
        $varHeader = chr(0x00) . chr(0x06) . "MQIsdp" . chr(0x03) . chr(0x02);
        if ($username) $byte += 0x80;
        if ($password) $byte += 0x40;
        if ($clean) $byte += 0x02;
        
        $varHeader .= chr($byte) . chr($this->keepalive >> 8) . chr($this->keepalive & 0xFF);
        $payload = chr(0x00) . chr(strlen($this->clientId)) . $this->clientId;
        
        if ($will) {
            $varHeader[7] = chr(ord($varHeader[7]) | 0x04);
            if ($will['retain']) $varHeader[7] = chr(ord($varHeader[7]) | 0x20);
            $varHeader[7] = chr(ord($varHeader[7]) | (($will['qos'] & 0x03) << 3));
            $payload .= chr(0x00) . chr(strlen($will['topic'])) . $will['topic'];
            $payload .= chr(0x00) . chr(strlen($will['content'])) . $will['content'];
        }
        if ($username) $payload .= chr(0x00) . chr(strlen($username)) . $username;
        if ($password) $payload .= chr(0x00) . chr(strlen($password)) . $password;
        
        $header .= $this->writeLength(strlen($varHeader) + strlen($payload));
        fwrite($this->conn, $header . $varHeader . $payload);
        
        $response = fread($this->conn, 4);
        if (strlen($response) == 4 && ord($response[3]) == 0) {
            return true;
        }
        return false;
    }

    public function subscribe($topics, $qos = 0) {
        $packet = chr(0x82) . chr(0);
        $varHeader = chr(0x00) . chr(0x01); // Message ID
        $payload = '';
        foreach ($topics as $key => $value) {
            $payload .= chr(0x00) . chr(strlen($key)) . $key . chr($value['qos']);
            $this->topics[$key] = $value;
        }
        $packet .= $this->writeLength(strlen($varHeader) + strlen($payload));
        fwrite($this->conn, $packet . $varHeader . $payload);
    }

    public function proc() {
        if (feof($this->conn)) {
            if ($this->debug) echo "Connection lost\n";
            fclose($this->conn);
            return false;
        }
        
        $byte = fgetc($this->conn);
        if ($byte === false) return true;
        
        $cmd = (ord($byte) & 0xF0);
        $multiplier = 1;
        $value = 0;
        do {
            $digit = fgetc($this->conn);
            if ($digit === false) break;
            $value += (ord($digit) & 127) * $multiplier;
            $multiplier *= 128;
        } while ((ord($digit) & 128) != 0);
        
        if ($cmd == 0x30) { // PUBLISH
            $len = ord(fgetc($this->conn)) * 256 + ord(fgetc($this->conn));
            $topic = fread($this->conn, $len);
            $msg = fread($this->conn, $value - $len - 2);
            
            foreach ($this->topics as $key => $target) {
                if ($this->matchTopic($key, $topic)) {
                    call_user_func($target['function'], $topic, $msg);
                }
            }
        }
        return true;
    }

    private function matchTopic($filter, $topic) {
        $filterArray = explode('/', $filter);
        $topicArray = explode('/', $topic);
        for ($i = 0; $i < count($filterArray); $i++) {
            if ($filterArray[$i] == '#') return true;
            if (!isset($topicArray[$i])) return false;
            if ($filterArray[$i] != '+' && $filterArray[$i] != $topicArray[$i]) return false;
        }
        return count($filterArray) == count($topicArray);
    }

    private function writeLength($len) {
        $string = '';
        do {
            $digit = $len % 128;
            $len = $len >> 7;
            if ($len > 0) $digit |= 128;
            $string .= chr($digit);
        } while ($len > 0);
        return $string;
    }

    public function close() {
        fclose($this->conn);
    }
}