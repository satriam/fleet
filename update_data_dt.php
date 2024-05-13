<?php include 'template/header.php';?>
<?php
$dt = $_GET['dt'];
$exca = $_GET['exca'];
$loading=$_GET['loading'];
$dumping=$_GET['dumping'];
$grup=$_GET['grup'];
$shift=$_GET['shift'];
$tanggal=$_GET['tanggal'];
?>


  <div class="col-md-9 mb-2">
    <div class="row">

    <!-- table barang -->
    <div class="col-md-12 mb-2">
        <div class="card">
        <div class="card-header bg-purple">
                <div class="card-tittle text-white"><i class="fa fa-table"></i> <b>Detail <?php echo $dt?></b></div>
            </div>
            <div class="card-body" id="laporantabel">
                <table class="table table-striped table-bordered table-sm dt-responsive nowrap" id="table" width="100%" >
                        <thead class="thead-purple">
                            <tr>
                            <th>No</th>
                            <th>ID Data</th>
                            <th>Jam Loading</th>
                            <th>Jam Dumping</th>
                            <th>Moving Time (Minutes)</th>
                            <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        $query = mysqli_query($conn,"SELECT * FROM detail_input where setting_dt='$dt' AND grup='$grup' AND shift='$shift' AND tanggal='$tanggal' AND loading_point='$loading' AND dumping_point='$dumping'");
                        while($d = mysqli_fetch_array($query)){
                            ?>
                        <tr>
                            <td ><?php echo $no++; ?></td>
                            <td><?php echo $d['id_temporary']; ?></td>
                           <td class="editable" data-column="jam_loading" data-id="<?php echo $d['id_temporary']; ?>" contenteditable="true"><?php echo $d['jam_loading']; ?></td>
                            <td class="editable" data-column="jam" data-id="<?php echo $d['id_temporary']; ?>" ><?php echo $d['jam']; ?></td>
                            <td class="editable" data-column="waktu" data-id="<?php echo $d['id_temporary']; ?>"><?php echo $d['waktu']; ?></td>

                         <td>
                            <?php
                            if ($d['status_data'] == 'Lengkap') {
                                echo '<span id="status-'.$d['id_temporary'].'" class="status-badge badge badge-success">Lengkap</span>';
                            } else {
                                echo '<span id="status-'.$d['id_temporary'].'" class="status-badge badge badge-warning">Belum Lengkap</span>';
                            }
                            ?>
                            <div class="floating-notification"></div>
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
  
<script>
    $(document).ready(function() {
        // Handle cell editing
        $('.editable').on('blur', function() {
            var id = $(this).data('id');
            var column = $(this).data('column');
            var value = $(this).text();

            // Send an AJAX request to update the data
            $.ajax({
                url: 'update_data.php',
                method: 'POST',
                data: {id: id, column: column, value: value},
                success: function(response) {
                    console.log(response);
                    // Update the DOM with the new value
                    $(`.editable[data-id='${id}'][data-column='${column}']`).text(value);

                    // Update status if 'status' column was updated
                    if (response === 'Data updated successfully') {
                        var statusText = 'Berhasil Update';
                        // Update the text content for the status column using the unique identifier
                          $(`#status-${id}`).text(statusText).removeClass('badge-warning').addClass('badge-success');

                        // Display a floating notification for successful data update
                       
                    } else if (column === 'waktu') {
                        // Additional logic for updating 'Moving Time' column
                        // For example, you might update another element with a different class
                        $(`.moving-time[data-id='${id}']`).text(value);
                    }
                },
                error: function(error) {
                    console.error(error);
                    // Display a floating notification for the error
                   
                }
            });
        });
    });
</script>





<?php include 'template/footer.php';?>
