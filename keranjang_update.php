<?php

include "config.php";
session_start();
include "akses2.php";


// Pastikan $_SESSION['cart'] telah diinisialisasi dan tidak kosong
if(isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
    // Periksa apakah qty yang dikirimkan melalui metode POST berupa array
    if(isset($_POST['qty']) && is_array($_POST['qty'])) {
        // Lakukan iterasi melalui array qty yang dikirimkan
        foreach($_POST['qty'] as $key => $qty) {
            // Periksa apakah qty lebih besar dari 0 dan merupakan angka
            if(is_numeric($qty) && $qty > 0) {
                // Perbarui qty untuk barang yang sesuai dengan kunci
                $_SESSION['cart'][$key]['qty'] = $qty;
            }
        }
    }
}

// Redirect kembali ke halaman keranjang belanja
header("Location: kasir.php");
exit();
?>