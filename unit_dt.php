<?php include 'template/header.php';?>
<?php 
if(!empty($_POST['add_barang'])){
    // $id = $_POST['id_barang'];
    $unit = $_POST['unit'];
    $mitra = $_POST['mitra'];
    $ukur = $_POST['id_ukur'];
    // var_dump($ukur);die;
    $query=mysqli_query($conn,"insert into unit_dt values('','$unit','$mitra','$ukur')")
    or die(mysqli_error($conn));
    
    echo '<script>window.location="unit_dt.php"</script>';
}

?>

  <div class="col-md-9 mb-2">
    <div class="row">

    <!-- barang -->
    <div class="col-md-12 mb-3">
        <div class="card">
        <div class="card-header bg-purple">
                <div class="card-tittle text-white"><i class="fa fa-shopping-cart"></i> <b>Tambah Unit DT</b></div>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-row">

                        <div class="form-group col-md-6">
                        <label><b>Nama Unit DT</b></label>
                        <input type="text" name="unit" class="form-control" required>
                        </div>
                        
                        <div class="form-group col-md-6">
                            <label><b>Rata Rata</b></label>
                            <select name="id_ukur" class="form-control" required>
                            <option disabled selected> Pilih </option>
                                    <?php
                                    $query    =mysqli_query($conn, "SELECT * FROM pengukuran");
                                    while ($data = mysqli_fetch_array($query)) {
                                    ?>
                                    <option value="<?=$data['id_ukur'];?>"><?php echo $data['jenis'];?></option>
                                    <?php
                                    }
                                    ?>
                            </select>
                        </div>
                        
                        <div class="form-group col-md-6">
                        <label><b>Mitra</b></label>
                            <div class="input-group">
                              <input type="text" name="mitra" class="form-control" required>
                                <div class="input-group-append">
                                    <button name="add_barang" value="simpan" class="btn btn-purple" type="submit">
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
                                <th>Nama Unit DT</th>
                                <th>Mitra</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        $data_barang = mysqli_query($conn,"select * from unit_dt order by id_unit DESC");
                        while($d = mysqli_fetch_array($data_barang)){
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['unit']; ?></td>
                            <td><?php echo $d['mitra']; ?></td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="edit.php?id=<?php echo $d['id_unit']; ?>">
                                <i class="fa fa-pen fa-xs"></i> Edit</a>
                                <a class="btn btn-danger btn-xs" href="?id=<?php echo $d['id_unit']; ?>" 
                                onclick="javascript:return confirm('Hapus Data Unit DT ?');">
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
		$hapus_data = mysqli_query($conn, "DELETE FROM unit_dt WHERE id_unit ='$id'");
		echo '<script>window.location="unit_dt.php"</script>';
	}

?>
<?php include 'template/footer.php';?>
