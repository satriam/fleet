<!-- By : SATRIA MULYA ADIWARDANA -->
<!-- HAK CIPTA BOSKU -->
<?php
include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dispatch Mining Fleet</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="icon" href="favicon.ico">
    <link rel="icon" href="icon.ico" type="image/ico">
  <link href="assets/fontawesome/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <link rel="stylesheet" type="text/css" href="assets/DataTables/datatables.min.css"/>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/driver.js@1.0.1/dist/driver.css"/>

  
 
 
  <style>
      .btn-group-xs > .btn, .btn-xs {
  padding: .25rem .4rem;
  font-size: .875rem;
  line-height: .5;
  border-radius: .2rem;
}
.card{
  border: none;
  border-radius: 15px;
  box-shadow: 0 6px 20px rgb(17 26 104 / 10%);
}
.card-header{
  border-radius: 15px 15px 0px 0px !important;
}
.form-control{
  border-radius: 15px;
}
.btn{
  border-radius: 15px;
}
button.buttons-html5{
  padding: .25rem .4rem !important;
  font-size: .875rem !important;
  line-height: .5 !important;
}

body {
  margin: 0;
  font-family: Arial, sans-serif;
}


  </style>
</head>
<body>
<div class="bg-purple text-center py-2 shadow-sm sticky-top d-none d-md-block">
<a class="navbar-brand text-white" href="https://satriam.github.io" target=_blank><i class="fa fa-truck mr-1"> REHANDLING BUKIT ASAM</i><b>
  </b></a>
</div>
    
      <div class="card-body">
        <br>
        <?php 
        
        $toko = mysqli_query($conn,"SELECT * FROM fleet_info ");
 if (mysqli_num_rows($toko) > 0) {
     // Data ditemukan, mengambil data
     if ($row = mysqli_fetch_assoc($toko)) {
         $Tanggal = $row['Tanggal'];
         $Grup = $row['Grup'];
         $Shift = $row['Shift'];

     }
 } else {
     // Tabel kosong, mengatur variabel menjadi null
     $Tanggal = null;
     $Grup = null;
     $Shift = null;
 }
    
    ?>
 <!-- Exca -->
     <!-- Exca -->
        <div class="col-md-12 mb-2">
         
            <div class="card">
                <div class="card-header bg-success">
                    <div class="card-tittle text-white">
                        <i class="fa fa-shopping-cart"></i> <b>Overview Status <?php echo $excaValue ?></b>
                    </div>
                </div>
                <div class="card-body">
               
                <table class="table table-striped table-bordered table-sm dt-responsive nowrap tabell-data" width="100%">
                        <thead class="thead-purple">
                            <tr>
                            <th>No</th>
                            <th>ritase</th>
                            <th>Tonase</th>
                            <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php
                        $no = 1;
                        $data_barang = mysqli_query($conn,"SELECT COUNT(di.Status) AS ritase, SUM(di.tonase) AS total_tonase,Status FROM detail_input as di WHERE di.tanggal='$Tanggal' AND di.shift='$Shift' AND di.grup='$Grup' GROUP BY di.Status;");
                        while($d = mysqli_fetch_array($data_barang)){
                            ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo $d['ritase']; ?></td>
                            <td><?php echo $d['total_tonase']; ?></td>
                            <td><?php echo $d['Status']; ?></td>
                        </tr>
                        <?php }?>
					</tbody>
                    
                </table>
                </div>
            </div>
        </div>
        
      </div>
    </div>
    
<script type="text/javascript">
    window.setTimeout( function() {
        window.location.reload();
    }, 5000);
</script>
 <?php include 'template/footer.php'; ?>