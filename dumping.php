<?php include 'template/header.php';?>

<?php 
if(!empty($_POST['add_barang'])){
    $dumping = $_POST['dumping'];

    
    mysqli_query($conn,"insert into dumping values('','$dumping')")
    or die(mysqli_error($conn));
    echo '<script>window.location="dumping.php"</script>';
}

?>

  <div class="col-md-9 mb-2">
  
    <div class="row">
    
    <!-- barang -->
  
    
  <div class="col-md-12 mb-3">
  <?php 
	include 'config.php';
	if(!empty($_GET['id'])){
		$id= $_GET['id'];
		$hapus_data = mysqli_query($conn, "DELETE FROM dumping WHERE id_dumping ='$id'");
		// echo '<script>window.location="loading.php"</script>';
        echo "
        <div class='alert alert-success alert-dismissible fade show' role='alert'>
  <strong>YESS!</strong> data berhasil dihapus.
  <button type='button' class='close' data-dismiss='alert' aria-label='Close'>
    <span aria-hidden='true'>&times;</span>
  </button>";
	}

?>
</div>
<div class="col-md-12 mb-3">
        <div class="card">
    
        <div class="card-header bg-purple">
     
                <div class="card-tittle text-white"><i class="fa fa-plus-square"></i> <b>Tambah Dumping</b></div>
            </div>
            <div class="card-body">
                <form method="POST">
                    <div class="form-row">

                        <div class="form-group col-md-6">
                        <label><b>Nama Dumping</b></label>
                            <div class="input-group">
                              <input type="text" name="dumping" class="form-control" required>
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
                <div class="card-tittle text-white"><i class="fa fa-table"></i> <b>Data Dumping</b></div>
            </div>
            <div class="card-body">
            <table class="table table-striped table-bordered table-sm dt-responsive nowrap" id="table_data" width="100%">
                        <thead class="thead-purple">
                            <tr>
                                <th>No</th>
                                <th>Nama Dumping</th>
                                <th>Opsi</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        $data_barang = mysqli_query($conn,"select * from dumping order by id_dumping DESC");
                        while($d = mysqli_fetch_array($data_barang)){
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['Nama_dumping']; ?></td>
                            <td>
                                <a class="btn btn-danger btn-xs" href="?id=<?php echo $d['id_dumping']; ?>" 
                                onclick="javascript:return confirm('Hapus Data Dumping?');">
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
  
 
<?php include 'template/footer.php';?>
