<?php
// Koneksi ke database

include "config.php";


if (isset($_GET['nama_loading']) && isset($_GET['nama_dumping'])) {
    $nama_loading = $_GET['nama_loading'];
    $nama_dumping = $_GET['nama_dumping'];

    if (!empty($nama_loading) && !empty($nama_dumping)) {
        // Kueri SQL untuk mengambil jarak berdasarkan nama loading dan nama dumping
        $query = "SELECT jarak FROM jarak WHERE Nama_loading = '$nama_loading' AND Nama_dumping = '$nama_dumping'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            $row = mysqli_fetch_assoc($result);
            if ($row) {
                $jarak = $row['jarak'];
                echo "$jarak km";
            } 
        } else {
            echo "Kueri database gagal";
        }
    } else {
        echo "Nama loading dan nama dumping harus diisi.";
    }
} else {
    echo "Parameter nama_loading dan nama_dumping tidak ditemukan.";
}
?>
