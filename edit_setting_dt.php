<?php include 'template/header.php';?>

  <div class="col-md-9 mb-2">
    <div class="row">

    <!-- barang -->
    <div class="col-md-12 mb-2">
        
<?php
include "config.php";

$id = $_GET['id'];
$result = mysqli_query($conn, "SELECT * FROM setting_dt WHERE id_setting_dt=$id");
// var_dump($result);die;
while($data = mysqli_fetch_array($result))
{
    $idSF = $data['id_setting_fleet'];
    $namaDT = $data['Nama_DT'];
}
if(isset($_POST['update']))
{
    $id = $_POST['id'];
    $unit = $_POST['id_exca'];
    $mitra = $_POST['dt'];

    $result = mysqli_query($conn, "UPDATE setting_dt SET id_setting_fleet='$unit',Nama_DT='$mitra' WHERE id_setting_dt=$id");
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
                    window.location.href = 'setting_dt.php'; // Alamat tujuan pengalihan
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
$result = mysqli_query($conn, "SELECT * FROM unit_exca WHERE id_unit=$id");
// var_dump($result);die;
while($data = mysqli_fetch_array($result))
{
    $idb = $data['id_unit'];
    $nama = $data['unit'];
    $mitra = $data['mitra'];
}
?>
       
       <div class="card">
        <div class="card-header bg-purple">
                <div class="card-tittle text-white"><i class="fa fa-plus-square"></i> <b>Setting DT</b></div>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-row">

                    <div class="form-group col-md-6">
                    <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                            <label><b>Exca</b></label>
                            <select name="id_exca"  class="form-control js-example-responsive" >
                            <option disabled selected> Pilih </option>
                                    <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM setting_fleet");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $selected = ($data['Id_setting'] == $idSF) ? 'selected' : '';
                                    ?>
                                    <option value="<?=$data['Id_setting'];?>"<?= $selected; ?>><?php echo $data['Exca'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                        <label><b>Dump Truck</b></label>
                            
                            <select name="dt" class="form-control form-control js-example-responsive">
                            <option disabled selected> Pilih </option>
                                    <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM unit_dt");
                                    while ($data = mysqli_fetch_array($query)) {
                                        $selected = ($data['unit'] == $namaDT) ? 'selected' : '';
                                    ?>
                                    <option value="<?=$data['unit'];?>"<?= $selected; ?>><?php echo $data['unit'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                            <div class="input-group-append">
                                <button name="update" value="update" class="btn btn-purple ml-auto mt-2" type="submit" >
                                    <i class="fa fa-plus mr-2"></i>Update
                                </button>
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
