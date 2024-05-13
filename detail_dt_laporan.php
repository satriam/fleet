<?php include 'template/header.php';?>
<?php
$exca = $_GET['exca'];
$loading=$_GET['loading'];
$dumping=$_GET['dumping'];
$grup=$_GET['grup'];
$shift=$_GET['shift'];
$tanggal=$_GET['tanggal'];
$ukur=$_GET['ukur'];


$query = mysqli_query($conn, "SELECT setting_dt, COUNT(CASE WHEN status_data = 'Belum Lengkap' THEN 1 ELSE NULL END) AS data_count,jarak,status,Jenis_BB FROM detail_input WHERE exca='$exca' AND tanggal='$tanggal' AND shift='$shift' AND grup='$grup' AND pengukuran='$ukur' GROUP BY setting_dt");

$settings = array();

while ($row = mysqli_fetch_assoc($query)) {
    $status_data = ($row['data_count'] >= 1) ? 'belum lengkap' : 'lengkap';
    $settings[] = array('setting_dt' => $row['setting_dt'], 'status_data' => $status_data);
    $jarak=$row['jarak'];
    $status=$row['status'];
    $jenis=$row['Jenis_BB'];
}
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
  <table style="width: 80%;" >
    <?php
    $firstRow = true;
    foreach ($settings as $data) {
        $setting_dt = $data['setting_dt'];
        $status_data = $data['status_data'];
        
        echo "<tr>";
        
        // Output "Dump Truck Active" only in the first row
        if ($firstRow) {
            echo "<td rowspan='" . count($settings) . "'><b>Dump Truck Active</b></td>";
            $firstRow = false;
        }
        
        echo "<td>$setting_dt</td>";
        echo "<td>:</td>";
       $badgeColor = ($status_data == 'lengkap') ? 'badge-success' : 'badge-warning';
        echo "<td><span class='badge $badgeColor'>$status_data</span></td>";
        
        echo "<td class='text-end'> <a href='update_data_dt.php?dt=$setting_dt&exca=$exca&loading=$loading&dumping=$dumping&grup=$grup&shift=$shift&tanggal=$tanggal' target='_blank'><button type='button' class='btn btn-primary'>Update</button></a></td>";
        echo "</tr>";
    }
    ?>
</table>


        </div>
        
    </div>
    </div>
    <br>
    <!-- end barang -->
    
      <!-- barang -->

            <div class="col-md-12 mb-2">
       <div class="accordion " id="accordionExample">
  <div class="card">
    <div class="card-header bg-purple " id="headingOne">
      <h2 class="mb-0">
        <button class="btn text-white btn-block text-left " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
           <i class="fa fa-shopping-cart"></i> <b>Tambah Data</b>
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
                    <form method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label><b>Dump Truck</b></label>
                                 <input type="text"  class="form-control" id="searchInput" placeholder="Search...">
                                <div class="form-select">
                                   <select name="DT" id="dt" class="form-control">
                                        <option disabled selected> Pilih </option>
                                         <?php
                                        foreach ($settings as $setting) {
                                            $setting_dt = $setting['setting_dt'];
                                            echo "<option value=\"$setting_dt\">$setting_dt</option>";
                                        }
                                        ?>
                                    </select>
                                </div>
                                </div>

                            <input type="hidden" id="selectedDT" name="selectedDT">
                           
                            <div class="form-group col-md-6">
                                <label><b>Nama Loading</b></label>
                                <div class="form-select">
                                    <input type="text" id="loading" name="loading" value="<?php echo $loading;?>" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label><b>Nama Dumping</b></label>
                                <div class="form-select">
                                    <input type="text" id="dumping" name="dumping" value="<?php echo $dumping;?>" class="form-control" readonly>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label><b>Jarak</b></label>
                                <input type="text" id="jarakk" name="jarak" class="form-control" value="<?php echo $jarak;?>" readonly>
                            </div>
                                
                            <div class="form-group col-md-6">
                                <label><b>Jam Dumping</b></label>
                                <input type="time"  id="jd" name="jam" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label><b>Cycle Time</b></label>
                                <input type="text" id="cycletime"  name="waktu" value="0" class="form-control">
                            </div>
                            
                            <div class="form-group col-md-6">
                        <label><b>Pengukuran</b></label>
                         <input type="text" id="ukur"  name="pengukuran" value="<?php echo $ukur;?>" class="form-control" readonly>
                            
                        </div>
                        
                        <div class="form-group col-md-6">
                        <label><b>Status</b></label>
                           <input type="text" name="status" value="<?php echo $status;?>" class="form-control" readonly>
                        </div>
                        <div class="form-group col-md-6">
                        <label><b>Jenis Batubara</b></label>
                            <div class="input-group">
                            <input type="text" name="jenis_bb" class="form-control"value="<?php echo $jenis;?>" readonly>
                                
                            </div>
                        </div>
                            <input type="text"  id="exca" name="exca" class="form-control" hidden>
                            <input type="text"  id="bb" name="bb" class="form-control" hidden>
                            <!--<input type="text"  id="ukur" name="pengukuran" class="form-control"hidden >-->
                            <input type="text"  id="status" name="status" class="form-control"  hidden>
                            <input type="text"  id="lokasi" name="lokasi" class="form-control"  hidden>
                           
                            <div class="form-group col-md-6">
                                <label><b>Tonase</b></label>
                                <div class="input-group">
                                <input type="text" id="tonase" name="tonase" class="form-control" required>
                                <div class="input-group-append">
                                    <button name="add_data" value="simpan" class="btn btn-purple" type="submit">
                                    <i class="fa fa-plus mr-2"></i>Tambah</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        </div>
    <br>
     <?php


// Query ke database
$query = "SELECT setting_dt, jam,shift,tonase FROM detail_input where exca='$exca' AND loading_point='$loading' AND dumping_point='$dumping' AND tanggal='$tanggal' AND shift='$shift' AND grup='$grup' ORDER BY setting_dt ASC, jam ASC";
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
//   
             
        }
    }

    // Menambah jumlah setiap jam
    $totalPerJam[$jam]++;
      $totalTonasePerJam[$jam] += $tonase;
} else if($shift=="Shift 3"){
    for ($i = 14; $i <= 22; $i++) {
        if (!isset($dataPerSettingDt[$setting_dt][$i])) {
            $dataPerSettingDt[$setting_dt][$i] = [];
            // var_dump($dataPerSettingDt[$setting_dt][$i]);
            
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

$exca = $_GET['exca'];
$loading=$_GET['loading'];
$dumping=$_GET['dumping'];
$grup=$_GET['grup'];
$shift=$_GET['shift'];
$tanggal=$_GET['tanggal'];
// Menampilkan data per setting_dt ke dalam tabel secara horizontal
foreach ($dataPerSettingDt as $setting_dt => $data) {
    echo "<tr><td>$setting_dt</td>";
    if ($shift == "Shift 2") {
        for ($i = 6; $i <= 14; $i++) {
            echo "<td>";

            if (isset($data[$i])) {
                foreach ($data[$i] as $entry) {
                    
                      $jam = $entry['jam'];
                    echo "<a href='edit_checker.php?dt=$setting_dt&exca=$exca&loading=$loading&dumping=$dumping&grup=$grup&shift=$shift&tanggal=$tanggal&jam=$jam' target='_blank'>{$entry['jam']} <strong>({$entry['tonase']})</strong></a><br>";
                }
            }

            echo "</td>";
        }

        echo "</tr>";
    } else if ($shift == "Shift 3") {
        for ($i = 14; $i <= 22; $i++) {
            echo "<td >";

            if (isset($data[$i])) {
                foreach ($data[$i] as $entry) {
                    
                    $jam = $entry['jam'];
                      echo "<a href='edit_checker.php?dt=$setting_dt&exca=$exca&loading=$loading&dumping=$dumping&grup=$grup&shift=$shift&tanggal=$tanggal&jam=$jam' target='_blank'>{$entry['jam']} <strong>({$entry['tonase']})</strong></a><br>";
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
                    $jam = $entry['jam'];
                        echo "<a href=edit_checker.php?dt=$setting_dt&exca=$exca&loading=$loading&dumping=$dumping&grup=$grup&shift=$shift&tanggal=$tanggal&jam=$jam' target='_blank'>{$entry['jam']} <strong>({$entry['tonase']})</strong></a><br>";
                }
            }

                echo "</td>";
    }

    // Loop from 0 to 6
    for ($i = 0; $i <= 6; $i++) {
       echo "<td>";

            if (isset($data[$i])) {
                foreach ($data[$i] as $entry) {
                    $jam = $entry['jam'];
                        echo "<a href='edit_checker.php?dt=$setting_dt&exca=$exca&loading=$loading&dumping=$dumping&grup=$grup&shift=$shift&tanggal=$tanggal&jam=$jam' target='_blank'>{$entry['jam']} <strong>({$entry['tonase']})</strong></a><br>";
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
