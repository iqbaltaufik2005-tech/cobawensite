<?php
header('Content-Type: application/json');
require('koneksi.php');

// Mengambil data sensor pH terbaru dari database
$sql = "SELECT * FROM sensor_ph ORDER BY id_Sensor_PH DESC LIMIT 1";
$result = mysqli_query($conn, $sql);

if ($row = mysqli_fetch_assoc($result)) {
    echo json_encode([
        'status' => 'success',
        'nilai_ph' => $row['Nilai_PH']
    ]);
} else {
    echo json_encode([
        'status' => 'empty',
        'nilai_ph' => '0.0'
    ]);
}
?>