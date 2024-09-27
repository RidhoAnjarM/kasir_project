<?php

include 'config.php';
session_start();

$role = mysqli_query($dbconnect, "SELECT * FROM role");

if (isset($_GET['id'])) {
    $id = $_GET['id'];

    $data = mysqli_query($dbconnect, "SELECT * FROM user WHERE id_user='$id'");
    $data = mysqli_fetch_assoc($data);
}

if (isset($_POST['update'])) {

    $id = $_GET['id'];

    $nama = $_POST['nama'];
    $username = $_POST['username'];
    $password = $_POST['password'];
    $role_id = $_POST['role_id'];

    mysqli_query($dbconnect, "UPDATE user SET nama='$nama', username='$username', password='$password', role_id='$role_id' WHERE id_user = '$id' ");

    header("location:user.php");
}

?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>aksi user</title>
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
  <h1>Edit User</h1>
  <div class="nama">
    <h2><i class="fa-solid fa-user" style="color: black;"></i> <?=$_SESSION['nama']?></h2>
  </div>
</div>
<div class="content4">
  <div class="formnya2">
    <form action="" method="post">
      <div class="form-control">
    <input type="text" name="nama" value="<?= $data['nama'] ?>">
    <label>
        <span style="transition-delay:0ms">N</span><span style="transition-delay:50ms">a</span><span style="transition-delay:100ms">m</span><span style="transition-delay:150ms">a</span>
    </label>
</div>
      <div class="form-control">
    <input type="text" name="username" value="<?= $data['username'] ?>">
    <label>
        <span style="transition-delay:0ms">U</span><span style="transition-delay:50ms">se</span><span style="transition-delay:100ms">r</span><span style="transition-delay:150ms">na</span><span style="transition-delay:200ms">me</span>
    </label>
</div>
      <div class="form-control">
    <input type="text" name="password" value="<?= $data['password'] ?>">
    <label>
        <span style="transition-delay:0ms">P</span><span style="transition-delay:50ms">a</span><span style="transition-delay:100ms">ss</span><span style="transition-delay:150ms">w</span><span style="transition-delay:200ms">o</span><span style="transition-delay:250ms">rd</span>
    </label>
</div>
<div class="form-control">
   <select class="form-control" name="role_id">
      <option value="">Pilih Role Akses</option>
        <?php while ($row = mysqli_fetch_array($role)) { ?>
      <option value="<?= $row['id_role'] ?>" <?= $row['id_role'] == $data['role_id'] ? 'selected' : '' ?>><?= $row['nama'] ?></option>
      <?php } ?>
   </select>
</div>

<input type="submit" name="update" value="Simpan" class="tambah">
    </form>
  </div>
</div>
</body>
</html>