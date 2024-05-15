<?php include 'template/header.php';?>
 <div class="col-md-9 mb-2">
    <div class="row">

    <!-- barang -->
    <div class="col-md-12 mb-3">
<?php
if (!empty($_POST['add_fleet'])) {
    $id_info = isset($_POST['id_info']) ? $_POST['id_info'] : null;

    $lokasi = isset($_POST['Lokasi']) ? $_POST['Lokasi'] : null;
    $exca = isset($_POST['Exca']) ? $_POST['Exca'] : null;
    $loading = isset($_POST['Loading']) ? $_POST['Loading'] : null;
    $lp1 = isset($_POST['Loading_pengalihan_1']) ? $_POST['Loading_pengalihan_1'] : null;
    $lp2 = isset($_POST['Loading_pengalihan_2']) ? $_POST['Loading_pengalihan_2'] : null;
    $lp3 = isset($_POST['Loading_pengalihan_3']) ? $_POST['Loading_pengalihan_3'] : null;
    $dumping = isset($_POST['Dumping']) ? $_POST['Dumping'] : null;
    $dp1 = isset($_POST['Dumping_pengalihan_1']) ? $_POST['Dumping_pengalihan_1'] : null;
    $dp2 = isset($_POST['Dumping_pengalihan_2']) ? $_POST['Dumping_pengalihan_2'] : null;
    $dp3 = isset($_POST['Dumping_pengalihan_3']) ? $_POST['Dumping_pengalihan_3'] : null;
    $bb = isset($_POST['jenis_bb']) ? $_POST['jenis_bb'] : null;
    $pengukuran = isset($_POST['Pengukuran']) ? $_POST['Pengukuran'] : null;
    $status = isset($_POST['status']) ? $_POST['status'] : null;

// var_dump($id_info);die;
    // Check if any required fields are null
    if ($id_info !== null && $lokasi !== null && $exca !== null && $loading !== null && $dumping !== null && $bb !== null && $pengukuran !== null && $status !== null) {

        // Insert into the database
        mysqli_query($conn, "INSERT INTO setting_fleet VALUES(NULL, '$id_info', '$exca', '$loading', '$lp1', '$lp2', '$lp3', '$dumping', '$dp1', '$dp2', '$dp3', '$bb', '$lokasi', '$pengukuran', '$status')")
        or die(mysqli_error($conn));

        echo '<script>window.location="setting_fleet.php"</script>';
    } else {
        // Handle the case where required fields are null
        echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>NOOO!</strong> Some required fields are empty or null. Please fill in all required fields.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>

        ";
    }
}
?>


<?php 
$toko = mysqli_query($conn, "SELECT COUNT(*) as jumlah_data, id FROM fleet_info");
$cek_temporary = mysqli_query($conn, "SELECT * FROM temporary");

$isUpdate = false;

// Mendapatkan jumlah data dari hasil query
if ($row = mysqli_fetch_assoc($toko)) {
    $jumlah_data = $row['jumlah_data'];
    $id = $row['id'];
    // Jika tabel memiliki data, maka form akan di-enable untuk update
    $isUpdate = ($jumlah_data > 0);
}



if (isset($_POST['add_info'])) {
    $Tanggal = $_POST['tgl_input'];
    $Grup = $_POST['Grup'];
    $Shift = $_POST['Shift'];
    if (mysqli_num_rows($cek_temporary) > 0) {
         echo '<script type="text/javascript">';
        echo 'alert("SIMPAN DULU DATA TEMPORARY!!.");';
        echo '</script>';
    }else{
        if ($isUpdate) {
            // Lakukan proses update jika sudah ada data dalam database
            $query = mysqli_query($conn,"UPDATE fleet_info SET Tanggal = '$Tanggal', Grup = '$Grup', Shift = '$Shift'");
            mysqli_query($conn,"DELETE from temporary");
    
        } 
        else {
            // Lakukan proses insert jika data belum ada dalam database
            $query = mysqli_query($conn,"INSERT INTO fleet_info (Tanggal, Grup, Shift) VALUES ('$Tanggal', '$Grup', '$Shift')");
            mysqli_query($conn,"DELETE from temporary");
        }
  

}
}



?>

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
                ?>

 
        
        
        <div class="card">
        <div class="card-header bg-purple">
                <div class="card-tittle text-white"><i class="fa fa-plus-square"></i> <b>Tambah Setting Fleet</b></div>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-row">
                                         
                        <div class="form-group col-md-6">
                            <label><b>Tanggal</b></label>
                            <input type="text" class="form-control" name="tgl_input" value="<?php echo  date("j F Y h:i:s");?>" readonly>
                        </div>
                        <div class="form-group col-md-6">
                            <label><b>Shift</b></label>
                            <select name="Shift" id="select" class="form-control">
                                <?php
                                $lokasiOptions = array("Shift 1", "Shift 2", "Shift 3");
                                foreach ($lokasiOptions as $option) {
                                    $selected = ($option == $Shift) ? 'selected' : '';
                                ?>
                                    <option value="<?= $option; ?>" <?= $selected; ?>><?php echo $option; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                    
                        <div class="form-group col-md-6">
                        <label><b>Grup</b></label>
                            <div class="input-group">
                            <select name="Grup" id="select" class="form-control" >
                              
                                 <?php
                                $lokasiOptions = array("Grup A", "Grup B", "Grup C","Grup D");
                                foreach ($lokasiOptions as $option) {
                                    $selected = ($option == $Grup) ? 'selected' : '';
                                ?>
                                    <option value="<?= $option; ?>" <?= $selected; ?>><?php echo $option; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                                <div class="input-group-append">
                                <button name="add_info" value="<?php echo $isUpdate ? 'update' : 'simpan'; ?>" class="btn btn-purple" type="submit" <?php echo $isUpdate ? '' : ''; ?>>
                                <i class="fa fa-<?php echo $isUpdate ? 'pencil' : 'plus'; ?> mr-2"></i><?php echo $isUpdate ? 'Update' : 'Tambah'; ?>
                            </button>
                                   
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <hr>

            <div class="card-body">
                <form method="POST">
                    <div class="form-row">
                    <input type="text" class="form-control" name="id_info" value="<?php echo  $id;?>" hidden>
                        <div class="form-group col-md-6">
                            <label><b>Lokasi</b></label>
                            <select name="Lokasi"  class="form-control js-example-responsive" required>
                            <option disabled selected> Pilih </option>
                                <option value="Banko">Banko</option>
                                <option value="TAL">TAL</option>
                                <option value="MTB">MTB</option>
                                <option value="MTBU">MTBU </option>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label><b>Exca</b></label>
                            <select name="Exca" class="form-control js-example-responsive" required>
                            <option disabled selected> Pilih </option>
                                    <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM unit_exca");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value="<?=$data['unit'];?>"><?php echo $data['unit'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label><b>Lokasi Loading</b></label>
                            <select name="Loading"  class="form-control js-example-responsive" required>
                            <option disabled selected> Pilih </option>
                                    <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM loading");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value="<?=$data['Nama_loading'];?>"><?php echo $data['Nama_loading'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label><b>Lokasi Loading Pengalihan 1</b></label>
                            <select name="Loading_pengalihan_1"  class="form-control js-example-responsive">
                            <option disabled selected> Pilih </option>
                                    <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM loading");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value="<?=$data['Nama_loading'];?>"><?php echo $data['Nama_loading'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>
                   
                        <div class="form-group col-md-6">
                            <label><b>Lokasi Loading Pengalihan 2</b></label>
                            <select name="Loading_pengalihan_2"  class="form-control js-example-responsive">
                            <option disabled selected> Pilih </option>
                                    <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM loading");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value="<?=$data['Nama_loading'];?>"><?php echo $data['Nama_loading'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label><b>Lokasi Loading Pengalihan 3</b></label>
                            <select name="Loading_pengalihan_3"  class="form-control js-example-responsive">
                            <option disabled selected> Pilih </option>
                                    <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM loading");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value="<?=$data['Nama_loading'];?>"><?php echo $data['Nama_loading'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label><b>Lokasi Dumping</b></label>
                            <select name="Dumping"  class="form-control js-example-responsive" required>
                            <option disabled selected> Pilih </option>
                                    <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM dumping");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value="<?=$data['Nama_dumping'];?>"><?php echo $data['Nama_dumping'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label><b>Lokasi Dumping Pengalihan 1</b></label>
                            <select name="Dumping_pengalihan_1"  class="form-control js-example-responsive">
                            <option disabled selected> Pilih </option>
                            <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM dumping");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value="<?=$data['Nama_dumping'];?>"><?php echo $data['Nama_dumping'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>
                   
                        <div class="form-group col-md-6">
                            <label><b>Lokasi Dumping Pengalihan 2</b></label>
                            <select id="selectdata1" name="Dumping_pengalihan_2"  class="form-control js-example-responsive">
                            <option disabled selected> Pilih </option>
                            <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM dumping");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value="<?=$data['Nama_dumping'];?>"><?php echo $data['Nama_dumping'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label><b>Lokasi Dumping Pengalihan 3</b></label>
                            <select name="Dumping_pengalihan_3" style=" border-radius: 15px;"  class="form-control js-example-responsive">
                            <option disabled selected> Pilih </option>
                            <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM dumping");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value="<?=$data['Nama_dumping'];?>"><?php echo $data['Nama_dumping'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                        <label><b>Pengukuran</b></label>
                            <select name="Pengukuran"  class="form-control" required>
                            <option disabled selected> Pilih </option>
                                <option value="bypass">Bypass</option>
                                <option value="beltscale">Belt Scale</option>
                                <option value="Timbangan">Timbangan</option>
                            </select>
                        </div>
                        <div class="form-group col-md-6">
                        <label><b>Status</b></label>
                            <select name="status" class="form-control" required>
                            <option disabled selected> Pilih </option>
                                <option value="Rehandling Antar Stock Block Barat">Rehandling Antar Stock Block Barat</option>
                                <option value="Rehandling Antar Stock Block Timur">Rehandling Antar Stock Block Timur</option>
                                <option value="Rehandling Batubara Temporary Stock Banko">Rehandling Batubara Temporary Stock Banko</option>
                                <option value="Rehandling Batubara MTB-Inpit TAL">Rehandling Batubara MTB-Inpit TAL</option>
                                <option value="Rehandling Pengiriman Konsumen">Rehandling Pengiriman Konsumen</option>
                                <option value="Housekeeping">Housekeeping</option>
                            </select>
                        </div>
                       
                    
                        <div class="form-group col-md-6">
                        <label><b>Jenis Batubara</b></label>
                            <div class="input-group">
                            <input type="text" name="jenis_bb" class="form-control" required>
                                <div class="input-group-append">
                                    <button name="add_fleet" value="simpan" class="btn btn-purple" type="submit">
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


    <!-- table barang -->
  
    <!-- end table barang -->

    </div><!-- end row col-md-9 -->
  </div>


<div class="col-md-12 mb-2">
    <div class="accordion accordion-flush" id="accordionFlushExamplee">
        <?php 
            $index = 1;
            $Mitra = mysqli_query($conn,"SELECT DISTINCT Exca, Id_setting from setting_fleet GROUP BY Exca;"); 
            while ($row = mysqli_fetch_assoc($Mitra)) {
                $id=$row['Id_setting'];
                $excaValue = $row['Exca'];
        ?>
        <div class="accordion-item">
            <div class="card">
                <div class="card-header bg-purple accordion-header"  id="flush-heading<?php echo $index; ?>">
                    <div class="card-tittle text-white">
                        
                         <button class="btn text-white btn-block text-left " type="button" data-toggle="collapse" data-target="#flush-collapse<?php echo $index; ?>" aria-expanded="false" aria-controls="flush-collapse<?php echo $index; ?>">
           <i class="fa fa-shopping-cart"></i> <b>Overview Mitra <?php echo $excaValue;?></b>
        </button>
                    </div>
                </div>

                <!-- Exca -->
                <div id="flush-collapse<?php echo $index; ?>" class="accordion-collapse collapse" aria-labelledby="flush-heading<?php echo $index; ?>" data-bs-parent="#accordionFlushExamplee">
                    <div class="card">
                        
                        <div class="card-body">
                            <?php
                            $query = mysqli_query($conn, "SELECT DISTINCT Nama_dt FROM setting_dt where id_setting_fleet='$id'order by id_setting_fleet;");

                            ?>
                            
                             <table style="width: 80%;">
                                <tr>
                                    <td><b>Dump Truck Active</b></td>
                                    <td>:</td>
                                    <td style="padding-left: 10px;">
                                        <?php
                                        while ($row = mysqli_fetch_assoc($query)) {
                                        $setting = $row['Nama_dt'];
                                        echo "<li>$setting</li>";
                                    }
                                    ?>
                                        </td>
                                </tr>
               
                         </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?php
            $index++;
            }
        ?>
        
        </div>
    </div>
  </div>
  </div>
<br>





  
 
  <div class="col-md-12 mb-2">
        <div class="card">
        <div class="card-header bg-purple">
                <div class="card-tittle text-white"><i class="fa fa-table"></i> <b>Data Setting Fleet</b></div>
            </div>
            <div class="card-body">
         
                    <div class="form-row">
                        <div class="form-group col-md-4">
                        <input type="text" class="form-control" name="tgl_input" value="<?php echo  $Tanggal;?>" readonly>
                        </div>

              
                        <div class="form-group col-md-4">
                        <input type="text" class="form-control" name="grup" value="<?php echo  $Grup;?>" readonly>
                        </div>
 
        
                        <div class="form-group col-md-4">
                        <input type="text" class="form-control" name="shift" value="<?php echo  $Shift;?>" readonly>
                        </div>
                    </div>
            </div>
            <div class="card-body">
            <table class="table table-striped table-bordered table-sm dt-responsive nowrap" id="table_data" width="100%">
                        <thead class="thead-purple">
                            <tr>
                                <th>No</th>
                                <th>Exca</th>
                                <th>Loading</th>
                                <th>Loading alih 1</th>
                                <th>Loading alih 2</th>
                                <th>Loading alih 3</th>
                                <th>Dumping</th>
                                <th>Dumping alih 1</th>
                                <th>Dumping alih 2</th>
                                <th>Dumping alih 3</th>
                                <th>Jenis Batubara</th>
                                <th>Pengukuran</th>
                                <th>Status</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        $data_barang = mysqli_query($conn,"select * from setting_fleet order by Id_setting DESC");
                        while($d = mysqli_fetch_array($data_barang)){
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['Exca']; ?></td>
                            <td><?php echo $d['Nama_loading']; ?></td>
                            <td><?php echo $d['Loading_pengalihan_1']; ?></td>
                            <td><?php echo $d['Loading_pengalihan_2']; ?></td>
                            <td><?php echo $d['Loading_pengalihan_3']; ?></td>
                            <td><?php echo $d['Nama_dumping']; ?></td>
                            <td><?php echo $d['Dumping_pengalihan_1']; ?></td>
                            <td><?php echo $d['Dumping_pengalihan_2']; ?></td>
                            <td><?php echo $d['Dumping_pengalihan_3']; ?></td>
                            <td><?php echo $d['Jenis_BB']; ?></td>
                            <td><?php echo $d['Pengukuran']; ?></td>
                            <td><?php echo $d['Status']; ?></td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="edit_setting_fleet.php?id=<?php echo $d['Id_setting']; ?>">
                                <i class="fa fa-pen fa-xs"></i> Edit</a>
                                <a class="btn btn-danger btn-xs" href="?id=<?php echo $d['Id_setting']; ?>" 
                                onclick="javascript:return confirm('Hapus Data Setting Fleet ?');">
                                <i class="fa fa-trash fa-xs"></i> Hapus</a>
                            </td>
						</tr>
                        <?php }?>
					</tbody>
                </table>
            </div>
        </div>
    </div>
  <?php 
	include 'config.php';
	if(!empty($_GET['id'])){
		$id= $_GET['id'];
		$hapus_data = mysqli_query($conn, "DELETE FROM setting_fleet WHERE Id_setting ='$id'");
		echo '<script>window.location="setting_fleet.php"</script>';
	}

?>