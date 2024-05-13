<?php include 'template/header.php';?>
<?php 
if(!empty($_POST['add_jarak'])){
    // $id = $_POST['id_barang'];
    $loading = $_POST['loading'];
    $dumping = $_POST['dumping'];
    $jarak = $_POST['jarak'];
    
    mysqli_query($conn,"insert into jarak values('','$loading','$dumping','$jarak')")
    or die(mysqli_error($conn));
    echo '<script>window.location="jarak.php"</script>';
}

?>

  <div class="col-md-9 mb-2">
    <div class="row">

    <!-- barang -->
    <div class="col-md-12 mb-3">
        <div class="card">
        <div class="card-header bg-purple">
                <div class="card-tittle text-white"><i class="fa fa-plus-square"></i> <b>Tambah Jarak</b></div>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-row">
                        <div class="form-group col-md-6">
                        <label><b>Nama Loading</b></label>
                            <div class="form-select">   
                                <select name="loading" id="select" class="form-control">
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
                        </div>

                        <div class="form-group col-md-6">
                        <label><b>Nama Dumping</b></label>
                            <div class="form-select">   
                                <select name="dumping" id="selectize" class="form-control">
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
                        </div>

                        <div class="form-group col-md-6">
                        <label><b>Jarak</b></label>
                            <div class="input-group">   
                            <input type="text"  name="jarak" step="0.01" class="form-control" required>
                            <div class="input-group-append">
                                    <button name="add_jarak" value="simpan" class="btn btn-purple" type="submit">
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
                <div class="card-tittle text-white"><i class="fa fa-table"></i> <b>Data Jarak</b></div>
            </div>
            <div class="card-body">
            <table class="table table-striped table-bordered table-sm dt-responsive nowrap" id="table_data" width="100%">
                        <thead class="thead-purple">
                            <tr>
                                <th>No</th>
                                <th>Nama Loading</th>
                                <th>Nama Dumping</th>
                                <th>Jarak</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        $data_barang = mysqli_query($conn,"select * from jarak order by id_jarak DESC");
                        while($d = mysqli_fetch_array($data_barang)){
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['Nama_loading']; ?></td>
                            <td><?php echo $d['Nama_dumping']; ?></td>
                            <td><?php echo $d['jarak']; ?></td>
                            <td>
                                <a class="btn btn-primary btn-xs" href="edit_jarak.php?id=<?php echo $d['Id_jarak']; ?>">
                                <i class="fa fa-pen fa-xs"></i> Edit</a>
                                <a class="btn btn-danger btn-xs" href="?id=<?php echo $d['Id_jarak']; ?>" 
                                onclick="javascript:return confirm('Hapus Data Jarak ?');">
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
		$hapus_data = mysqli_query($conn, "DELETE FROM jarak WHERE Id_jarak ='$id'");
		echo '<script>window.location="jarak.php"</script>';
	}

?>
    
<?php include 'template/footer.php';?>
