<?php
$host = "localhost";
$username = "rehandlingba";
$password = "Rehandlingbukitasam0909#";
$dbname = "rehandlingba_fleet";


$conn = mysqli_connect($host, $username, $password, $dbname);
if (!$conn){
        die("Connection Failed:".mysqli_connect_error());
    }
 
date_default_timezone_set('Asia/Jakarta');   
?>