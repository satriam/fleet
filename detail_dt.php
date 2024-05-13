<?php include 'template/header.php';?>
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




$query = mysqli_query($conn, "SELECT DISTINCT setting_dt FROM detail_input where exca='$exca' AND tanggal='$tanggal' AND shift='$shift' AND grup='$grup'AND pengukuran='$ukur' order by setting_dt");

?>


 <div class="col-md-9 mb-2">
    <div class="row">

    <!-- overview -->
    <div class="col-md-12 mb-2">
        

        <div class="card">
        <div class="card-header bg-purple">
                <div class="card-tittle text-white"><i class="fa fa-shopping-cart"></i> <b>Overview Data</b></div>
            </div>
            <div class="card-body">
            <table style="width: 80%;">
                <tr>
                    <td><b>Dump Truck Active</b></td>
                    <td>:</td>
                    <td style="padding-left: 10px;">
                        <?php
                        while ($row = mysqli_fetch_assoc($query)) {
                        $setting = $row['setting_dt'];
                        echo "<li>$setting</li>";
                    }
                    ?>
                        </td>
                </tr>
               
            </table>

        </div>
        
    </div>
    <br>
    <!-- end barang -->
     <?php


// Query ke database
$query = "SELECT setting_dt, jam,shift,tonase FROM detail_input where exca='$exca' AND loading_point='$loading' AND dumping_point='$dumping' AND tanggal='$tanggal' AND shift='$shift' AND grup='$grup' AND pengukuran='$ukur' ORDER BY setting_dt ASC, jam ASC";
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
    $setting_dt = $row['setting_dt'];
    // var_dump($setting_dt);die;
    $tonase = $row['tonase'];

    // Menyimpan data ke dalam array per setting_dt
    $dataPerSettingDt[$setting_dt][$jam][] = ['jam' => sprintf('%02d:%02d', $jam, $menit), 'tonase' => $tonase];
// 

    
    // Memastikan bahwa array mencakup semua jam dari 00:00 hingga 23:00
    
    if($shift=="Shift 2"){
    for ($i = 6; $i <= 14; $i++) {
        if (!isset($dataPerSettingDt[$setting_dt][$i])) {
            $dataPerSettingDt[$setting_dt][$i] = [];
//   var_dump($dataPerSettingDt[$setting_dt][$i]);die;
             
        }
    }

    // Menambah jumlah setiap jam
    $totalPerJam[$jam]++;
      $totalTonasePerJam[$jam] += $tonase;
} else if($shift=="Shift 3"){
    for ($i = 14; $i <= 22; $i++) {
        if (!isset($dataPerSettingDt[$setting_dt][$i])) {
            $dataPerSettingDt[$setting_dt][$i] = [];
            
        }
       
    }

    // Menambah jumlah setiap jam
    $totalPerJam[$jam]++;
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
    $totalPerJam[$jam]++;
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
            <div class='card-header bg-success'>
                <div class='card-title text-white'>
                    <i class='fa fa-shopping-cart'></i> <b>Checker Table</b>
                </div>
            </div>
            <div class='card-body'>
                <table class='table table-striped table-bordered table-sm dt-responsive nowrap tabell-data' width='100%'>
                    <thead>
                        <tr>
                            <th>Setting_dt</th>";

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
                    echo "{$entry['jam']} <strong>({$entry['tonase']})</strong><br>";
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
                    echo "{$entry['jam']} <strong>({$entry['tonase']})</strong><br>";
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
                    echo "{$entry['jam']} <strong>({$entry['tonase']})</strong><br>";
                }
            }

                echo "</td>";
    }

    // Loop from 0 to 6
    for ($i = 0; $i <= 6; $i++) {
       echo "<td>";

            if (isset($data[$i])) {
                foreach ($data[$i] as $entry) {
                    echo "{$entry['jam']} <strong>({$entry['tonase']})</strong><br>";
                }
            }

                echo "</td>";
    }
        echo "</tr>";
        
        
     
    }
}

// Menampilkan total setiap jam pada baris paling bawah
echo "<tr><td>Total Ritase</td>";
foreach ($totalPerJam as $total) {
    echo "<td>$total Ritase</td>";
}
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
