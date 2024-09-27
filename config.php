<?php

$host = "localhost";
$user = "root";
$pass = "";
$db = "kasir";

$dbconnect = new mysqli (hostname: $host, username: $user, password: $pass, database: $db);

if($dbconnect-> connect_error){
  die("gagal terhubung" . mysqli_connect_error());
}

?>