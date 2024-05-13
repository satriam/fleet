<?php include 'template/header.php';?>
<?php
$id = $_POST['id'];
$result = mysqli_query($conn, "SELECT * FROM laporan WHERE id_laporan=$id");

while($data = mysqli_fetch_array($result))
{
    $shift = $data['shift'];
    $grup = $data['grup'];
    $tanggal = $data['tanggal_shift'];
   
}

$total_tonase=mysqli_query($conn,"select SUM(tonase) as total from detail_input where tanggal='$tanggal' AND shift='$shift' AND grup='$grup' ");
while($ton = mysqli_fetch_array($total_tonase))
{
    $total = $ton['total'];
}
//loading
$loading = mysqli_query($conn, "SELECT DISTINCT loading_point, COUNT(DISTINCT exca) AS jumlah_exca FROM detail_input where tanggal='$tanggal' AND shift='$shift' AND grup='$grup' GROUP BY loading_point;");
//dumping
$dumping = mysqli_query($conn, "SELECT DISTINCT dumping_point FROM detail_input where tanggal='$tanggal' AND shift='$shift' AND grup='$grup';");
//bb
$bb = mysqli_query($conn, "SELECT DISTINCT jenis_BB FROM detail_input where tanggal='$tanggal' AND shift='$shift' AND grup='$grup';");
//lokasi
$loc = mysqli_query($conn, "SELECT DISTINCT Lokasi FROM detail_input where tanggal='$tanggal' AND shift='$shift' AND grup='$grup';");
//ukur
$ukur = mysqli_query($conn, "SELECT DISTINCT Pengukuran FROM detail_input where tanggal='$tanggal' AND shift='$shift' AND grup='$grup';");
//Exca
$Exca = mysqli_query($conn,"SELECT DISTINCT Exca, SUM(tonase) AS Total_Tonase ,COUNT(setting_dt) as total_dt FROM detail_input WHERE tanggal = '$tanggal' AND shift = '$shift' AND grup = '$grup' GROUP BY Exca;");
//Exca ukur

//Loc Exca
$Excaloc = mysqli_query($conn,"SELECT DISTINCT Lokasi FROM detail_input WHERE tanggal = '$tanggal' AND shift = '$shift' AND grup = '$grup' ");
//DT
$Dump= mysqli_query($conn,"SELECT DISTINCT setting_dt, SUM(tonase) AS Total_Tonase FROM detail_input WHERE tanggal = '$tanggal' AND shift = '$shift' AND grup = '$grup' GROUP BY setting_dt;");
?>


  <div class="col-md-9 mb-2">
    <div class="row">

    <!-- overview -->
    <div class="col-md-12 mb-2">
        

        <div class="card">
        <div class="card-header bg-purple">
                <div class="card-tittle text-white"><i class="fa fa-shopping-cart"></i> <b>Overview Data</b></div>
            </div>
            <div class="card-body">
            
            <div class="form-row">
                <div class="form-group col-md-4">
                   <input type="text" class="form-control" name="tgl_input" value="<?php echo  $tanggal;?>" readonly>
                </div>
                <div class="form-group col-md-4">
                   <input type="text" class="form-control" name="tgl_input" value="<?php echo  $grup;?>" readonly>
                </div>
                <div class="form-group col-md-4">
                   <input type="text" class="form-control" name="tgl_input" value="<?php echo  $shift;?>" readonly>
                </div>
            </div>

            <hr>

            <table style="width: 80%;">
                <tr style="border-bottom:1px dashed">
                    <td><b>Total Tonase Seluruh</b></td>
                    <td>:</td>
                    <td style="padding-left: 10px;"><?php echo $total?></td>
                </tr>
                <tr style="border-bottom:1px dashed">
                <td><b>Loading Point Active</b></td>
                <td>:</td>
                <td style="padding-left: 10px;"><?php
                    while ($row = mysqli_fetch_assoc($loading)) {
                        $loadingPoint = $row['loading_point'];
                        $exca = $row['jumlah_exca'];
                        echo "<li>$loadingPoint ($exca fleet)</li>";
                    }
                    ?></td>
                </tr>

                <tr style="border-bottom:1px dashed">
                <td><b>Dumping Point Active</b></td>
                <td>:</td>
                <td style="padding-left: 10px;"> <?php
                    while ($row = mysqli_fetch_assoc($dumping)) {
                        $dumpingPoint = $row['dumping_point'];
                        echo "<li>$dumpingPoint</li>";
                    }
                    ?></td>
                </tr>
                <tr style="border-bottom:1px dashed">
                <td><b>Jenis Batubara Active</b></td>
                <td>:</td>
                <td style="padding-left: 10px;"> <?php
                    while ($row = mysqli_fetch_assoc($bb)) {
                        $bba = $row['jenis_BB'];
                        echo "<li>$bba</li>";
                    }
                    ?></td>
                </tr>
                <tr style="border-bottom:1px dashed">
                <td><b>Lokasi Active</b></td>
                <td>:</td>
                <td style="padding-left: 10px;"> <?php
                    while ($row = mysqli_fetch_assoc($loc)) {
                        $lokasi = $row['Lokasi'];
                        echo "<li>$lokasi</li>";
                    }
                    ?></td>
                </tr>
                <tr style="border-bottom:1px dashed">
                <td><b>Pengukuran Active</b></td>
                <td>:</td>
                <td style="padding-left: 10px;"> <?php
                    while ($row = mysqli_fetch_assoc($ukur)) {
                        $pengukuran = $row['Pengukuran'];
                        echo "<li>$pengukuran</li>";
                    }
                    ?></td>
                    
                </tr>
             
            </table>

        </div>
    </div>
    <!-- end barang -->
</div>

    <br>
     <div class="col-md-12 mb-2">
       <div class="accordion " id="accordionExample">
  <div class="card">
    <div class="card-header bg-purple " id="headingOne">
      <h2 class="mb-0">
        <button class="btn text-white btn-block text-left " type="button" data-toggle="collapse" data-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
           <i class="fa fa-shopping-cart"></i> <b>Overview Mitra</b>
        </button>
      </h2>
    </div>

    <div id="collapseOne" class="collapse show " aria-labelledby="headingOne" data-parent="#accordionExample">
      <div class="card-body">
        <br>
        <?php 
       $Mitra = mysqli_query($conn,"SELECT DISTINCT mitra from unit_exca GROUP BY mitra;;"); 
        
    while ($row = mysqli_fetch_assoc($Mitra)) {
        $excaValue = $row['mitra'];

    ?>
    
        <!-- Exca -->
        <div class="col-md-12 mb-2">
         
            <div class="card">
                <div class="card-header bg-success">
                    <div class="card-tittle text-white">
                        <i class="fa fa-shopping-cart"></i> <b>Overview Mitra <?php echo $excaValue ?></b>
                    </div>
                </div>
                <div class="card-body">
                <table class="table table-striped table-bordered table-sm dt-responsive nowrap tabell-data" width="100%">
                        <thead class="thead-purple">
                            <tr>
                            <th>No</th>
                            <th>Exca</th>
                            <th>Ritase</th>
                            <th>Tonase</th>
                            <th>Loading Point</th>
                            <th>Dumping Point</th>
                            <th>Pengukuran</th>
                            <th>Jenis Batubara</th>
                            <th>Status</th>
                            <th>Action</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        $data_barang = mysqli_query($conn,"SELECT 
    di.exca, 
    COUNT(di.setting_dt) AS jumlah_data_dt, 
    SUM(di.tonase) AS total_tonase, 
    di.loading_point, 
    di.dumping_point, 
    di.Pengukuran,
    di.Jenis_BB,
    COUNT(CASE WHEN di.status_data = 'Belum Lengkap' THEN 1 ELSE NULL END) AS data_count
FROM 
    detail_input di
JOIN 
    unit_exca ue ON di.exca = ue.unit
WHERE 
    ue.mitra = '$excaValue' 
    AND di.tanggal = '$tanggal' 
    AND di.shift = '$shift' 
    AND di.grup = '$grup'
GROUP BY 
    di.exca, di.loading_point, di.dumping_point, di.Pengukuran;
");
                        while($d = mysqli_fetch_array($data_barang)){
                            
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['exca']; ?></td>
                            <td><?php echo $d['jumlah_data_dt']; ?></td>
                            <td><?php echo $d['total_tonase']; ?></td>
                            <td><?php echo $d['loading_point']; ?></td>
                            <td><?php echo $d['dumping_point']; ?></td>
                            <td><?php echo $d['Pengukuran']; ?></td>
                            <td><?php echo $d['Jenis_BB']; ?></td>
                            <td>
                             <?php
                                if ($d['data_count']>=1) {
                                    echo '<span class="badge badge-warning">Belum Lengkap</span>';
                                } else {
                                     echo '<span class="badge badge-success">Lengkap</span>';
                                }
                                ?>
                            </td>
                            <td>  <a class="btn btn-primary btn-xs" href="detail_dt_laporan.php?exca=<?php echo $d['exca']; ?>&loading=<?php echo $d['loading_point'];?>&dumping=<?php echo $d['dumping_point'];?>&tanggal=<?php echo $tanggal?>&shift=<?php echo $shift;?>&grup=<?php echo $grup;?>&ukur=<?php echo $d['Pengukuran'];?>">
                                        <i class="fa fa-pen fa-xs"></i>Detail</a></td>

						</tr>
                        <?php }?>
					</tbody>
                    
                </table>
                </div>
            </div>
        </div>
        

<?php }?>
      </div>
    </div>
  </div>
  
  </div>
  </div>
  <div class="col-md-12 mb-2">
         
            <div class="card">
                <div class="card-header bg-success">
                    <div class="card-tittle text-white">
                        <i class="fa fa-shopping-cart"></i> <b>Dump Truck Active</b>
                    </div>
                </div>
                <div class="card-body">
                <table class="table table-striped table-bordered table-sm dt-responsive nowrap" id="table" width="100%" >
                        <thead class="thead-purple">
                            <tr>
                            <th>No</th>
                            <th>ID Data</th>
                            <th>tanggal</th>
                            <th>Exca</th>
                            <th>Loading Point</th>
                            <th>Dumping Point</th>
                            <th>Dump truck</th>
                            <th>Jam Loading</th>
                            <th>Jam Dumping</th>
                            <th>Moving Time (Minutes)</th>
                            <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        $query = mysqli_query($conn,"SELECT * FROM detail_input where grup='$grup' AND shift='$shift' AND tanggal='$tanggal' ");
                        while($d = mysqli_fetch_array($query)){
                            ?>
                        <tr>
                            <td ><?php echo $no++; ?></td>
                            <td><?php echo $d['id_temporary']; ?></td>
                            <td><?php echo $d['tanggal']; ?></td>
                            <td><?php echo $d['exca']; ?></td>
                            <td><?php echo $d['loading_point']; ?></td>
                            <td><?php echo $d['dumping_point']; ?></td>
                            <td><?php echo $d['setting_dt']; ?></td>
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
                            
                        </td>
                                                  
                          
						</tr>
                        <?php }?>
					</tbody>
                    
                </table>
                </div>
            </div>
        </div>
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
