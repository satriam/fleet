<?php include 'template/header.php';?>
<?php
$result = mysqli_query($conn, "SELECT * FROM fleet_info");

while($data = mysqli_fetch_array($result))
{
    $shift = $data['Shift'];
    $grup = $data['Grup'];
    $tanggal = $data['Tanggal'];

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
//tonase
 $tonase = mysqli_query($conn,"SELECT SUM(detail_input.tonase) AS Total_Tonase FROM detail_input where tanggal = '$tanggal' && grup = '$grup' && shift = '$shift';");
 
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
                    <td style="padding-left: 10px;">
                        <?php
                        if(mysqli_num_rows($tonase)>0){
                            if ($row = mysqli_fetch_assoc($tonase)) {
                                $tt = $row['Total_Tonase'];
                                
                            }
                         }
                         echo $tt;
                         ?>
                        </td>
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

    <br>

    <?php 
    while ($row = mysqli_fetch_assoc($Exca)) {
        $excaValue = $row['Exca'];
        $total = $row['Total_Tonase'];
        $rit = $row['total_dt'];
    ?>
    <div class="row">
        <!-- Exca -->
        <div class="col-md-12 mb-2">
            <div class="card">
                <div class="card-header bg-purple">
                    <div class="card-tittle text-white">
                        <i class="fa fa-shopping-cart"></i> <b>Detail <?php echo $excaValue ?></b>
                    </div>
                </div>
                <div class="card-body">
                <table style="width: 80%;">
                        <tr style="border-bottom:1px dashed">
                            <td><b>Total Tonase Seluruh</b></td>
                            <td>:</td>
                            <td style="padding-left: 10px;"><?php echo $total?></td>
                        </tr>
                        <tr style="border-bottom:1px dashed">
                            <td><b>Total Ritase</b></td>
                            <td>:</td>
                            <td style="padding-left: 10px;"><?php echo $rit?></td>
                        </tr>
                        <?php 
                        $ExcaUkur=mysqli_query($conn,"SELECT
                        detail_input.Exca,
                        SUM(CASE WHEN Pengukuran = 'Timbangan' THEN 1 ELSE 0 END) AS Jumlah_DT_Timbangan,
                        SUM(CASE WHEN Pengukuran = 'bypass' THEN 1 ELSE 0 END) AS Jumlah_DT_Bypass,
                        SUM(CASE WHEN Pengukuran = 'beltscale' THEN 1 ELSE 0 END) AS Jumlah_DT_Beltscale,
                        MAX(CASE WHEN pengukuran.jenis = 'bypass' THEN pengukuran.nilai END) * SUM(CASE WHEN Pengukuran = 'bypass' THEN 1 ELSE 0 END) as total
                    FROM detail_input
                    INNER JOIN 
                    unit_exca ON unit_exca.unit = detail_input.Exca  
                    INNER JOIN 
                    pengukuran ON unit_exca.mitra = pengukuran.perusahaan 
                    WHERE 
                        tanggal = '$tanggal' 
                        AND shift = '$shift' 
                        AND grup = '$grup' 
                        AND Exca = '$excaValue'
                    GROUP BY 
                    detail_input.Exca;");
                            while ($row = mysqli_fetch_assoc($ExcaUkur)) {
                                $bypass = $row['Jumlah_DT_Bypass'];
                                $timbang = $row['Jumlah_DT_Timbangan'];
                                $belt = $row['Jumlah_DT_Beltscale'];
                                $jumlahbypass = $row['total']
                            ?>
                        <tr style="border-bottom:1px dashed">
                            <td><b>Ritase Pengukuran Bypass</b></td>
                            <td>:</td>
                            <td style="padding-left: 10px;"><?php echo $bypass?> (jumlah ton : <?php echo $jumlahbypass?> Ton)</td>
                        </tr>
                        <tr style="border-bottom:1px dashed">
                            <td><b>Ritase Pengukuran Timbangan</b></td>
                            <td>:</td>
                            <td style="padding-left: 10px;"><?php echo $timbang?></td>
                        </tr>
                        <tr style="border-bottom:1px dashed">
                            <td><b>Ritase Pengukuran BeltScale</b></td>
                            <td>:</td>
                            <td style="padding-left: 10px;"><?php echo $belt?></td>
                        </tr>
                        <?php
                            }
                            ?>
                        <tr style="border-bottom:1px dashed">
                        <td><b>Dump Truck Active</b></td>
                        <td>:</td>
                        <td style="padding-left: 10px;"><?php
                        $DT = mysqli_query($conn, "SELECT setting_dt, SUM(tonase) AS total_tonase_dt FROM detail_input where Exca = '$excaValue' AND tanggal='$tanggal' AND shift='$shift' AND grup='$grup' GROUP BY setting_dt");
                            while ($row = mysqli_fetch_assoc($DT)) {
                                $setdt = $row['setting_dt'];
                                $tonase =$row['total_tonase_dt'];
                                echo "<li>$setdt (tonase = $tonase)</li>";
                            }
                            ?></td>
                        </tr>
                        
                        <tr style="border-bottom:1px dashed">
                        <td><b>Lokasi Active</b></td>
                        <td>:</td>
                        <td style="padding-left: 10px;"><?php
                        $Excaloc = mysqli_query($conn, "SELECT DISTINCT Lokasi FROM detail_input WHERE Exca = '$excaValue' AND tanggal='$tanggal' AND shift='$shift' AND grup='$grup'");
                            while ($row = mysqli_fetch_assoc($Excaloc)) {
                                $setexca = $row['Lokasi'];
                                echo "<li>$setexca</li>";
                            }
                            ?></td>
                        </tr>

                        <tr style="border-bottom:1px dashed">
                        <td><b>Loading Point Active</b></td>
                        <td>:</td>
                        <td style="padding-left: 10px;"><?php
                        $Excaloc = mysqli_query($conn, "SELECT DISTINCT Loading_point FROM detail_input WHERE Exca = '$excaValue' AND tanggal='$tanggal' AND shift='$shift' AND grup='$grup'");
                            while ($row = mysqli_fetch_assoc($Excaloc)) {
                                $loading = $row['Loading_point'];
                                echo "<li>$loading</li>";
                            }
                            ?></td>
                        </tr>

                        <tr style="border-bottom:1px dashed">
                        <td><b>Pengukuran</b></td>
                        <td>:</td>
                        <td style="padding-left: 10px;"><?php
                        $ukuran = mysqli_query($conn, "SELECT DISTINCT Pengukuran FROM detail_input WHERE Exca = '$excaValue' AND tanggal='$tanggal' AND shift='$shift' AND grup='$grup'");
                            while ($row = mysqli_fetch_assoc($ukuran)) {
                                $ukur = $row['Pengukuran'];
                                echo "<li>$ukur</li>";
                            }
                            ?></td>
                        </tr>
                        </table>
                </div>
            </div>
        </div>
    </div>
<?php }?>

<?php

while ($row = mysqli_fetch_assoc($Dump)) {
    $DTvalue = $row['setting_dt'];
    $total = $row['Total_Tonase'];
?>
<br>
<div class="row">
    <!-- Exca -->
    <div class="col-md-12 mb-2">
        <div class="card">
            <div class="card-header bg-purple">
                <div class="card-tittle text-white">
                    <i class="fa fa-shopping-cart"></i> <b>Detail Dump Truck <?php echo $DTvalue ?></b>
                </div>
            </div>
            <div class="card-body">
            <table style="width: 80%;">
                <tr style="border-bottom:1px dashed">
                    <td><b>Total Tonase Seluruh</b></td>
                    <td>:</td>
                    <td style="padding-left: 10px;"><?php echo $total?></td>
                </tr>
                <tr style="border-bottom:1px dashed">
                        <td><b>Exca Active</b></td>
                        <td>:</td>
                        <td style="padding-left: 10px;"><?php
                        $Excaloc = mysqli_query($conn, "SELECT DISTINCT Exca FROM detail_input WHERE setting_dt = '$DTvalue' AND tanggal='$tanggal' AND shift='$shift' AND grup='$grup'");
                            while ($row = mysqli_fetch_assoc($Excaloc)) {
                                $setexca = $row['Exca'];
                                echo "<li>$setexca</li>";
                            }
                        ?></td>
                </tr>

                <tr style="border-bottom:1px dashed">
                        <td><b>Loading Point Active</b></td>
                        <td>:</td>
                        <td style="padding-left: 10px;"><?php
                        $Excaloc = mysqli_query($conn, "SELECT DISTINCT loading_point FROM detail_input WHERE setting_dt = '$DTvalue' AND tanggal='$tanggal' AND shift='$shift' AND grup='$grup'");
                            while ($row = mysqli_fetch_assoc($Excaloc)) {
                                $setexca = $row['loading_point'];
                                echo "<li>$setexca</li>";
                            }
                        ?></td>
                </tr>

                <tr style="border-bottom:1px dashed">
                        <td><b>Dumping Point Active</b></td>
                        <td>:</td>
                        <td style="padding-left: 10px;"><?php
                        $Excaloc = mysqli_query($conn, "SELECT DISTINCT dumping_point FROM detail_input WHERE setting_dt = '$DTvalue' AND tanggal='$tanggal' AND shift='$shift' AND grup='$grup'");
                            while ($row = mysqli_fetch_assoc($Excaloc)) {
                                $setexca = $row['dumping_point'];
                                echo "<li>$setexca</li>";
                            }
                        ?></td>
                </tr>

                <tr style="border-bottom:1px dashed">
                        <td><b>Total Ritase</b></td>
                        <td>:</td>
                        <td style="padding-left: 10px;"><?php
                        $Excaloc = mysqli_query($conn, "SELECT count(*) as ritase  FROM detail_input WHERE setting_dt='$DTvalue' AND tanggal='$tanggal' AND shift='$shift' AND grup='$grup'");
                            while ($row = mysqli_fetch_assoc($Excaloc)) {
                                $setexca = $row['ritase'];
                                echo "<li>$setexca</li>";
                            }
                        ?></td>
                </tr>
               
            </table>
            <br>
            <table class="table table-striped table-bordered table-sm dt-responsive nowrap tabell-data" width="100%">
                        <thead class="thead-purple">
                            <tr>
                            <th>No</th>
                            <th>Exca</th>
                            <th>Tonase</th>
                            <th>Loading Point</th>
                            <th>Dumping Point</th>
                            <th>Jarak</th>
                            <th>Jenis Batubara</th>
                            <th>Pengukuran</th>
                            <th>Jam Dumping</th>
                            <th>Waktu</th>
                            </tr>
                        </thead>
                        <tbody>
                        <?php 
                        $no = 1;
                        $data_barang = mysqli_query($conn,"SELECT * FROM detail_input where setting_dt='$DTvalue' AND tanggal='$tanggal' AND shift='$shift' AND grup='$grup'");
                        while($d = mysqli_fetch_array($data_barang)){
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['exca']; ?></td>
                            <td><?php echo $d['tonase']; ?></td>
                            <td><?php echo $d['loading_point']; ?></td>
                            <td><?php echo $d['dumping_point']; ?></td>
                            <td><?php echo $d['jarak']; ?></td>
                            <td><?php echo $d['Jenis_BB']; ?></td>
                            <td><?php echo $d['Pengukuran']; ?></td>
                            <td><?php echo $d['jam']; ?></td>
                            <td><?php echo $d['waktu']; ?></td>
						</tr>
                        <?php }?>
					</tbody>
                    
                </table>
            </div>
        </div>
    </div>
</div>
</div>
<?php }
?>
<?php include 'template/footer.php';?>
