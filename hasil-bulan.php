<?php
include "config.php";
session_start();
include "akses.php";

// Query untuk mengambil data transaksi per bulan
$query = "SELECT DATE_FORMAT(tanggal_waktu, '%Y-%m') AS bulan, SUM(td.total) AS total_bulan 
          FROM transaksi t
          INNER JOIN transaksi_detail td ON t.id_transaksi = td.id_transaksi 
          GROUP BY DATE_FORMAT(tanggal_waktu, '%Y-%m') 
          ORDER BY tanggal_waktu DESC";
$result = mysqli_query($dbconnect, $query);

?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>penjualan perbulan</title>
  <link rel="stylesheet" href="css/style.css">
  <link rel="stylesheet" href="css/style-kasir.css">
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
  <h1>Pendapatan Per-Bulan</h1>
  <div class="nama">
    <h2><i class="fa-solid fa-user" style="color: black;"></i> <?=$_SESSION['nama']?></h2>
  </div>
</div>
<div class="content6">
  <div class="hasil">
    <table border="1" class="thasil">
	<a href="cetak-bulan.php" class="reset">Cetak</a>
      <tr bgcolor="#004b84">
        <th>Bulan</th>
        <th>Total Penjualan</th>
      </tr>
      
                <?php
                // Loop untuk menampilkan data transaksi per bulan
                while ($row = mysqli_fetch_assoc($result)) {
                    $bulan = date("F Y", strtotime($row['bulan']));
                    $total_bulan = number_format($row['total_bulan']);
                ?>
                <tr>
                    <td><?= $bulan ?></td>
                    <td>Rp. <?= $total_bulan ?></td>
                </tr>
                <?php } ?>
    </table>
  </div>
</div>
</body>
</html>