<?php
error_reporting(E_ALL);
ini_set('display_errors', 1);
// Ambil data dari permintaan POST
$operatingSystem = $_POST['operatingSystem'];
$browser = $_POST['browser'];
// $ipAddress = $_POST['ipAddress'];

include "config.php";
// Persiapkan dan jalankan query SQL untuk menyimpan data
$query = "INSERT INTO computer_info (id,operating_system, browser, ip_address,access_time) VALUES ('','$operatingSystem', '$browser', NULL,NULL)";
if ($conn->query($query) === TRUE) {
    echo "Informasi berhasil disimpan ke database";
} else {
    echo "Gagal menyimpan informasi ke database: " . $conn->error;
}

// Tutup koneksi ke MySQL
$conn->close();
?>
