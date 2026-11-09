<?php
require('phpMQTT.php');
require('koneksi.php');

// Menggunakan Broker Publik HiveMQ
$server    = 'broker.hivemq.com'; 
$port      = 1883;
$username  = '';
$password  = '';
$client_id = 'AIIRRR_Subscriber_' . rand();

$mqtt = new Bluerhinos\phpMQTT($server, $port, $client_id);

if (!$mqtt->connect(true, NULL, $username, $password)) {
    die("Gagal terhubung ke broker MQTT.\n");
}

echo "Berhasil terhubung ke Broker MQTT HiveMQ!\n";
echo "Menunggu data sensor pH masuk ke topik 'aiirrr/sensor/ph'...\n";

// Berlangganan ke topik pH
$topics['aiirrr/sensor/ph'] = array('qos' => 0, 'function' => 'simpanDataPH');
$mqtt->subscribe($topics, 0);

// Loop nonstop untuk mendengarkan pesan dari alat IoT
while ($mqtt->proc()) { }

$mqtt->close();

function simpanDataPH($topic, $msg) {
    global $conn;
    echo "Pesan masuk [$topic]: $msg \n";
    
    $ph_val = floatval($msg);
    $sql = "INSERT INTO sensor_ph (Nilai_PH) VALUES ('$ph_val')";
    
    if (mysqli_query($conn, $sql)) {
        echo "-> Sukses: Data pH ($ph_val) tersimpan ke database db_aiirr.\n";
    } else {
        echo "-> Error Database: " . mysqli_error($conn) . "\n";
    }
}
?>