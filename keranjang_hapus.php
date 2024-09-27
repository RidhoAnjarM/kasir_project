<?php
session_start();
include "config.php";

if(isset($_GET['id'])) {
    $id = $_GET['id'];

    // Temukan barang yang akan dihapus dari keranjang
    $key = array_search($id, array_column($_SESSION['cart'], 'id'));
    if($key !== false) {
        // Tambahkan kembali stok barang yang dihapus dari keranjang
        $barang_id = $_SESSION['cart'][$key]['id'];
        $barang_qty = $_SESSION['cart'][$key]['qty'];
        $update_stok = mysqli_query($dbconnect, "UPDATE barang SET jumlah = jumlah + $barang_qty WHERE id_barang = $barang_id");

        // Hapus barang dari keranjang
        unset($_SESSION['cart'][$key]);

        // Setel kembali indeks array
        $_SESSION['cart'] = array_values($_SESSION['cart']);

        $_SESSION['success'] = "Barang berhasil dihapus dari keranjang.";
        header('location:kasir.php');
    } else {
        $_SESSION['error'] = "Barang tidak ditemukan dalam keranjang.";
        header('location:kasir.php');
    }
} else {
    $_SESSION['error'] = "ID barang tidak ditemukan.";
    header('location:kasir.php');
}
?>
