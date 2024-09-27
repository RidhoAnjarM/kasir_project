<?php 
include 'config.php';

if (isset($_GET['id'])) {

    $id = $_GET['id'];

    mysqli_query($dbconnect, "DELETE FROM `user` WHERE id_user='$id' ");

    header("location:user.php");
}
?>