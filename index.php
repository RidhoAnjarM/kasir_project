<?php

include "config.php";
session_start();
include "akses.php";

// Query untuk mendapatkan total produk
$totalProdukQuery = "SELECT COUNT(*) AS total_produk FROM barang";
$totalProdukResult = mysqli_query($dbconnect, $totalProdukQuery);
$totalProdukRow = mysqli_fetch_assoc($totalProdukResult);
$totalProduk = $totalProdukRow['total_produk'];

// Query untuk mendapatkan total penjualan
$totalPenjualanQuery = "SELECT SUM(total) AS total_penjualan FROM transaksi";
$totalPenjualanResult = mysqli_query($dbconnect, $totalPenjualanQuery);
$totalPenjualanRow = mysqli_fetch_assoc($totalPenjualanResult);
$totalPenjualan = $totalPenjualanRow['total_penjualan'];

// Query untuk mendapatkan total transaksi
$totalTransaksiQuery = "SELECT COUNT(*) AS total_transaksi FROM transaksi";
$totalTransaksiResult = mysqli_query($dbconnect, $totalTransaksiQuery);
$totalTransaksiRow = mysqli_fetch_assoc($totalTransaksiResult);
$totalTransaksi = $totalTransaksiRow['total_transaksi'];

// Query untuk mendapatkan total user
$totalUserQuery = "SELECT COUNT(*) AS total_user FROM user";
$totalUserResult = mysqli_query($dbconnect, $totalUserQuery);
$totalUserRow = mysqli_fetch_assoc($totalUserResult);
$totalUser = $totalUserRow['total_user'];

// Query untuk mendapatkan total produk terjual
$totalProdukTerjualQuery = "SELECT SUM(qty) AS total_produk_terjual FROM transaksi_detail";
$totalProdukTerjualResult = mysqli_query($dbconnect, $totalProdukTerjualQuery);
$totalProdukTerjualRow = mysqli_fetch_assoc($totalProdukTerjualResult);
$totalProdukTerjual = $totalProdukTerjualRow['total_produk_terjual'];

//buat tabel riwayat
$view = $dbconnect->query('SELECT * FROM transaksi ORDER BY tanggal_waktu DESC LIMIT 5');


?>
<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dashboard</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <style>
    .content2 {
      position: pixed;
      padding: 10px 0px;
      color: #464646;
      width: 100%;
      padding-inline: 140px;
      display: flex;
      align-items: center;
      justify-content: space-between;
    }

    .usernya {
      width: 400px;
      padding: auto;
    }

    .n {
      margin: 70px 0px 40px 0px;
    }

    .icon {
      font-size: 28px;
      margin: 100px auto;
      padding-left: 19px;
    }
    .icons{
      margin-left: 69px;
    }
    .riwayat2 {
      width: 840px;
      height: 400px;
      background: #79C9FA;
      border-radius: 1rem;
      padding: 40px;
      border: 2px solid black;
      box-shadow: 0.4rem 0.4rem #05050689;
      color: black;
    }
  </style>
</head>

<body>
  <div class="menu-container">
    <ul class="vertical-nav">
      <li>
        <a href="index.php"><i class="fa-solid fa-house" style="color: #79C9FA;"></i></a>
      </li>
      <li>
        <a href="#"><i class="fa-solid fa-boxes-stacked" style="color: #79C9FA;"></i></a>
        <div class="hover-menu">
          <ul>
            <li><a href="barang.php">Stok Barang</a></li>
            <li><a href="barang_tambah.php">Tambah Barang</a></li>
          </ul>
        </div>
      </li>
      <li>
        <a href="#"><i class="fa-solid fa-clock-rotate-left" style="color: #79C9FA;"></i></a>
        <div class="hover-menu">
          <ul>
            <li><a href="riwayat.php">Riwayat Transaksi</a></li>
          </ul>
        </div>
      </li>
      <li>
        <a href="#"><i class="fa-solid fa-money-bill" style="color: #79C9FA;"></i></a>
        <div class="hover-menu">
          <ul>
            <li><a href="hasil-hari.php">Per-Hari</a></li>
            <li><a href="hasil-bulan.php">Per-Bulan</a></li>
            <li><a href="hasil-tahun.php">Per-Tahun</a></li>
          </ul>
        </div>
      </li>
      <li>
        <a href="#"><i class="fa-solid fa-user" style="color: #79C9FA;"></i></a>
        <div class="hover-menu">
          <ul>
            <li><a href="user.php">User</a></li>
            <li><a href="user_tambah.php">Tambah User</a></li>
          </ul>
        </div>
      </li>
      <li class="log-out">
        <a title="Sign out" href="logout.php"><i class="fa-solid fa-right-from-bracket"></i></i></a>
      </li>
    </ul>
  </div>
  <div class="navigasi">
    <img src="assets/r.png" alt="logo" width="50px">
    <h1>Dashboard</h1>
    <div class="nama">
      <h2><i class="fa-solid fa-user" style="color: black;"></i> <?= $_SESSION['nama'] ?></h2>
    </div>
  </div>
  <div class="content">
    <div class="cards">
      <div class="card">
        <div class="pricing-block-content">
          <p class="pricing-plan">Total Produk</p>
          <p class="number"><?= $totalProduk ?></p>
        </div>
      </div>
      <div class="card">
        <div class="pricing-block-content">
          <p class="pricing-plan">Produk Terjual</p>
          <p class="number"><?= $totalProdukTerjual ?></p>
        </div>
      </div>
      <div class="card">
        <div class="pricing-block-content">
          <p class="pricing-plan">Total Transaksi</p>
          <p class="number"><?= $totalTransaksi ?></p>
        </div>
      </div>
      <div class="card">
        <div class="pricing-block-content">
          <p class="pricing-plan">Total Penjualan </p>
          <p class="number">Rp. <?= number_format($totalPenjualan, 0, ',', '.') ?></p>
        </div>
      </div>
    </div>
  </div>

  <div class="content2">
    <div class="riwayat2">
      <p class="pricing-plan">Riwayat Transaksi Terakhir</p>
      <table border="1" class="tabel">
        <tr bgcolor="#004b84">
          <th>#ID</th>
          <th>Tanggal</th>
          <th>Total</th>
          <th>Kasir</th>
        </tr>
        <tr>
          <?php
          while ($row = $view->fetch_array()) { ?>
          <tr>
            <td> <?= $row['nomor'] ?> </td>
            <td><?= $row['tanggal_waktu'] ?></td>
            <td><?= $row['total'] ?></td>
            <td><?= $row['nama'] ?></td>
          </tr>

        <?php }
          ?>
        </tr>
      </table>
    </div>
    <div class="usernya">
      <p class="pricing-plan">Admin</p>
      <p class="number n">Nama Admin = <?= $_SESSION['nama'] ?></p>
      <p class="number ">Total User = <?= $totalUser ?></p>
      <div class="icons">
      <a href=""><i class="fa-brands fa-facebook icon" style="color: #2626c7;"></i></a>
      <a href=""><i class="fa-brands fa-instagram icon" style="color: #ff006a;"></i></a>
      <a href=""><i class="fa-brands fa-tiktok icon" style="color: #000000;"></i></a>
      <a href=""><i class="fa-brands fa-github icon" style="color: #000000;"></i></a>
      </div>
    </div>
  </div>
  <footer>
    <p>&copy;RidhoAnjar_18 2024</p><br>

  </footer>
</body>

</html>