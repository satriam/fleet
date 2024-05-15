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
  <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/selectize.js/0.12.6/css/selectize.bootstrap3.min.css" integrity="sha256-ze/OEYGcFbPRmvCnrSeKbRTtjG4vGLHXgOqsyLFTRjg=" crossorigin="anonymous" /> -->
  <link rel="stylesheet" type="text/css" href="/assets/DataTables/datatables.min.css"/>
  <link rel="stylesheet" href="assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="assets/css/style.css">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.7/css/select2.min.css" rel="stylesheet" />
  <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>

  <!-- <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.1/font/bootstrap-icons.css"> -->
<!-- Bootstrap CSS -->
<!-- <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet"> -->

<!-- driver js -->

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

.floating-button {
  position: fixed;
  bottom: 30px;
  right: 30px;
  z-index: 1000;
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Penambahan bayangan */
}

.act-btn {
  background: green;
  display: block;
  width: 50px;
  height: 50px;
  line-height: 50px;
  text-align: center;
  color: white;
  font-size: 30px;
  font-weight: bold;
  border-radius: 50%;
  -webkit-border-radius: 50%;
  text-decoration: none;
  transition: ease all 0.3s;
  position: fixed;
  right: 30px;
  bottom: 30px;
}

.act-btn:hover {
  background: blue;
  transform: scale(1.1);
}

.menu {
  display: none;
  position: absolute;
  bottom: 70px;
  right: 10px;
  background-color: rgba(255, 254, 255, 0.9);
  box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1); /* Penambahan bayangan */
  border-radius: 10px;
  transition: ease all 0.3s;
}

.menu-item {
  display: block;
  padding: 10px;
  width:150px;
  text-decoration: none;
  color: #333;
  transition: background-color 0.3s;
}

.menu-item:hover {
  background-color: #f0f0f0;
}

.menu.active {
  display: block;
}

  </style>
</head>
<body>


       




<div id="unlockedContent">

<nav class="navbar navbar-expand-lg navbar-dark bg-purple text-white shadow-sm sticky-top d-md-none d-lg-none d-xl-none">
  <a class="navbar-brand" href="https://satriam.github.io" target=_blank><i class="fa fa-truck mr-1">REHANDLING BUKIT ASAM</i><b>
 </b></a>
  <button class="navbar-toggler border-0" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <i class="fa fa-bars"></i>
  </button>
  <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php"><i class="fa fa-desktop text-purple mr-2"></i>Dispatch</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="setting_fleet.php"><i class="fa fa-tasks text-purple mr-2" aria-hidden="true"></i>Setting Fleet</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="setting_dt.php"><i class="fa fa-tasks text-purple mr-2" aria-hidden="true"></i>Setting Dump Truck</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="overviewmitra.php" target = "_blank"><i class="fa fa-handshake text-purple mr-2" aria-hidden="true"></i>Overview Mitra</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="overviewstatus.php" target = "_blank"><i class="fa fa-chart-line text-purple mr-2" aria-hidden="true"></i>Overview Status</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="overviewexca.php" target = "_blank"><i class="fa fa-tasks text-purple mr-2" aria-hidden="true"></i>Overview Exca</a>
                    </li>
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link" href="unit.php"><i class="fa fa-car text-purple mr-2" aria-hidden="true"></i>Unit Exca</a>-->
                    <!--</li>-->
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link" href="unit_dt.php"><i class="fa fa-car text-purple mr-2" aria-hidden="true"></i>Unit Dump Truck</a>-->
                    <!--</li>-->
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link" href="jarak.php"><i class="fa fa-location-arrow text-purple mr-2"></i>Jarak</a>-->
                    <!--</li>-->
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link" href="loading.php"><i class="fa fa-location-arrow text-purple mr-2"></i>Loading</a>-->
                    <!--</li>-->
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link" href="dumping.php"><i class="fa fa-location-arrow text-purple mr-2"></i>Dumping</a>-->
                    <!--</li>-->
                    <li class="nav-item">
                        <a class="nav-link" href="laporan.php"><i class="fa fa-table text-purple mr-2"></i>Laporan</a>
                    </li>
                  
                </ul>
            </div>
</nav>

<div class="bg-purple text-center py-2 shadow-sm sticky-top d-none d-md-block">
<a class="navbar-brand text-white" href="https://satriam.github.io" target=_blank><i class="fa fa-truck mr-1"> REHANDLING BUKIT ASAM</i><b>
  </b></a>
</div>
<br>

<div class="container-fluid">

  <div class="row">
  
    <div class="col-md-3 mb-2 d-none d-md-block" >
        <div class="card"  id="nav">
            <div class="card-header bg-purple">
                <div class="card-tittle text-white">Hallo, <b>DISPATCHER</b></div>
            </div>
            <div class="card-body">
                <ul class="navbar-nav">
                    <li class="nav-item" id="dispatcher">
                        <a class="nav-link" href="index.php"><i class="fa fa-desktop text-purple mr-2"></i>Dispatch</a>
                    </li>
                    <li class="nav-item" id="settingfleet">
                        <a class="nav-link" href="setting_fleet.php"><i class="fa fa-tasks text-purple mr-2" aria-hidden="true"></i>Setting Fleet</a>
                    </li>
                    <li class="nav-item" id="settingdt">
                        <a class="nav-link" href="setting_dt.php"><i class="fa fa-truck text-purple mr-2" aria-hidden="true"></i>Setting Dump Truck</a>
                    </li>
                                         <li class="nav-item">
                        <a class="nav-link" href="overviewmitra.php" target = "_blank"><i class="fa fa-handshake text-purple mr-2" aria-hidden="true"></i>Overview Mitra</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="overviewstatus.php" target = "_blank"><i class="fa fa-chart-line text-purple mr-2" aria-hidden="true"></i>Overview Status</a>
                    </li>
                     <li class="nav-item">
                        <a class="nav-link" href="overviewexca.php" target = "_blank"><i class="fa fa-tasks text-purple mr-2" aria-hidden="true"></i>Overview Exca</a>
                    </li>
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link" href="unit.php"><i class="fa fa-car text-purple mr-2" aria-hidden="true"></i>Unit Exca</a>-->
                    <!--</li>-->
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link" href="unit_dt.php"><i class="fa fa-car text-purple mr-2" aria-hidden="true"></i>Unit Dump Truck</a>-->
                    <!--</li>-->
                    <!--<li class="nav-item" id="jarak">-->
                    <!--    <a class="nav-link" href="jarak.php"><i class="fa fa-location-arrow text-purple mr-2"></i>Jarak</a>-->
                    <!--</li>-->
                    <!-- <li class="nav-item">-->
                    <!--    <a class="nav-link" href="loading.php"><i class="fa fa-location-arrow text-purple mr-2"></i>Loading</a>-->
                    <!--</li>-->
                    <!--<li class="nav-item">-->
                    <!--    <a class="nav-link" href="dumping.php"><i class="fa fa-location-arrow text-purple mr-2"></i>Dumping</a>-->
                    <!--</li>-->
                    <li class="nav-item" id="laporan">
                        <a class="nav-link" href="laporan.php"><i class="fa fa-table text-purple mr-2"></i>Laporan</a>
                    </li>
                 
                </ul>
         </div>
    </div>
  </div>
  <div class="floating-button">
    <a class="act-btn" onclick="toggleMenu()"><i class="fa fa-question" aria-hidden="true"></i></a>
    <div class="menu">
        <a class="menu-item" onclick="handleMenuItem('Menu')">Menu</a>
        <a href="#" class="menu-item" onclick="handleMenuItem('Laporan')">Laporan</a>
        <a href="#" class="menu-item" onclick="handleMenuItem('Option 3')">Option 3</a>
    </div>
</div>

