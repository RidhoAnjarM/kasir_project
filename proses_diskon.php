<?php
// Include konfigurasi database
include "config.php";

// Inisialisasi variabel pesan error
$error = '';

// Cek apakah form telah disubmit
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Ambil data dari form
    $id_barang = $_POST['id_barang'];
    $diskon = $_POST['diskon'];

    // Validasi input
    if (empty($id_barang) || empty($diskon)) {
        $error = "Pilih barang dan masukkan nilai diskon.";
    } else {
        // Query untuk memperbarui nilai diskon barang
        $query = "UPDATE barang SET diskon = '$diskon' WHERE id_barang = '$id_barang'";
        $result = mysqli_query($dbconnect, $query);

        if ($result) {
            // Redirect ke halaman stok barang setelah berhasil memberikan diskon
            header("Location: barang.php");
            exit;
        } else {
            $error = "Gagal memberikan diskon. Silakan coba lagi.";
        }
    }
}
?>
