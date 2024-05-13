<?php include 'template/header.php';?>


  <div class="col-md-9 mb-2">
    <div class="row">

    <!-- barang -->
    <div class="col-md-12 mb-3">

    <?php
if(!empty($_POST['add_barang'])){
    if(isset($_POST['id_exca']) && isset($_POST['dt'])){
        $unit = $_POST['id_exca'];
        $mitra = $_POST['dt'];
   foreach ($_POST['dt'] as $subject ) {
      
        // Periksa apakah kedua data sudah dipilih
        if (empty($unit) || empty($mitra)) {
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
            $cek = mysqli_query($conn, "SELECT * FROM setting_dt WHERE id_setting_fleet = '$unit' AND Nama_DT = '$subject'");
            $cek2 = mysqli_query($conn, "SELECT * FROM setting_dt WHERE  Nama_DT = '$subject'");
            if (mysqli_num_rows($cek) > 0) {
                echo "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                <strong>NOOO!</strong> Data yang diinput Exca dan DT sudah ada.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                ";
            } else if(mysqli_num_rows($cek2) > 0){
                 echo "
                <div class='alert alert-danger alert-dismissible fade show' role='alert'>
                    <strong>NOOO!</strong> Data DT sudah ada.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                ";
            }else {
                mysqli_query($conn, "insert into setting_dt values(NULL, '$unit', '$subject')")
                or die(mysqli_error($conn));
                
                echo '<script>window.location="setting_dt.php"</script>';
                echo "
                <div class='alert alert-success alert-dismissible fade show' role='alert'>
                    <strong>YESS!</strong> berhasil Menambahkan Data.
                    <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                        <span aria-hidden='true'>&times;</span>
                    </button>
                </div>
                ";
            }
        }
   }
    } else {
        echo "
        <div class='alert alert-danger alert-dismissible fade show' role='alert'>
            <strong>NOOO!</strong> Harap pilih Exca dan Dump Truck terlebih dahulu.
            <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
                <span aria-hidden='true'>&times;</span>
            </button>
        </div>
        ";
    }
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
                            <label><b>Exca</b></label>
                            <select name="id_exca"  class="form-control js-example-responsive" >
                            <option disabled selected> Pilih </option>
                                    <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM setting_fleet");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value="<?=$data['Id_setting'];?>"><?php echo $data['Exca'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>

                        <div class="form-group col-md-6">
                        <label><b>Dump Truck</b></label>
                            
                            <select name="dt[]" multiple class="form-control form-control js-example-responsive">
                            <option disabled selected> Pilih </option>
                                    <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM unit_dt");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value="<?=$data['unit'];?>"><?php echo $data['unit'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                            <div class="input-group-append">
                                <button name="add_barang" value="simpan" class="btn btn-purple ml-auto mt-2" type="submit" >
                                    <i class="fa fa-plus mr-2"></i>Tambah
                                </button>
                            </div>
                        
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <!-- end barang -->
    


    <!-- table barang -->
    <div class="col-md-12 mb-2">
        <div class="card">
        <div class="card-header bg-purple">
                <div class="card-tittle text-white"><i class="fa fa-table"></i> <b>Data Unit Exca</b></div>
            </div>
            <div class="card-body">
            <table class="table table-striped table-bordered table-sm dt-responsive nowrap" id="table_data" width="100%">
                        <thead class="thead-purple">
                            <tr>
                                <th>No</th>
                                <th>Nama Unit Exca</th>
                                <th>Nama Dump Truck</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        $data_barang = mysqli_query($conn,"select id_setting_dt,setting_fleet.Exca,Nama_DT from setting_dt inner join setting_fleet on setting_dt.id_setting_fleet = setting_fleet.Id_setting order by id_setting_dt DESC");
                        while($d = mysqli_fetch_array($data_barang)){
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['Exca']; ?></td>
                            <td><?php echo $d['Nama_DT']; ?></td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="edit_setting_dt.php?id=<?php echo $d['id_setting_dt']; ?>">
                                <i class="fa fa-pen fa-xs"></i> Edit</a>
                                <a class="btn btn-danger btn-xs" href="?id=<?php echo $d['id_setting_dt']; ?>" 
                                onclick="javascript:return confirm('Hapus Data Setting DT ?');">
                                <i class="fa fa-trash fa-xs"></i> Hapus</a>
                            </td>
						</tr>
                        <?php }?>
					</tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- end table barang -->

    </div><!-- end row col-md-9 -->
  </div>
  <?php 
	include 'config.php';
	if(!empty($_GET['id'])){
		$id= $_GET['id'];
		$hapus_data = mysqli_query($conn, "DELETE FROM setting_dt WHERE id_setting_dt ='$id'");
		echo '<script>window.location="setting_dt.php"</script>';
	}

?>


<?php include 'template/footer.php';?>
