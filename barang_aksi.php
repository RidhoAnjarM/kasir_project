<?php
include 'config.php';
session_start();

if (isset($_GET['id'])) {
  
    $id = $_GET['id'];

    $data = mysqli_query($dbconnect, "SELECT * FROM barang WHERE id_barang='$id'");
    $data = mysqli_fetch_assoc($data);
}

if (isset($_POST['update'])) {

    $id = $_GET['id'];
    
    $nama = $_POST['nama'];
    $harga = $_POST['harga'];
    $jumlah = $_POST['jumlah'];

    mysqli_query($dbconnect, "UPDATE barang SET nama='$nama', harga='$harga', jumlah='$jumlah' WHERE id_barang = '$id' ");

    header("location:barang.php");
    
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>edit barang</title>
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
					<li><a href="barang_tambah.php">Edit Barang</a></li>
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
  <h1>Edit Barang</h1>
  <div class="nama">
    <h2><i class="fa-solid fa-user" style="color: black;"></i> <?=$_SESSION['nama']?></h2>
  </div>
</div>
<div class="content4">
  <div class="formnya">
    <form action="" method="post">
      <div class="form-control">
    <input type="text" name="nama" value="<?= $data['nama'] ?>">
    <label>
        <span style="transition-delay:0ms">Na</span><span style="transition-delay:50ms">ma</span><span style="transition-delay:100ms"> </span><span style="transition-delay:150ms">Ba</span><span style="transition-delay:200ms">ra</span><span style="transition-delay:250ms">ng</span>
    </label>
</div>
      <div class="form-control">
    <input type="number" name="harga" value="<?= $data['harga'] ?>">
    <label>
        <span style="transition-delay:0ms">H</span><span style="transition-delay:50ms">a</span><span style="transition-delay:100ms">r</span><span style="transition-delay:150ms">g</span><span style="transition-delay:200ms">a</span>
    </label>
</div>
      <div class="form-control">
    <input type="number" name="jumlah" value="<?= $data['jumlah'] ?>">
    <label>
        <span style="transition-delay:0ms">J</span><span style="transition-delay:50ms">u</span><span style="transition-delay:100ms">m</span><span style="transition-delay:150ms">l</span><span style="transition-delay:200ms">a</span><span style="transition-delay:250ms">h</span>
    </label>
</div>
<input type="submit" name="update" value="Simpan" class="tambah">
    </form>
  </div>
</div>
</body>
</html>