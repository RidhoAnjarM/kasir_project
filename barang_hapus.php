<?php
include "config.php";

// Pastikan parameter 'id' tersedia dalam URL
if (isset($_GET['id'])) {
    $id = $_GET['id'];

    // Lakukan query untuk menghapus barang berdasarkan ID
    $hapus = mysqli_query($dbconnect, "DELETE FROM barang WHERE id_barang='$id' ");

    // Periksa apakah penghapusan berhasil
    if ($hapus) {
        // Jika berhasil, arahkan kembali ke halaman barang.php
        header("location:barang.php");
    } else {
        // Jika gagal, tampilkan pesan kesalahan
        echo "Gagal menghapus barang.";
    }
} else {
    // Jika parameter 'id' tidak tersedia, tampilkan pesan kesalahan
    echo "ID barang tidak tersedia.";
}
?>
