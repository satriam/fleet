<?php
include "config.php";

// Ambil data nama DT dari permintaan AJAX
$namaDT = $_GET['nama_dt'];

// Query untuk mendapatkan jam dumping sebelumnya berdasarkan nama DT
$sql = "SELECT setting_dt, MAX(jam) AS JamTerbaru FROM temporary where setting_dt='$namaDT' GROUP BY setting_dt;";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Ambil data dari hasil query
    $row = $result->fetch_assoc();
    $jamDumpingSebelumnya = $row['JamTerbaru'];

    // Keluarkan data sebagai respons AJAX
    echo $jamDumpingSebelumnya;
} else {
    // Jika tidak ada data, keluarkan pesan kosong
    echo "";
}

// Tutup koneksi ke database
$conn->close();
?>
