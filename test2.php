<?php
include ('template/header.php');
include('config.php');

// Query ke database
$query = "SELECT setting_dt, jam,shift FROM detail_input where exca='Exca 3010-19 PAB' AND loading_point='Ts Merbau' AND dumping_point='DH 5' AND tanggal='6 December 2023 07:08:36' AND shift='Shift 2' AND grup='Grup D' ORDER BY setting_dt ASC, jam ASC";
$result = $conn->query($query);
 if (mysqli_num_rows($result) > 0) {
     // Data ditemukan, mengambil data
     if ($roww = mysqli_fetch_assoc($result)) {
         $shift = $roww['shift'];

     }
 }
 
// Inisialisasi array untuk menyimpan data per setting_dt
$dataPerSettingDt = [];

// Inisialisasi array untuk menyimpan total jumlah setiap jam
  if($shift=="Shift 2"){
$totalPerJam = array_fill_keys(range(7, 15), 0);
}else if($shift=="Shift 3"){
   $totalPerJam = array_fill_keys(range(15, 23), 0); 
}else if($shift=="Shift 1"){
    $totalPerJam = array_fill_keys(range(23, 7), 0);
}
// Menampilkan hasil query dalam bentuk tabel
while ($row = $result->fetch_assoc()) {
    $jam = (int)substr($row['jam'], 0, 2); // Mengambil jam dari format jam (HH:MM:SS)
    $menit = (int)substr($row['jam'], 3, 2); // Mengambil menit dari format jam (HH:MM:SS)
    $setting_dt = $row['setting_dt'];

    // Menyimpan data ke dalam array per setting_dt
    $dataPerSettingDt[$setting_dt][$jam][] = sprintf('%02d:%02d', $jam, $menit);

    
    // Memastikan bahwa array mencakup semua jam dari 00:00 hingga 23:00
    
    if($shift=="Shift 2"){
    for ($i = 7; $i <= 15; $i++) {
        if (!isset($dataPerSettingDt[$setting_dt][$i])) {
            $dataPerSettingDt[$setting_dt][$i] = [];
        }
    }

    // Menambah jumlah setiap jam
    $totalPerJam[$jam]++;
} else if($shift=="Shift 3"){
    for ($i = 15; $i <= 23; $i++) {
        if (!isset($dataPerSettingDt[$setting_dt][$i])) {
            $dataPerSettingDt[$setting_dt][$i] = [];
        }
    }

    // Menambah jumlah setiap jam
    $totalPerJam[$jam]++;
}else  if($shift=="Shift 1"){
    for ($i = 23; $i <= 7; $i++) {
        if (!isset($dataPerSettingDt[$setting_dt][$i])) {
            $dataPerSettingDt[$setting_dt][$i] = [];
        }
    }

    // Menambah jumlah setiap jam
    $totalPerJam[$jam]++;
}
}

// Menutup koneksi database
$conn->close();

// Membuat tabel HTML

echo "
<div class='col-md-9 mb-2'>
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
    for ($i = 7; $i <= 15; $i++) {
        echo "<th>$i:00</th>";
    }
} else if ($shift == "Shift 3") {
    for ($i = 15; $i <= 23; $i++) {
        echo "<th>$i:00</th>";
    }
} else if ($shift == "Shift 1") {
    for ($i = 23; $i <= 7; $i++) {
        echo "<th>$i:00</th>";
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
        for ($i = 7; $i <= 15; $i++) {
            echo "<td>";

            // Menampilkan data dalam satu sel
            if (isset($data[$i])) {
                echo implode(', ', $data[$i]);
            }

            echo "</td>";
        }

        echo "</tr>";
    } else if ($shift == "Shift 3") {
        for ($i = 15; $i <= 23; $i++) {
            echo "<td>";

            // Menampilkan data dalam satu sel
            if (isset($data[$i])) {
                echo implode(', ', $data[$i]);
            }

            echo "</td>";
        }

        echo "</tr>";
    } else if ($shift == "Shift 1") {
        for ($i = 23; $i <= 7; $i++) {
            echo "<td>";

            // Menampilkan data dalam satu sel
            if (isset($data[$i])) {
                echo implode(', ', $data[$i]);
            }

            echo "</td>";
        }

        echo "</tr>";
    }
}

// Menampilkan total setiap jam pada baris paling bawah
echo "<tr><td>Total</td>";
foreach ($totalPerJam as $total) {
    echo "<td>$total</td>";
}
echo "</tr>";

echo "
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    </ div>
</div>";
?>
