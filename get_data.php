<?php
include "config.php";


if (isset($_GET['nama_dt'])) {
  $nama_dt = $_GET['nama_dt'];
if (base64_encode(base64_decode($nama_dt, true)) === $nama_dt && $nama_dt != null) {
  $decodedValue = base64_decode($nama_dt);
// Buat query MySQL untuk mengambil data sesuai dengan nama_dt
$query = "SELECT 
            CONCAT(Nama_loading, '') AS loading, 
            CONCAT(Nama_dumping, '') AS dumping 
          FROM setting_fleet 
          WHERE Id_setting = (
            SELECT id_setting_fleet 
            FROM setting_dt 
            WHERE nama_DT = '$decodedValue'
          ) 
          UNION 
          SELECT 
            CONCAT(Loading_pengalihan_1, '') AS loading, 
            CONCAT(Dumping_pengalihan_1, '') AS dumping 
          FROM setting_fleet 
          WHERE Id_setting = (
            SELECT id_setting_fleet 
            FROM setting_dt 
            WHERE Nama_DT = '$decodedValue'
          ) 
          UNION 
          SELECT 
            CONCAT(Loading_pengalihan_2, '') AS loading, 
            CONCAT(Dumping_pengalihan_2, '') AS dumping 
          FROM setting_fleet 
          WHERE Id_setting = (
            SELECT id_setting_fleet 
            FROM setting_dt 
            WHERE Nama_DT = '$decodedValue'
          );";
$result = mysqli_query($conn, $query);

// Buat query MySQL untuk mengambil data jenis pengukuran
$pengukuran = "SELECT setting_dt.Nama_DT, setting_fleet.Exca, setting_fleet.Jenis_BB, setting_fleet.Lokasi, setting_fleet.Pengukuran, setting_fleet.Status FROM setting_dt 
               INNER JOIN setting_fleet ON setting_dt.id_setting_fleet = setting_fleet.Id_setting 
               WHERE Nama_DT = '$decodedValue'";

$result_ukur = mysqli_query($conn, $pengukuran);

$row1 = mysqli_fetch_assoc($result_ukur);
$jenisPengukuran = $row1['Pengukuran']; // Perbaikan kunci kolom menjadi 'Pengukuran'
$exca = $row1['Exca'];
$jenis_bb = $row1['Jenis_BB'];
$lokasi = $row1['Lokasi'];
$status = $row1['Status'];

$data = array();
$data[] = $row1;


if (mysqli_num_rows($result) > 0) {
    // Tangani data yang ditemukan
    while ($row = mysqli_fetch_assoc($result)) {
        $data[] = $row;
    }
   
}

mysqli_close($conn);

// Mengirimkan data sebagai respons dalam format JSON
header('Content-Type: application/json');
echo json_encode($data);
}else{
  header("HTTP/1.1 403 Forbidden");
  echo "Access Denied";
}
}else{
  header("HTTP/1.1 403 Forbidden");
  echo "P BALAP";
}
?>
