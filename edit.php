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
    $nama = $_POST['unit'];
    $mitra = $_POST['mitra'];

    $result = mysqli_query($conn, "UPDATE unit_exca SET unit='$nama',mitra='$mitra' WHERE id_unit=$id");
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
                    window.location.href = 'unit.php'; // Alamat tujuan pengalihan
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
                <div class="card-tittle text-white"><i class="fa fa-shopping-cart"></i> <b>Edit Unit</b></div>
            </div>
            <div class="card-body">
            
                <form method="POST">
                    <div class="form-row">
                        <div class="form-group ">
                        <input type="hidden" name="id" value="<?php echo $_GET['id'] ?>">
                        </div>
                        <div class="form-group col-md-6">
                        <label><b>Nama Unit</b></label>
                        <input type="text" name="unit" class="form-control" value="<?php echo $nama; ?>" required>
                        </div>
                        <div class="form-group col-md-6">
                        <label><b>Mitra</b></label>
                            <div class="input-group">
                            <input type="text" name="mitra" class="form-control" value="<?php echo $mitra; ?>" required>
                                <div class="input-group-append">
                                    <button class="btn btn-purple " name="update" type="submit">
                                    <i class="fa fa-check mr-2"></i>Update</button>
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
