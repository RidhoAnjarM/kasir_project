<?php
session_start();
include "akses2.php";

$_SESSION['cart'] = [];
header("location:kasir.php");
?>