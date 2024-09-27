<?php
include "config.php";
session_start();
include "akses2.php";

if(isset($_POST['id_barang']) && isset($_POST['qty'])) {
    $id_barang = $_POST['id_barang'];
    $qty = $_POST['qty'];

    // Periksa stok barang sebelum menambahkan ke keranjang
    $data = mysqli_query($dbconnect, "SELECT * FROM barang WHERE id_barang='$id_barang'");
    $b = mysqli_fetch_assoc($data);

    if($b['jumlah'] >= $qty) { // Pastikan stok mencukupi
        // Kurangi stok barang
        $new_stock = $b['jumlah'] - $qty;
        mysqli_query($dbconnect, "UPDATE barang SET jumlah='$new_stock' WHERE id_barang='$id_barang'");

        // Tambahkan barang ke keranjang
        $barang = [
            'id' => $b['id_barang'],
            'nama' => $b['nama'],
            'harga' => $b['harga'],
            'qty' => $qty
        ];

        $_SESSION['cart'][] = $barang;
        krsort($_SESSION['cart']);

        $_SESSION['success'] = "Barang berhasil ditambahkan ke keranjang.";
    } else {
        $_SESSION['error'] = "Stok barang tidak mencukupi.";
    }

    header('location:kasir.php');
} else {
    header('location:kasir.php');
}
?>
