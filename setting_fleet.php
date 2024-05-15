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


</div><!-- end row -->
</div> <!-- end container fluid -->
<footer class="text-center mb-0 py-3">
    <p class="text-muted small mb-0">Copyright &copy; <?php echo  date("Y");?> <a href="https://satriam.github.io" style="text-decoration:none;">
    <b>Satria Mulya</b></a>. All Rights Reserved</p>
</footer>
</div>
<!-- Unlock Modal -->
<div class="modal fade" id="unlockModal" tabindex="-1" aria-labelledby="unlockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="unlockModalLabel">Enter Password</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <input type="password" id="unlockPassword" class="form-control" placeholder="Enter Password">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="unlockButton">Unlock</button>
            </div>
        </div>
    </div>
</div>

<!-- Lock Popup Modal -->
<div class="modal fade" id="lockPopupModal" tabindex="-1" aria-labelledby="lockPopupModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="lockPopupModalLabel">System Locked</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <p>The system is locked. Please unlock the system to access the content.</p>
                <p>Trouble? <a href="https://wa.me/6285156145066" target="_blank">Chat Admin</a> </p>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-primary" data-bs-dismiss="modal">OK</button>
            </div>
        </div>
    </div>
</div>


<!-- Locked Content -->
<div class="container d-flex flex-column justify-content-center align-items-center min-vh-100" id="lockedMessage">
    <div class="h-1 bd-highlight"><img src="../assets/img/icon.png" width="80%" height="80%"></div>
    <div class="h-1 bd-highlight"><p class="text-muted small mb-0">Copyright &copy; <?php echo  date("Y");?> <a href="https://satriam.github.io" style="text-decoration:none;">
    <b>Satria Mulya</b></a>. All Rights Reserved</p></div>
    
  
</div>
<script src="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.js.iife.js"></script>
    <!--<script src="assets/js/jquery.slim.min.js"></script>-->
    <script src="/assets/js/popper.min.js"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    <script type="text/javascript" src="/assets/DataTables/datatables.min.js"></script>

    <!-- Bootstrap JS and Popper.js (required for Bootstrap) -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<!-- <script src="https://code.jquery.com/jquery-3.4.1.js" integrity="sha256-WpOohJOqMqqyKL9FccASB9O0KwACQJpFTUBLTYOVvVU=" crossorigin="anonymous"></script> -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/js/select2.min.js"></script>
    <!-- <script src="https://code.jquery.com/jquery-3.4.1.min.js"></script> -->
    <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/js/standalone/selectize.min.js" integrity="sha256-+C0A5Ilqmu4QcSPxrlGpaZxJ04VjsRjKu+G82kl5UJk=" crossorigin="anonymous"></script> -->
    <script type="text/javascript">
      $(document).ready(function() {
    $('#table').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'copy', 'csv', 'excel', 'pdf', 'print'
        ]
    } );
} );
$(document).ready(function() {
    $('#table_data').DataTable( {
    } );
} );
    </script>

    <script type = "text/javascript">

$(document).ready(function() {
    $(".tabell-data").DataTable( {
    } );
} );
    </script>

<script type="text/javascript">
 $(document).ready(function() {
     $(".js-example-responsive").select2();
 });
</script>


<script type="text/javascript">
document.addEventListener('DOMContentLoaded', function () {
    const unlockPasswordInput = document.getElementById('unlockPassword');
    const unlockButton = document.getElementById('unlockButton');
    const unlockModal = new bootstrap.Modal(document.getElementById('unlockModal'), {});
    const lockPopupModal = new bootstrap.Modal(document.getElementById('lockPopupModal'), {}); // Modal for lock popup
    const lockedMessage = document.getElementById('lockedMessage'); // Reference to the locked message element
    document.getElementById("unlockPassword").addEventListener("keyup", function(event) {
        if (event.key === "Enter") {
            // Trigger the action you want here, for example, clicking the unlock button
            document.getElementById("unlockButton").click();
        }
    });
    // Function to lock the system
    function lockSystem() {
        showLockedContent();
        // You can add additional logic here if needed
    }

    // Function to show locked content and hide unlocked content
    function showLockedContent() {
        unlockedContent.classList.add('d-none');
        lockedMessage.classList.remove('d-none'); // Show the locked message
    }

    // Function to hide locked content
    function hideLockedContent() {
        lockedMessage.classList.add('d-none'); // Hide the locked message
        lockedMessage.classList.remove('d-flex'); // Hide the locked message

    }

    // Function to show unlocked content and hide locked content
    function showUnlockedContent() {
        hideLockedContent();
        unlockedContent.classList.remove('d-none');
        unlockModal.hide(); // Hide the modal when the password is correct
    }

    // Function to clear input value in the modal
    function clearModalInput() {
        unlockPasswordInput.value = ''; // Clear the input value
    }

    // Function to check if the system is locked and update the UI accordingly
    function checkLockStatus() {
        const lockTime = localStorage.getItem('?hs78gjdhf9873hfjdbbc7');
        const currentTime = new Date().getTime();
        const sixHoursInMillis = 6 * 60 * 60 * 1000; // 6 hours in milliseconds

        if (lockTime && currentTime - lockTime < sixHoursInMillis) {
            showUnlockedContent();
        } else {
            lockSystem();
            lockPopupModal.show(); // Show lock popup modal after 6 hours
        }
    }

    // Check the lock status when the page loads
    checkLockStatus();

    // Event listener for the unlock button
    // unlockButton.addEventListener('click', function () {
    //     const enteredPassword = unlockPasswordInput.value;
    //     // Add your password validation logic here
    //     // For simplicity, let's assume the correct password is 'password'
    //     if (enteredPassword === 'rehandling2023!') {
    //         localStorage.setItem('lockTime', new Date().getTime());
    //         showUnlockedContent();
    //         hideLockedContent(); // Hide the locked message when unlocked
    //     } else {
    //         alert('Incorrect Password. Please try again.');
    //     }
    // });


// Event listener for the unlock button
unlockButton.addEventListener('click', function () {
    const enteredPassword = unlockPasswordInput.value;

    // Kirim data ke server untuk verifikasi
    fetch('verify_password.php', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/x-www-form-urlencoded',
        },
        body: `password=${encodeURIComponent(enteredPassword)}`,
    })
    .then(response => {
        if (!response.ok) {
            throw new Error(`HTTP error! Status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {     
            // Dapatkan informasi sistem operasi dan browser
            const os = window.navigator.platform;
            const browser = window.navigator.userAgent;

    // Introduce a delay before making the next request
    setTimeout(() => {
        // Kirim data ke server PHP menggunakan metode POST
        fetch('save_computer_info.php', {
            method: 'POST',
            headers: {
                'Content-Type': 'application/x-www-form-urlencoded',
            },
            body: `operatingSystem=${encodeURIComponent(os)}&browser=${encodeURIComponent(browser)}`,
        })
        .then(response => {
            if (!response.ok) {
                throw new Error(`HTTP error! Status: ${response.status}`);
            }
            return response.text();
        })
        .then(message => {
            console.log(message);
            // Lakukan tindakan selanjutnya setelah data disimpan
            localStorage.setItem('?hs78gjdhf9873hfjdbbc7', new Date().getTime());
            showUnlockedContent();
            hideLockedContent(); 
        })
        .catch(error => console.error('Failed to save computer info:', error.message));
    }, 1000); // Adjust the delay (in milliseconds) as needed
}
               
  else {
            alert('Gagal Masuk! ' + data.error); // Include specific error message
        }
    })
    .catch(error => console.error('Failed to verify password:', error.message));
});



    // Event listener for the "OK" button on the lock popup modal
    const lockPopupOkButton = document.querySelector('#lockPopupModal .btn-primary');
    lockPopupOkButton.addEventListener('click', function () {
        unlockModal.show(); // Show the password modal
    });

    // Event listener for the 'hidden.bs.modal' event on the unlock modal
    unlockModal._element.addEventListener('hidden.bs.modal', clearModalInput);

    // Set up a timer to check the lock status every 10 seconds
    setInterval(checkLockStatus, 60000); // Check every 10 seconds
});

</script>


<script>
    const driver = window.driver.js.driver;
    function toggleMenu() {
    var menu = document.querySelector('.menu');
    menu.style.display = (menu.style.display === 'block') ? 'none' : 'block';
}

function handleMenuItem(option) {
    
    if (option === 'Menu') {
        const driverObj = driver({
  showProgress: true,
  steps: [
    { element: '#nav', popover: { title: 'Sidebar', description: 'Bagian ini Berisi data menu yang digunakan oleh dispatcher untuk melakukan semua setting data.', side: "left", align: 'start' }},
    { element: '#dispatcher', popover: { title: 'Menu Dispatch', description: 'Menu ini digunakan untuk dispatch melakukan input data perDT melakukan dumping.', side: "right", align: 'start' }},
    { element: '#settingfleet', popover: { title: 'Menu Setting Fleet', description: 'Menu Setting Fleet digunakan untuk menginput data fleet exca yang akan beroperasi dan lokasi exca oleh dispatcher', side: "right", align: 'start' }},
    { element: '#settingdt', popover: { title: 'Menu Setting Dump Truck', description: 'Menu Setting Dump Truck digunakan untuk menginputkan data dump truck yang akan beroperasi dan dengan exca mana dump truck melakukan loading', side: "left", align: 'start' }},
    { element: '#unit', popover: { title: 'Menu Unit', description: 'Menu unit digunakan untuk menginputkan data Exca jika terdapat exca baru', side: "right", align: 'start' }},
    { element: '#jarak', popover: { title: 'Menu Jarak', description: 'Menu Jarak digunakan untuk menginputkan data Jarak Antara Loading Point dan Dumping Point.', side: "right", align: 'start' }},
    { element: '#laporan', popover: { title: 'Menu Laporan', description: 'Menu Laporan digunakan untuk melihat data laporan yang sudah diinputkan oleh dispatcher, rekap laporan akan masuk ke menu laporan di akhir shift', side: "right", align: 'start' }},
    { popover: { title: 'Selamat Bekerja!', description: 'jika ada pertanyaan, silahkan tanyakan pada admin' } }
  ]
});

driverObj.drive();
    }
}
</script>



</body>
</html>
