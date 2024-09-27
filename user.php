<?php

include "config.php";
session_start();
include "akses.php";

$view = $dbconnect->query("SELECT u. * , r.nama as nama_role FROM user as u INNER JOIN role as r ON u.role_id= r.id_role");

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>User</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
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
	</ul>
</div>
<div class="navigasi">
  <img src="assets/r.png" alt="logo" width="50px">
  <h1>List User</h1>
  <div class="nama">
    <h2><i class="fa-solid fa-user" style="color: black;"></i> <?=$_SESSION['nama']?></h2>
  </div>
</div>
<div class="content4">
  <div class="user">
        <table border="1" class="tuser">
    <tr bgcolor="#004b84">
      <th>ID User</th>
      <th>Nama</th>
      <th>Username</th>
      <th>Password</th>
      <th>Role Akses</th>
      <th>Aksi</th>
    </tr>
    
    <?php 
   
    while ($row = $view->fetch_array()) { ?>
    
    <tr>
      <td> <?=$row['id_user'] ?></td>
      <td> <?=$row['nama'] ?></td>
      <td> <?=$row['username'] ?></td>
      <td> <?=$row['password'] ?></td>
      <td> <?=$row['nama_role'] ?></td>
      <td>
        <a href="user_aksi.php?id=<?= $row['id_user']?>" class="edit"><i class="fa-solid fa-pen-to-square" style="color: #004B84;"></i></a> | 
        <a href="user_hapus.php?id=<?=$row['id_user']?>" onclick="return confirm('yakin mau dihapus')" class="hapus"><i class="fa-solid fa-trash" style="color: #dc6c6c;"></i></a>
      </td>
    </tr>
    
    <?php }?> 
    </table>
  </div>
</div>
</body>
</html>