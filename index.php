<?php include 'template/header.php'; ?>

<div class="col-md-9 mb-2">

<?php
 $toko = mysqli_query($conn,"SELECT * FROM fleet_info ");
 if (mysqli_num_rows($toko) > 0) {
     // Data ditemukan, mengambil data
     if ($row = mysqli_fetch_assoc($toko)) {
         $Tanggal = $row['Tanggal'];
       
         $Grup = $row['Grup'];
         $Shift = $row['Shift'];

     }
 } else {
     // Tabel kosong, mengatur variabel menjadi null
     $Tanggal = null;
     $Grup = null;
     $Shift = null;
 }

 $tonase = mysqli_query($conn,"SELECT tanggal, SUM(temporary.tonase) AS Total_Tonase FROM temporary where tanggal = '$Tanggal' && Grup = '$Grup' && Shift = '$Shift';");
 
 if(mysqli_num_rows($tonase)>0){
    if ($row = mysqli_fetch_assoc($tonase)) {
        $tt = $row['Total_Tonase'];
        // var_dump($tt);die;
        
    }
 }
if (!empty($_POST['updatebs'])) {
    if (isset($_POST['lpbs']) && isset($_POST['dpbs']) && isset($_POST['tonasebs'])) {
        // Get values from the form
        $lpbs = $_POST['lpbs'];
        $dpbs = $_POST['dpbs'];
        $tonasebs = $_POST['tonasebs'];

        // Fetch individual tonase and total tonase from the database
        $sql1 = "SELECT * FROM detail_input WHERE loading_point='$lpbs' AND dumping_point='$dpbs' AND Pengukuran='beltscale' AND tanggal='$Tanggal' AND grup='$Grup' AND shift='$Shift'";
        $result1 = mysqli_query($conn, $sql1);

        $sql2 = "SELECT SUM(detail_input.tonase) AS Total_Tonase FROM detail_input WHERE loading_point='$lpbs' AND dumping_point='$dpbs' AND Pengukuran='beltscale' AND tanggal='$Tanggal' AND grup='$Grup' AND shift='$Shift'";
        $result2 = mysqli_query($conn, $sql2);

        // Check if queries were successful
        if ($result1 && $result2) {
            // Fetch total tonase
            $totalTonaseRow = mysqli_fetch_assoc($result2);
            $totalTonase = $totalTonaseRow['Total_Tonase'];

            // Calculate and update tonase for each data point
            while ($row = mysqli_fetch_assoc($result1)) {
                $id=$row['id_temporary'];
                $individualTonase = $row['tonase'];
                $updatedTonase = $individualTonase / $totalTonase * $tonasebs;
                // echo"$id = $updatedTonase";
                 $updateQuery = "UPDATE detail_input SET tonase = '$updatedTonase' WHERE id_temporary = '$id'";
                 $updateQuery2 = "UPDATE temporary SET tonase = '$updatedTonase' WHERE id_temporary = '$id'";
                mysqli_query($conn, $updateQuery);
                mysqli_query($conn, $updateQuery2);
            }

           echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>YESS!</strong> BeltScale Loading $lpbs dan dumping $dpbs Berhasil Diupdate
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            ";
        } else {
            // Handle query errors
            echo "Error in executing queries: " . mysqli_error($conn);
        }
    } else {
        // Handle the case where lpbs, dpbs, or tonasebs is not set
        echo "Error: Lpbs, dpbs, or tonasebs not set.";
    }
}

  
if(!empty($_POST['add_data'])){
    if(isset($_POST['DT']) && isset($_POST['loading']) && isset($_POST['dumping']) && isset($_POST['jarak']) && isset($_POST['jam'])&& isset($_POST['waktu'])){
        $unit = $_POST['DT'];
        $lp = $_POST['loading'];
        $dp = $_POST['dumping'];
        $jarak = $_POST['jarak'];
        $tonase = $_POST['tonase'];
        $jam = $_POST['jam'];
        $waktu = $_POST['waktu'];
        $exca = $_POST['exca'];
        $bb = $_POST['bb'];
        $ukur = $_POST['pengukuran'];
        // var_dump($waktu);die;
        $status = $_POST['status'];
        $lokasi = $_POST['lokasi'];                     

        // Periksa apakah kedua data sudah dipilih
        if (empty($unit) || empty($lp) || empty($dp)) {
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>NOOO!</strong> Harap pilih Exca dan Dump Truck terlebih dahulu.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            ";
        } else {
            // Data belum ada, lakukan penyisipan
            // $cek = mysqli_query($conn, "SELECT * FROM temporary WHERE id_setting_fleet = '$unit' AND Nama_DT = '$unit'");
            // if (mysqli_num_rows($cek) > 0) {
            //     echo "
            //     <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            //         <strong>NOOO!</strong> Data yang diinput sudah ada.
            //         <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
            //             <span aria-hidden='true'>&times;</span>
            //         </button>
            //     </div>
            //     ";
            // }else{
                mysqli_query($conn, "insert into temporary values(NULL, '$Tanggal','$Shift','$Grup', '$unit','$tonase','$lp','$dp','$jarak','$bb','$lokasi','$ukur','$status','$jam','$waktu',NULL)")
                or die(mysqli_error($conn));
                mysqli_query($conn, "insert into detail_input values(NULL, '$Tanggal','$Shift','$Grup', '$unit','$exca','$tonase','$lp','$dp','$jarak','$bb','$lokasi','$ukur','$status',NULL,'$jam','$waktu',NULL,'Belum Lengkap')")
                or die(mysqli_error($conn));
          
//                 echo "<script>";
// echo "console.log('Mengirim pesan refresh');";
// echo "window.opener.postMessage('refresh', '*');";
// echo "</script>";
                echo '<script>window.location="index.php"</script>';
                
                echo "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>YESS!</strong> WKWKWKWKWK.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                ";
            
        // }
    }
    } else {

        echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>NOOO!</strong> SERVER ERROR.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
        ";
    }
}


//simpan info
if(!empty($_POST['simpan_laporan'])){
    $cek = mysqli_query($conn, "SELECT * FROM laporan WHERE grup = '$Grup' AND shift = '$Shift' AND tanggal_shift ='$Tanggal'");
    $cek2 = mysqli_query($conn, "SELECT * FROM temporary");
    
    $tonase_awal=mysqli_query($conn,"Select sum(tonase) from detail_input where grup='$Grup'and shift='$Shift' and tanggal='$Tanggal'");
    
    $final_tonase=$tonase_awal+$tt;
    if (mysqli_num_rows($cek) > 0) {
       $update=mysqli_query($conn,"update laporan set total_tonase='$final_tonase' where grup='$Grup'and shift='$Shift' and tanggal='$Tanggal'");
       mysqli_query($conn, "DELETE FROM temporary")
            or die(mysqli_error($conn));
        echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>YESS!</strong> Berhasil update data!
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
        ";
    }else{
        if(mysqli_num_rows($cek2)>0){
            // var_dump($Tanggal);die;
            mysqli_query($conn, "insert into laporan values(NULL,'$Grup','$Shift','$tt','$Tanggal',NULL,'Belum Lengkap')")
            or die(mysqli_error($conn));
        
            mysqli_query($conn, "DELETE FROM temporary")
            or die(mysqli_error($conn));
            echo "
            <div class='alert alert-success alert-dismissible fade show' role='alert'>
                <strong>YESS!</strong> DATA BERHASIL TERSIMPAN.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            ";
        }else{
            echo "
            <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>NOO!</strong> DATA KOSONG!.
                <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                    <span aria-hidden='true'>&times;</span>
                </button>
            </div>
            ";
    }
}
}


?>
    <div class="row">

        <!-- barang -->
        <div class="col-md-12 mb-3">
            <div class="card">
                <div class="card-header bg-purple">
                    <div class="card-title text-white"><i class="fa fa-plus-square"></i> <b>Tambah Jarak</b></div>
                </div>
                <div class="card-body">
                    <form id="myForm" method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label><b>Dump Truck</b></label>
                                 <input type="text"  class="form-control" id="searchInput" placeholder="Search...">
                                <div class="form-select">
                                    <select name="DT" id="dt" class="form-control">
                                        <option disabled selected> Pilih </option>
                                      <?php
$query = mysqli_query($conn, "SELECT Nama_DT
    FROM setting_dt
    ORDER BY
      SUBSTRING(Nama_DT, 1,2),
      SUBSTRING(Nama_DT, 5),
      CAST(SUBSTRING(Nama_DT, 3, 2) AS UNSIGNED);
    ");
$separator = '=============================='; // Define your separator
$lastPrefix = ''; // Initialize a variable to keep track of the last prefix

while ($data = mysqli_fetch_array($query)) {
    $prefix = substr($data['Nama_DT'], 5);

    if ($prefix !== $lastPrefix) {
        // If the prefix changes, output the separator
        if ($lastPrefix !== '') {
            echo "<option disabled>{$separator}</option>";
        }
        $lastPrefix = $prefix;
    }
    ?>
    <option value="<?=$data['Nama_DT'];?>"><?php echo $data['Nama_DT'];?></option>
    <?php
}
?>
                                    </select>
                                </div>
                            </div>

                            <input type="hidden" id="selectedDT" name="selectedDT">
                           
                            <div class="form-group col-md-6">
                                <label><b>Nama Loading</b></label>
                                <div class="form-select">
                                <select name="loading" id="loading" class="form-control">
                                    <option disabled selected> Pilih </option>
                                </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label><b>Nama Dumping</b></label>
                                <div class="form-select">
                                <select name="dumping" id="dumping" class="form-control">
                                    <option disabled selected> Pilih </option>
                                </select>
                                </div>
                            </div>

                            <div class="form-group col-md-6">
                                <label><b>Jarak</b></label>
                                <input type="text" id="jarakk" name="jarak" class="form-control" readonly>
                            </div>
                                <input type="time"  id="jds" name="jam-dumping-sebelum" class="form-control" hidden >
                            
                            <div class="form-group col-md-6">
                                <label><b>Jam Dumping</b></label>
                                <input type="time"  id="jd" name="jam" class="form-control" >
                            </div>
                            <div class="form-group col-md-6">
                                <label><b>Cycle Time</b></label>
                                <input type="text" id="cycletime" name="waktu" class="form-control" value="0">
                            </div>
                            
                            <div class="form-group col-md-6">
                        <label><b>Pengukuran</b></label>
                            <select name="pengukuran"  id="ukur" class="form-control">
                                 <option disabled selected> Pilih </option>
                                <?php
                                $ukur = array("Timbangan", "bypass", "beltscale");
                                foreach ($ukur as $option) {
                                    
                                ?>
                                    <option value="<?= $option; ?>" <?= $selected; ?>><?php echo $option; ?></option>
                                <?php
                                }
                                ?>
                            </select>
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
        <!-- end barang -->
        
          <div class="col-md-12 mb-3">
            <div class="card">
                <!--<h3 style="text-align:center">On Progress Update BeltScale</h3>-->
                <!--<h5 style="text-align:center">please wait!</h5>-->
                <div class="card-header bg-purple">
                    <div class="card-title text-white"><i class="fa fa-plus-square"></i> <b>Update BeltScale</b></div>
                </div>
                <div class="card-body">
                    <form method="POST">
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label><b>Loading Point</b></label>
                                <div class="form-select">
                                    <select name="lpbs" id="lpbs" class="form-control">
                                        <option disabled selected> Pilih </option>
                                        <?php
                                        $query = mysqli_query($conn, "SELECT loading_point FROM `detail_input` where Pengukuran='beltscale' AND tanggal='$Tanggal' AND grup='$Grup' AND shift='$Shift' GROUP BY loading_point;");
                                        while ($data = mysqli_fetch_array($query)) {
                                            ?>
                                            <option value="<?=$data['loading_point'];?>"><?php echo $data['loading_point'];?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                             <div class="form-group col-md-6">
                                <label><b>Dumping Point</b></label>
                                <div class="form-select">
                                    <select name="dpbs" id="dpbs" class="form-control">
                                        <option disabled selected> Pilih </option>
                                      
                                    </select>
                                </div>
                            </div>
                    
                           
                            <div class="form-group col-md-6">
                                <label><b>Tonase</b></label>
                                <div class="input-group">
                                <input type="text" id="tonase" name="tonasebs" class="form-control" required>
                                <div class="input-group-append">
                                    <button  name="updatebs" value="simpan" class="btn btn-purple" type="submit">
                                    <i class="fa fa-plus mr-2"></i>Update</button>
                                </div>
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <!-- end barang -->
       
       <div class="col-md-12 mb-2">
       <div class="accordion accordion-flush" id="accordionExample">
  <div class="card">
    <div class="card-header bg-purple " id="headingOne">
      <h2 class="mb-0">
        <button class="btn text-white btn-block text-left " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
           <i class="fa fa-shopping-cart"></i> <b>Overview Mitra</b>
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <br>
        <?php 
       $Mitra = mysqli_query($conn,"SELECT DISTINCT mitra from unit_exca GROUP BY mitra;;"); 
     
        
    while ($row = mysqli_fetch_assoc($Mitra)) {
        $excaValue = $row['mitra'];
        

    ?>
    
        <!-- Exca -->
        <div class="col-md-12 mb-2">
         
            <div class="card">
                <div class="card-header bg-success">
                    <div class="card-tittle text-white">
                        <i class="fa fa-shopping-cart"></i> <b>Overview Mitra <?php echo $excaValue ?></b>
                    </div>
                </div>
                <div class="card-body">
                <table class="table table-striped table-bordered table-sm dt-responsive nowrap tabell-data" width="100%">
                        <thead class="thead-purple">
                            <tr>
                            <th>No</th>
                            <th>Exca</th>
                            <th>Ritase</th>
                            <th>Tonase</th>
                            <th>Loading Point</th>
                            <th>Dumping Point</th>
                            <th>Pengukuran</th>
                            <th>Jenis Batubara</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        $data_barang = mysqli_query($conn,"SELECT di.exca, COUNT(di.setting_dt) AS jumlah_data_dt, SUM(di.tonase) AS total_tonase, di.loading_point, di.dumping_point, di.Pengukuran,di.Jenis_BB FROM detail_input di JOIN unit_exca ue ON di.exca = ue.unit WHERE ue.mitra = '$excaValue' AND di.tanggal='$Tanggal' AND di.shift='$Shift' AND di.grup='$Grup' GROUP BY di.exca, di.loading_point, di.dumping_point,di.Pengukuran;");
                        while($d = mysqli_fetch_array($data_barang)){
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['exca']; ?></td>
                            <td><?php echo $d['jumlah_data_dt']; ?></td>
                            <td><?php echo $d['total_tonase']; ?></td>
                            <td><?php echo $d['loading_point']; ?></td>
                            <td><?php echo $d['dumping_point']; ?></td>
                            <td><?php echo $d['Pengukuran']; ?></td>
                            <td><?php echo $d['Jenis_BB']; ?></td>
                            <td>  <a class="btn btn-primary btn-xs" href="detail_dt.php?exca=<?php echo $d['exca']; ?>&loading=<?php echo $d['loading_point'];?>&dumping=<?php echo $d['dumping_point'];?>&ukur=<?php echo $d['Pengukuran'];?>">
                                        <i class="fa fa-pen fa-xs"></i>Detail</a></td>

						</tr>
                        <?php }?>
					</tbody>
                    
                </table>
                </div>
            </div>
        </div>
        

<?php }?>
      </div>
    </div>
  </div>
  </div>
<br>

<div class="accordion" id="Status">
  <div class="card">
    <div class="card-header bg-purple " id="headingTwo">
      <h2 class="mb-0">
        <button class="btn text-white btn-block text-left " type="button" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="true" aria-controls="collapseTwo">
           <i class="fa fa-shopping-cart"></i> <b>Overview Status</b>
        </button>
      </h2>
    </div>

    <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#Status">
      <div class="card-body">
         <?php 
       $Status = mysqli_query($conn,"SELECT DISTINCT Status from detail_input where tanggal='$Tanggal' AND shift='$Shift' AND grup='$Grup' GROUP BY Status;"); 
        
    while ($row = mysqli_fetch_assoc($Status)) {
        $excaValue = $row['Status'];

    ?>
    
        <!-- Exca -->
        <div class="col-md-12 mb-2">
         
            <div class="card">
                <div class="card-header bg-success">
                    <div class="card-tittle text-white">
                        <i class="fa fa-shopping-cart"></i> <b>Overview Status <?php echo $excaValue ?></b>
                    </div>
                </div>
                <div class="card-body">
                <table class="table table-striped table-bordered table-sm dt-responsive nowrap tabell-data" width="100%">
                        <thead class="thead-purple">
                            <tr>
                            <th>No</th>
                            <th>ritase</th>
                            <th>Tonase</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $no = 1;
                        $data_barang = mysqli_query($conn,"SELECT COUNT(di.Status) AS ritase, SUM(di.tonase) AS total_tonase FROM detail_input as di WHERE di.Status = '$excaValue' AND di.tanggal='$Tanggal' AND di.shift='$Shift' AND di.grup='$Grup' GROUP BY di.Status;");
                        while($d = mysqli_fetch_array($data_barang)){
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['ritase']; ?></td>
                            <td><?php echo $d['total_tonase']; ?></td>
                        </tr>
                        <?php }?>
					</tbody>
                    
                </table>
                </div>
            </div>
        </div>
        

<?php }?>
      </div>
    </div>
  </div>
  </div>
  <br>
  </div>
  
  
  
     <div class="col-md-12 mb-2">
        <div class="card">
        <div class="card-header bg-purple">
                <div class="card-tittle text-white"><i class="fa fa-table"></i> <b>Data Jarak</b></div>
            </div>

            <div class="card-body">
        
                    <div class="form-row">
                       

                        <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="tgl" name="tgl_input" value="<?php echo  $Tanggal;?>" readonly>
                        </div>

              
                        <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="grup" name="tgl_input" value="<?php echo  $Grup;?>" readonly>
                        </div>
 
        
                        <div class="form-group col-md-4">
                        <input type="text" class="form-control" id="shift"  name="tgl_input" value="<?php echo  $Shift;?>" readonly>
                        </div>
                    </div>
            </div>

            <div class="card-body">
            <table class="table table-striped table-bordered table-sm dt-responsive nowrap" id="table_data" width="100%">
                        <thead class="thead-purple">
                            <tr>
                                <th>No</th>
                                <th>DT</th>
                                <th>Nama Loading</th>
                                <th>Nama Dumping</th>
                                <th>Tonase</th>
                                <th>Jam Dumping</th>
                                <th>Pengukuran</th>
                                <!--<th>Cycle Time</th>-->
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        $data_barang = mysqli_query($conn,"select * from temporary where tanggal='$Tanggal'  order by id_temporary DESC");
                        while($d = mysqli_fetch_array($data_barang)){
                            $timestamp_diff = time() - strtotime($d['created']);
    
                            // Check if the data is more than half a day old (43200 seconds = 12 hours)
                            $is_old_data = $timestamp_diff > 43200;
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td> 
                            <td><?php echo $d['setting_dt']; ?></td> 
                            <td><?php echo $d['loading_point']; ?></td>
                            <td><?php echo $d['dumping_point']; ?></td>
                            <td><?php echo $d['tonase']; ?></td>
                            <td><?php echo $d['jam']; ?></td>
                            <td><?php echo $d['Pengukuran']; ?></td>
                            <!--<td><?php echo $d['waktu']; ?></td>-->
                            
                            <td>
                               


                                        <a class="btn btn-primary btn-xs" href="edit_index.php?id=<?php echo $d['id_temporary']; ?>">
                                        <i class="fa fa-pen fa-xs"></i> Edit</a>

                                        <a class="btn btn-danger btn-xs" href="?id=<?php echo $d['id_temporary']; ?>"
                                        onclick="javascript:return confirm('Hapus Data Jarak ?');">
                                            <i class="fa fa-trash fa-xs"></i> Hapus
                                        </a>
                                        <?php
                                    }
                                    ?>

                            </td>
						</tr>
                    
					</tbody>
                    <tfoot>
                        <tr>
                        <th colspan="5" class="text-right"><b>TOTAL TONASE :</b></th>
                        <th><b><?php echo $tt ?></b></th>
                        <th></th>
                        <th></th>
                        </tr>
                    </tfoot>
                </table>
            </div >
           <!-- Tombol "Preview" -->
             <div class="d-flex justify-content-end">
    <a href="preview.php" target=_blank>
        <button class="btn btn-warning m-2" type="button">
            <i class="fa fa-plus mr-2"></i>PREVIEW
        </button>
    </a>
    <!-- Elemen formulir "Simpan" -->
    <form method="POST">
        <button name="simpan_laporan" value="simpan" class="btn btn-purple m-2" type="submit"  onclick="javascript:return confirm('yakin simpan ?');">
            <i class="fa fa-plus mr-2"></i>SIMPAN
        </button>
    </form>
    </div>
        </div>
    </div>
    <!-- end table barang -->
    </div>
</div>



 <?php 
	include 'config.php';
	if(!empty($_GET['id'])){
		$id= $_GET['id'];
    
		$hapus_data = mysqli_query($conn, "DELETE FROM temporary WHERE id_temporary ='$id'");
		$hapus_data = mysqli_query($conn, "DELETE FROM detail_input WHERE id_temporary ='$id'");
		echo '<script>window.location="index.php"</script>';
	}

?>


<script>
   var selectElement = document.getElementById('dt');
var loadingSelect = document.getElementById('loading');
var dumpingSelect = document.getElementById('dumping');
var excas = document.getElementById('exca');
var bbs = document.getElementById('bb');
var ukurs = document.getElementById('ukur');
var statuss = document.getElementById('status');
var lokasis = document.getElementById('lokasi');
var tonaseElement = document.getElementById('tonase');

// Tambahkan event listener untuk mengidentifikasi perubahan nilai pada elemen "dt"
selectElement.addEventListener('change', function () {
    // Dapatkan nilai yang dipilih
    var selectedValue = selectElement.value;
    var encodedValue = btoa(selectedValue);

    // Kirim permintaan ke server untuk mengambil data sesuai dengan nilai yang dipilih
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_data.php?nama_dt=' + encodedValue, true);

    xhr.onload = function () {
        if (xhr.status === 200) {
            // Parsing data yang diterima dari server
            var data = JSON.parse(xhr.responseText);

            var jenisPengukuran = data[0].Pengukuran;
            // console.log(jenisPengukuran);
            var exca = data[0].Exca;
            var bb = data[0].Jenis_BB;
            var lokasi = data[0].Lokasi;
            var status = data[0].Status;
            excas.value = exca;
            bbs.value = bb;
            // ukurs.value = jenisPengukuran;
            statuss.value = status;
            lokasis.value = lokasi;
            
            // Iterate through the options and set the selected attribute
            for (var i = 0; i < ukurs.options.length; i++) {
                if (ukurs.options[i].value === jenisPengukuran) {
                    ukurs.options[i].selected = true;
                }
            }

            // Mengisi elemen "loadingSelect" dengan opsi yang diterima
            loadingSelect.innerHTML = ''; // Menghapus opsi yang sudah ada

            var defaultOption = document.createElement('option');
            defaultOption.text = 'Pilih';
            defaultOption.value = '';
            loadingSelect.appendChild(defaultOption);

            for (var i = 1; i < data.length; i++) {
                var option = document.createElement('option');
                option.text = data[i].loading;
                option.value = data[i].loading;
                loadingSelect.appendChild(option);
            }

            // Mengisi elemen "dumpingSelect" dengan opsi yang diterima
            dumpingSelect.innerHTML = ''; // Menghapus opsi yang sudah ada

            var defaultOptionDumping = document.createElement('option');
            defaultOptionDumping.text = 'Pilih Dumping';
            defaultOptionDumping.value = '';
            dumpingSelect.appendChild(defaultOptionDumping);

            for (var i = 1; i < data.length; i++) {
                var option = document.createElement('option');
                option.text = data[i].dumping;
                option.value = data[i].dumping;
                dumpingSelect.appendChild(option);

                // Select the "nama loading" and "nama dumping" based on the first item in the data array
                var selectedLoading = data[1].loading; // Assuming the data array has at least one item
                loadingSelect.value = selectedLoading;

                var selectedDumping = data[1].dumping; // Assuming the data array has at least one item
                dumpingSelect.value = selectedDumping;

                // Get and display the previous dumping time
                getJamDumpingSebelumnya();
                getJarak();
                // Get and display tonase
                getjenisTonase(jenisPengukuran)
                // getTonase();
            }
        }
    };

    xhr.send();
});



function getjenisTonase(jenisPengukuran) {
    // Enable/disable or set tonase based on jenisPengukuran
    switch (jenisPengukuran) {
        case 'Timbangan':
            // Enable the tonase input
            tonaseElement.disabled = false;
            tonaseElement.readOnly = false;
            tonaseElement.value ='';
            break;
        case 'beltscale':
            tonaseElement.readOnly = true;
               // Get and set the tonase value if needed
            var tonaseValue = getTonase(); // Replace with your logic to get tonase value
            tonaseElement.value = tonaseValue;
            break;
        case 'bypass':
            tonaseElement.readOnly = true;
               // Get and set the tonase value if needed
            var tonaseValue = getTonase(); // Replace with your logic to get tonase value
            tonaseElement.value = tonaseValue;
            break;
    }
}

// Assuming you have a function to get tonase value
function getTonase() {
    // Replace this with your logic to get tonase value
    return "DefaultTonaseValue";
}

// Your existing code to handle the change event of the 'ukur' dropdown
ukurs.addEventListener('change', function () {
    var selectedValue = ukurs.value;
    getjenisTonase(selectedValue);
});


function getTonase() {
    var namaDT = selectElement.value;

    // Kirim permintaan AJAX ke server untuk mengambil data tonase
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_tonase.php?nama_dt=' + namaDT, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var tonase = xhr.responseText;
            tonaseElement.value = tonase;
            console.log(tonase);
        }
    };

    xhr.send();
}

// Memanggil fungsi getTonase saat halaman dimuat
document.addEventListener("DOMContentLoaded", function () {
    getTonase();
});    

 function getJamDumpingSebelumnya() {
    var namaDT = selectElement.value;

    // Kirim permintaan AJAX ke server untuk mengambil data jam dumping
    var xhr = new XMLHttpRequest();
    xhr.open('GET', 'get_jam_dumping_sebelumnya.php?nama_dt=' + namaDT, true);

    xhr.onreadystatechange = function () {
        if (xhr.readyState == 4 && xhr.status == 200) {
            var jamDumpingSebelumnya = xhr.responseText;
            document.getElementById('jds').value = jamDumpingSebelumnya;

            // Panggil fungsi untuk menghitung selisih waktu saat mendapatkan jam dumping sebelumnya
            hitungSelisihWaktu(jamDumpingSebelumnya);
        }
    };

    xhr.send();
}

// Memanggil fungsi getJamDumpingSebelumnya saat halaman dimuat
document.addEventListener("DOMContentLoaded", function () {
    getJamDumpingSebelumnya();
});


 

function hitungSelisihWaktu(jamSebelumnya) {
    var jamInput = document.getElementById('jd').value;
    var selisihWaktu = '';

    if (jamSebelumnya && jamInput) {
        // Hitung selisih waktu dalam menit
        var dateJamSebelumnya = new Date('1970-01-01T' + jamSebelumnya + 'Z'); // Tambahkan 'Z' untuk menandakan UTC
        var dateJamInput = new Date('1970-01-01T' + jamInput + 'Z');

        // Jika jamInput sebelum jamSebelumnya, tambahkan 24 jam
        if (dateJamInput < dateJamSebelumnya) {
            dateJamInput.setUTCDate(dateJamInput.getUTCDate() + 1);
        }

        var selisihMillis = dateJamInput - dateJamSebelumnya;

        // Format hasil menjadi menit saja
        var selisihMenit = Math.abs(Math.floor(selisihMillis / (1000 * 60))); // Gunakan Math.abs untuk mendapatkan nilai positif

        // Tampilkan hasil pada elemen dengan id 'cycletime'
        document.getElementById('cycletime').value = selisihMenit;
    }
}

// Event listener untuk menghitung selisih waktu saat pengguna mengubah input jam
document.getElementById('jd').addEventListener("change", function () {
    var jamSebelumnya = document.getElementById('jds').value;

    // Panggil fungsi untuk menghitung selisih waktu
    hitungSelisihWaktu(jamSebelumnya);
});

function getJarak() {
        // Menggunakan nilai terbaru dari elemen "loading" dan "dumping"
        var nama_loading = loadingSelect.value;
        
                console.log(nama_loading);
        var nama_dumping = dumpingSelect.value;

        var xhr = new XMLHttpRequest();
        xhr.open('GET', 'get_test.php?nama_loading=' + nama_loading + '&nama_dumping=' + nama_dumping, true);

        xhr.onreadystatechange = function () {
            if (xhr.readyState == 4 && xhr.status == 200) {
                var jarak = xhr.responseText;
                document.getElementById('jarakk').value = jarak;
            }
        };

        xhr.send();
    }
</script>

<script> 
var tgl = document.getElementById('tgl').value;
var grup = document.getElementById('grup').value;
var shift =  document.getElementById('shift').value;
    // JavaScript to handle dynamic population of dumping points based on selected loading point
    document.getElementById('lpbs').addEventListener('change', function() {
        var loadingPoint = this.value;
 
          var formData = new FormData();
        formData.append('loadingPoint', loadingPoint);
        formData.append('tanggal', tgl);
        formData.append('grup', grup);
        formData.append('shift', shift);

        var xhr = new XMLHttpRequest();
        xhr.open('POST', 'getDumpingPoints.php', true);
       
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Update dumping points dropdown with the received data
                 var test = xhr.responseText;
                
                document.getElementById('dpbs').innerHTML = xhr.responseText;
            }
        };
       xhr.send(formData);
    });
</script>

   <script>
    // JavaScript for search functionality
    var selectElement = document.getElementById('dt');
    var originalOptions = selectElement.innerHTML; // Save the original options

    document.getElementById('searchInput').addEventListener('input', function () {
        var searchValue = this.value.toLowerCase();
        var options = selectElement.options;

        // Restore original options
        selectElement.innerHTML = originalOptions;

        for (var i = 0; i < options.length; i++) {
            var optionText = options[i].text.toLowerCase();
            var optionValue = options[i].value.toLowerCase();

            // Check if the option text or value contains the search string
            if (!optionText.includes(searchValue) && !optionValue.includes(searchValue)) {
                // Remove the option that doesn't match the search
                options[i].style.display = 'none';
            }
        }
    });
</script>





<?php include 'template/footer.php'; ?>