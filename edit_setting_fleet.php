<?php include 'template/header.php';?>

  <div class="col-md-9 mb-2">
    <div class="row">

    <!-- barang -->
    <div class="col-md-12 mb-2">
        
<?php
include "config.php";
if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $exca = $_POST['Exca'];
    $loading = $_POST['Loading'];
    $lp1 = $_POST['Loading_pengalihan_1'];
    $lp2 = $_POST['Loading_pengalihan_2'];
    $lp3 = $_POST['Loading_pengalihan_3'];
    $dumping = $_POST['Dumping'];
    $dp1 = $_POST['Dumping_pengalihan_1'];
    $dp2 = $_POST['Dumping_pengalihan_2'];
    $dp3 = $_POST['Dumping_pengalihan_3'];
    $bb = $_POST['jenis_bb'];
    $ukur = $_POST['Pengukuran'];
    $status=$_POST['status'];
    $result = mysqli_query($conn, "UPDATE setting_fleet SET Exca='$exca',Nama_loading='$loading',Loading_pengalihan_1='$lp1',Loading_pengalihan_2='$lp2',Loading_pengalihan_3='$lp3',
    Nama_dumping='$dumping',Dumping_pengalihan_1='$dp1',Dumping_pengalihan_2='$dp2' ,Dumping_pengalihan_3='$dp3',Jenis_BB='$bb',Pengukuran='$ukur',status='$status' WHERE Id_setting ='$id'");
    if(!$result){
        echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
  <strong>NOOO!</strong> data gagal di update.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>
</div>
        ";
        } else{
        echo "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
            <strong>YESSS!</strong> Data berhasil diupdate.
            <span id='countdown'>3</span> detik
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
        <script>
            var countdown = 3; // Waktu hitung mundur dalam detik
            var countdownElement = document.getElementById('countdown');
    
            function updateCountdown() {
                countdown--;
                countdownElement.textContent = countdown;
    
                if (countdown <= 0) {
                    window.location.href = 'setting_fleet.php'; // Alamat tujuan pengalihan
                } else {
                    setTimeout(updateCountdown, 1000); // Perbarui setiap 1 detik
                }
            }
    
            setTimeout(updateCountdown, 1000); // Memulai hitung mundur
        </script>
        ";
        }
}
?>
<?php
$id = $_GET['id'];
// var_dump($id);die;
$result = mysqli_query($conn, "SELECT * FROM setting_fleet WHERE Id_setting=$id");
// var_dump($result);die;
while($data = mysqli_fetch_array($result))
{
    $idb = $data['Id_setting'];
    $lokasi = $data['Lokasi'];
    $exca = $data['Exca'];
    $loading = $data['Nama_loading'];
    $lp1 = $data['Loading_pengalihan_1'];
    $lp2 = $data['Loading_pengalihan_2'];
    $lp3 = $data['Loading_pengalihan_3'];
    $dumping = $data['Nama_dumping'];
    $dp1 = $data['Dumping_pengalihan_1'];
    $dp2 = $data['Dumping_pengalihan_1'];
    $dp3 = $data['Dumping_pengalihan_1'];
    $bb = $data['Jenis_BB'];
    $ukuran = $data['Pengukuran'];
    $status = $data['Status'];
}
?>
        <div class="card">
        <div class="card-header bg-purple">
                <div class="card-tittle text-white"><i class="fa fa-shopping-cart"></i> <b>Edit Unit</b></div>
            </div>
            <div class="card-body">
            
            <div class="card-body">
                <form method="POST">
                    <div class="form-row">
                    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                    <div class="form-group col-md-6">
                            <label><b>Lokasi</b></label>
                            <select name="Lokasi" class="form-control">
                                <?php
                                $lokasiOptions = array("Banko", "TAL", "MTB", "MTBU");
                                foreach ($lokasiOptions as $option) {
                                    $selected = ($option == $lokasi) ? 'selected' : '';
                                ?>
                                    <option value="<?= $option; ?>" <?= $selected; ?>><?php echo $option; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label><b>Exca</b></label>
                            <select name="Exca"  class="form-control">
                            <option disabled selected> Pilih </option>
                                    <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM unit_exca");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $selected = ($data['unit'] == $exca) ? 'selected' : '';
                                    ?>
                                    <option value="<?=$data['unit'];?>"<?= $selected; ?>><?php echo $data['unit'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label><b>Lokasi Loading</b></label>
                            <select name="Loading"  class="form-control">
                            <option disabled selected> Pilih </option>
                                    <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM loading");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $selected = ($data['Nama_loading'] == $loading) ? 'selected' : '';
                                    ?>
                                    <option value="<?=$data['Nama_loading'];?>"<?= $selected; ?>><?php echo $data['Nama_loading'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label><b>Lokasi Loading Pengalihan 1</b></label>
                            <select name="Loading_pengalihan_1"  class="form-control">
                            <option disabled selected> Pilih </option>
                                    <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM loading");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $selected = ($data['Nama_loading'] == $lp1) ? 'selected' : '';
                                    ?>
                                    <option value="<?=$data['Nama_loading'];?>"<?= $selected; ?>><?php echo $data['Nama_loading'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>
                   
                        <div class="form-group col-md-6">
                            <label><b>Lokasi Loading Pengalihan 2</b></label>
                            <select name="Loading_pengalihan_2"  class="form-control">
                            <option disabled selected> Pilih </option>
                                    <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM loading");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $selected = ($data['Nama_loading'] == $lp2) ? 'selected' : '';
                                    ?>
                                    <option value="<?=$data['Nama_loading'];?>"<?= $selected; ?>><?php echo $data['Nama_loading'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label><b>Lokasi Loading Pengalihan 3</b></label>
                            <select name="Loading_pengalihan_3"  class="form-control">
                            <option disabled selected> Pilih </option>
                                    <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM loading");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $selected = ($data['Nama_loading'] == $lp3) ? 'selected' : '';
                                    ?>
                                    <option value="<?=$data['Nama_loading'];?>"<?= $selected; ?>><?php echo $data['Nama_loading'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label><b>Lokasi Dumping</b></label>
                            <select name="Dumping" class="form-control">
                            <option disabled selected> Pilih </option>
                                    <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM dumping");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $selected = ($data['Nama_dumping'] == $dumping) ? 'selected' : '';
                                    ?>
                                    <option value="<?=$data['Nama_dumping'];?>" <?= $selected; ?>><?php echo $data['Nama_dumping'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label><b>Lokasi Dumping Pengalihan 1</b></label>
                            <select name="Dumping_pengalihan_1" class="form-control">
                            <option disabled selected> Pilih </option>
                            <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM dumping");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $selected = ($data['Nama_dumping'] == $dp1) ? 'selected' : '';
                                    ?>
                                    <option value="<?=$data['Nama_dumping'];?>"<?= $selected; ?>><?php echo $data['Nama_dumping'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>
                   
                        <div class="form-group col-md-6">
                            <label><b>Lokasi Dumping Pengalihan 2</b></label>
                            <select name="Dumping_pengalihan_2" class="form-control">
                            <option disabled selected> Pilih </option>
                            <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM dumping");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $selected = ($data['Nama_dumping'] == $dp2) ? 'selected' : '';
                                    ?>
                                    <option value="<?=$data['Nama_dumping'];?>"<?= $selected; ?>><?php echo $data['Nama_dumping'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                            <label><b>Lokasi Dumping Pengalihan 3</b></label>
                            <select name="Dumping_pengalihan_3"  class="form-control">
                            <option disabled selected> Pilih </option>
                            <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM dumping");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $selected = ($data['Nama_dumping'] == $dp3) ? 'selected' : '';
                                    ?>
                                    <option value="<?=$data['Nama_dumping'];?>"<?= $selected; ?>><?php echo $data['Nama_dumping'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                        <label><b>Pengukuran</b></label>
                            <select name="Pengukuran" class="form-control" required>
                                <?php
                                $ukur = array("Timbangan", "bypass", "beltscale");
                                foreach ($ukur as $option) {
                                    
                                    $selected = ($option == $ukuran) ? 'selected' : '';
                                ?>
                                    <option value="<?= $option; ?>" <?= $selected; ?>><?php echo $option; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        
                        
                         <div class="form-group col-md-6">
                        <label><b>Status</b></label>
                            <select name="status" class="form-control" required>
                            <option disabled selected> Pilih </option>
                             <?php
                                $statuss = array("Rehandling Antar Stock Block Barat", "Rehandling Antar Stock Block Timur","Rehandling Batubara Temporary Stock Banko","Rehandling Batubara MTB-Inpit TAL","Rehandling Pengiriman Konsumen","Housekeeping");
                                
                                foreach ($statuss as $option) {
                                    
                                    $selected = ($option == $status) ? 'selected' : '';
                                ?>
                                    <option value="<?= $option; ?>" <?= $selected; ?>><?php echo $option; ?></option>
                                <?php
                                }
                                ?>
                            </select>
                        </div>
                        
                        
                        
                        
                        
                        
                        
                    
                        <div class="form-group col-md-6">
                        <label><b>Jenis Batubara</b></label>
                            <div class="input-group">
                            <input type="text" name="jenis_bb" class="form-control" value="<?php echo $bb?>"required>
                                <div class="input-group-append">
                                    <button name="update" value="simpan" class="btn btn-purple" type="submit">
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

    </div><!-- end row col-md-9 -->
  </div>
  
<?php include 'template/footer.php';?>
