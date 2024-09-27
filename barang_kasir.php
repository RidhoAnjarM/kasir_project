<?php

include "config.php";
session_start();
include "akses2.php";

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Barang</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>
<body>
<div class="menu-container">
	<ul class="vertical-nav">
		<li>
			<a href="kasir.php"><i class="fa-solid fa-house" style="color: #79C9FA;"></i></a>
		</li>
		<li>
			<a href="#"><i class="fa-solid fa-boxes-stacked" style="color: #79C9FA;"></i></a>
			<div class="hover-menu">
				<ul>
					<li><a href="barang_kasir.php">Stok Barang</a></li>
				</ul>
			</div>
		</li>
		<li>
			<a href="#"><i class="fa-solid fa-clock-rotate-left" style="color: #79C9FA;"></i></a>
			<div class="hover-menu">
				<ul>
					<li><a href="riwayat_kasir.php">Riwayat Transaksi</a></li>
				</ul>
			</div>
		</li>
		<li>
			<a href="#"><i class="fa-solid fa-money-bill" style="color: #79C9FA;"></i></a>
			<div class="hover-menu">
				<ul>
					<li><a href="hasil-hari-kasir.php">Per-Hari</a></li>
					<li><a href="hasil-bulan-kasir.php">Per-Bulan</a></li>
					<li><a href="hasil-tahun-kasir.php">Per-Tahun</a></li>
				</ul>
			</div>
		</li>
	</ul>
</div>
<div class="navigasi">
  <img src="assets/r.png" alt="logo" width="50px">
  <h1>Stok Barang</h1>
  <div class="nama">
    <h2><i class="fa-solid fa-user" style="color: black;"></i> <?=$_SESSION['nama']?></h2>
  </div>
</div>
<div class="content3">
  <div class="stoknya">
    <table border="1" class="tabel2">
      <tr bgcolor="#004b84">
        <th>ID Barang</th>
        <th>Nama</th>
        <th>Harga</th>
        <th>Stok</th>
      </tr>
      
      <?php 
  $view = $dbconnect->query("SELECT * FROM barang");
  while ($row = $view->fetch_array()) { ?>
    
    <tr>
      <td> <?= $row['id_barang'] ?></td>
      <td> <?= $row['nama'] ?></td>
      <td> <?= $row['harga'] ?></td>
      <td> <?= $row['jumlah'] ?></td>
    </tr>
    
    <?php 
    }
    ?> 
    </table>
  </div>
</div>
</body>
</html>