<!-- By : SATRIA MULYA ADIWARDANA -->
<!-- HAK CIPTA BOSKU -->
<?php
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dispatch Mining Fleet</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="favicon.ico">
    <link rel="icon" href="icon.ico" type="image/ico">
  <link href="assets/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css"/>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css"/>

  
 
 
  <style>
      .btn-group-xs > .btn, .btn-xs {
  padding: .25rem .4rem;
  font-size: .875rem;
  line-height: .5;
  border-radius: .2rem;
}
.card{
  border: none;
  border-radius: 15px;
  box-shadow: 0 6px 20px rgb(17 26 104 / 10%);
}
.card-header{
  border-radius: 15px 15px 0px 0px !important;
}
.form-control{
  border-radius: 15px;
}
.btn{
  border-radius: 15px;
}
button.buttons-html5{
  padding: .25rem .4rem !important;
  font-size: .875rem !important;
  line-height: .5 !important;
}

body {
  margin: 0;
  font-family: Arial, sans-serif;
}


  </style>
</head>
<body>
<div class="bg-purple text-center py-2 shadow-sm sticky-top d-none d-md-block">
<a class="navbar-brand text-white" href="https://satriam.github.io" target=_blank><i class="fa fa-truck mr-1"> REHANDLING BUKIT ASAM</i><b>
  </b></a>
</div>
<?php
$exca = $_GET['exca'];
$loading=$_GET['loading'];
$dumping=$_GET['dumping'];
$ukur=$_GET['ukur'];

$result = mysqli_query($conn, "SELECT * FROM fleet_info");

while($data = mysqli_fetch_array($result))
{
    $shift = $data['Shift'];
    $grup = $data['Grup'];
    $tanggal = $data['Tanggal'];

}




$query = mysqli_query($conn, "SELECT DISTINCT exca FROM detail_input where tanggal='$tanggal' AND shift='$shift' AND grup='$grup'order by exca");

?>


 <div class="col-md-12 mb-2">
    <div class="row">

    <!-- overview -->
    <div class="col-md-12 mb-2">
        

        <div class="card">
        
        
    </div>
    <br>
    <!-- end barang -->
     <?php


// Query ke database
$query = "SELECT exca,DATE_FORMAT(jam, '%H:00') AS jam,SUM(tonase) AS tonase  FROM detail_input where tanggal='$tanggal' AND shift='$shift' AND grup='$grup'  GROUP BY exca, DATE_FORMAT(jam, '%H'),shift 
order by exca asc ";

$result = $conn->query($query);


// Inisialisasi array untuk menyimpan data per setting_dt
$dataPerSettingDt = [];


// Inisialisasi array untuk menyimpan total jumlah setiap jam
  if($shift=="Shift 2"){
$totalPerJam = array_fill_keys(range(6, 14), 0);
$totalTonasePerJam = array_fill_keys(range(6, 14), 0);
}else if($shift=="Shift 3"){
   $totalPerJam = array_fill_keys(range(14, 22), 0); 
  $totalTonasePerJam = array_fill_keys(range(14, 22), 0); 
}else if($shift=="Shift 1"){
  $keys = array_merge(range(22, 23), range(0, 6));
$totalPerJam = array_fill_keys($keys, 0);
$totalTonasePerJam = array_fill_keys($keys, 0);
}
// Menampilkan hasil query dalam bentuk tabel
while ($row = $result->fetch_assoc()) {
    $jam = (int)substr($row['jam'], 0, 2); // Mengambil jam dari format jam (HH:MM:SS)
    $menit = (int)substr($row['jam'], 3, 2); // Mengambil menit dari format jam (HH:MM:SS)
    $exca = $row['exca'];
    // var_dump($setting_dt);die;
    $tonase = $row['tonase'];
   

    // Menyimpan data ke dalam array per setting_dt
    $dataPerSettingDt[$exca][$jam][] = ['jam' => sprintf('%02d:%02d', $jam, $menit), 'tonase' => $tonase];
    
    // var_dump( $dataPerSettingDt[$exca][$jam][0]);die;
// 

    
    // Memastikan bahwa array mencakup semua jam dari 00:00 hingga 23:00
    
    if($shift=="Shift 2"){
    for ($i = 6; $i <= 14; $i++) {
        if (!isset($dataPerSettingDt[$exca][$i])) {
            $dataPerSettingDt[$exca][$i] = [];
//   var_dump($dataPerSettingDt[$setting_dt][$i]);die;
             
        }
    }

    // Menambah jumlah setiap jam
   
      $totalTonasePerJam[$jam] += $tonase;
} else if($shift=="Shift 3"){
    for ($i = 14; $i <= 22; $i++) {
        if (!isset($dataPerSettingDt[$exca][$i])) {
            $dataPerSettingDt[$exca][$i] = [];
            
        }
       
    }

    // Menambah jumlah setiap jam
    
      $totalTonasePerJam[$jam] += $tonase;
}else if ($shift == "Shift 1") {
   

    // Adjusting the data for hours 22 and 23
    for ($i = 22; $i <= 23; $i++) {
        if (!isset($dataPerSettingDt[$setting_dt][$i])) {
            $dataPerSettingDt[$setting_dt][$i] = [];
        }
    }

    // Adjusting the data for hours 0 to 6
    for ($i = 0; $i <= 6; $i++) {
        if (!isset($dataPerSettingDt[$setting_dt][$i])) {
            $dataPerSettingDt[$setting_dt][$i] = [];
        }
    }

    // Adjusting the total for the specific hour
 
    $totalTonasePerJam[$jam] += $tonase;
}

}

// Menutup koneksi database
$conn->close();

// Membuat tabel HTML

echo "

<div class='row'>
    <div class='col-md-12 mb-2'>
        <div class='card'>
            
            <div class='card-body'>
                <table class='table table-striped table-bordered table-sm dt-responsive nowrap ' width='100%'>
                    <thead>
                        <tr>
                            <th>Exca</th>";

// Menampilkan header jam
if ($shift == "Shift 2") {
    for ($i = 6; $i <= 14; $i++) {
        echo "<th>$i:00</th>";
    }
} else if ($shift == "Shift 3") {
    for ($i = 14; $i <= 22; $i++) {
        echo "<th>$i:00</th>";
    }
}else if ($shift == "Shift 1") {
    // Loop from 22 to 23
    for ($i = 22; $i <= 23; $i++) {
        $hour = ($i < 10) ? "0$i" : "$i";
        echo "<th>$hour:00</th>";
    }

    // Loop from 0 to 6
    for ($i = 0; $i <= 6; $i++) {
        $hour = ($i < 10) ? "0$i" : "$i";
        echo "<th>$hour:00</th>";
    }
}

echo "
                        </tr>
                    </thead>
                    <tbody>";

// Menampilkan data per setting_dt ke dalam tabel secara horizontal
foreach ($dataPerSettingDt as $setting_dt => $data) {
    echo "<tr><td>$setting_dt</td>";
    if ($shift == "Shift 2") {
       for ($i = 6; $i <= 14; $i++) {
    echo "<td>";

    if (isset($data[$i])) {
        foreach ($data[$i] as $entry) {
            $tonase = $entry['tonase'];
             $style = ($tonase < 250) ? 'background-color: red; color: white;' : '';
             echo "<div style='$style'>";
            echo $tonase;
            echo "</div>";
        }
    }

    echo "</td>";
}

        echo "</tr>";
    } else if ($shift == "Shift 3") {
        for ($i = 14; $i <= 22; $i++) {
    echo "<td>";

    if (isset($data[$i])) {
        foreach ($data[$i] as $entry) {
             $tonase = $entry['tonase'];
            $style = ($tonase < 250) ? 'background-color: red; color: white;' : '';
             echo "<div style='$style'>";
            echo $tonase;
            echo "</div>";
        }
    }

    echo "</td>";
}

        echo "</tr>";
    } else if ($shift == "Shift 1") {
           for ($i = 22; $i <= 23; $i++) {
    echo "<td>";

    if (isset($data[$i])) {
        foreach ($data[$i] as $entry) {
            $tonase = $entry['tonase'];
           $style = ($tonase < 250) ? 'background-color: red; color: white;' : '';
             echo "<div style='$style'>";
            echo $tonase;
            echo "</div>";
        }
    }

    echo "</td>";
}

    // Loop from 0 to 6
    for ($i = 0; $i <= 6; $i++) {
    echo "<td>";

    if (isset($data[$i])) {
        foreach ($data[$i] as $entry) {
             $tonase = $entry['tonase'];
              $style = ($tonase < 250) ? 'background-color: red; color: white;' : '';
             echo "<div style='$style'>";
            echo $tonase;
            echo "</div>";
        }
    }

    echo "</td>";
}
        echo "</tr>";
    }
}

// Menampilkan total setiap jam pada baris paling bawah

echo "</tr>";
echo "<tr><td>Total Tonase</td>";
foreach ( $totalTonasePerJam as $total2) {
    echo "<td>$total2 Ton</td>";
}
echo "</tr>";



echo "
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>";
?>
    
    
   


<?php include 'template/footer.php';?>
