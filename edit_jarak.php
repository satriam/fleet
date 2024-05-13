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
    $loading = $_POST['loading'];
    $dumping = $_POST['dumping'];
    $jarak = $_POST['jarak'];

    $result = mysqli_query($conn, "UPDATE jarak SET Nama_loading='$loading',Nama_dumping='$dumping',jarak = '$jarak' WHERE Id_jarak=$id");
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
                    window.location.href = 'jarak.php'; // Alamat tujuan pengalihan
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
$result = mysqli_query($conn, "SELECT * FROM jarak WHERE Id_jarak=$id");
// var_dump($result);die;
while($data = mysqli_fetch_array($result))
{
    $idb = $data['Id_jarak'];
    $loading = $data['Nama_loading'];
    $dumping = $data['Nama_dumping'];
    $jarak = $data['jarak'];
    
   

}
?>
        <div class="card">
        <div class="card-header bg-purple">
                <div class="card-tittle text-white"><i class="fa fa-shopping-cart"></i> <b>Update Jarak</b></div>
            </div>
            <div class="card-body">

            
                <form method="POST">
                    <div class="form-row">
                    <div class="form-group">
    <input type="hidden" name="id" value="<?php echo $_GET['id']; ?>">
</div>

                <div class="form-group col-md-6">
                    <label><b>Nama Loading</b></label>
                    <div class="form-select">
                        <select name="loading" id="selectize" class="form-control">
                            <option disabled selected> Pilih </option>
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM loading");

                            while ($data = mysqli_fetch_array($query)) {
                                $namaloading = $data['Nama_loading'];
                                $cek = ($loading == $namaloading) ? "selected" : "";
                                echo '<option value="' . $namaloading . '" ' . $cek . '>' . $namaloading . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label><b>Nama Dumping</b></label>
                    <div class="form-select">
                        <select name="dumping" id="selectize" class="form-control">
                            <option disabled selected> Pilih </option>
                            <?php
                            $query = mysqli_query($conn, "SELECT * FROM dumping");

                            while ($data = mysqli_fetch_array($query)) {
                                $namadumping = $data['Nama_dumping'];
                                $cek = ($dumping == $namadumping) ? "selected" : "";

                                echo '<option value="' . $namadumping . '" ' . $cek . '>' . $namadumping . '</option>';
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="form-group col-md-6">
                    <label><b>jarak</b></label>
                    <div class="input-group">
                        <input type="number" name="jarak" class="form-control" step="0.01" value="<?php echo $jarak; ?>" required>
                        <div class="input-group-append">
                            <button class="btn btn-purple" name="update" type="submit">
                                <i class="fa fa-check mr-2"></i>Update
                            </button>
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
