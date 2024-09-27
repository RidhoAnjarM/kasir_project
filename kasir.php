<?php

include "config.php";
session_start();
include "akses2.php";

$sum = 0;

// Pastikan $_SESSION['cart'] telah diinisialisasi dan tidak kosong
if (isset($_SESSION['cart']) && !empty($_SESSION['cart'])) {
  foreach ($_SESSION['cart'] as $key => $value) {
    // Pastikan setiap item dalam $_SESSION['cart'] memiliki kunci 'harga' dan 'qty'
    if (isset($value['harga']) && isset($value['qty'])) {
      $sum += $value['harga'] * $value['qty'];
    }
  }
}

$barang = mysqli_query($dbconnect, "SELECT * FROM barang");

// Periksa apakah variabel 'id' telah didefinisikan di URL
if (isset($_GET['id'])) {
  $id = $_GET['id'];

  // Pastikan $_SESSION['cart'] telah diinisialisasi dan tidak kosong
  if (isset($_SESSION['cart']) && is_array($_SESSION['cart'])) {
    $cart = $_SESSION['cart'];

    // Gunakan array_filter hanya jika $cart adalah array
    if (is_array($cart)) {
      $k = array_filter($cart, function ($var) use ($id) {
        return ($var['id'] == $id);
      });

      foreach ($k as $key => $value) {
        unset($_SESSION['cart'][$key]); // Menghapus elemen sesuai dengan kunci
      }

      // Reset kembali indeks array setelah penghapusan
      $_SESSION['cart'] = array_values($_SESSION['cart']);
    }
  }
}

if (!isset($_SESSION['cart'])) {
  $_SESSION['cart'] = array();
}



?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <meta http-equiv="X-UA-Compatible" content="ie=edge">
  <title>Dashboard Kasir</title>
  <link rel="stylesheet" href="css/style-kasir.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
    integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
    crossorigin="anonymous" referrerpolicy="no-referrer" />
  <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
  <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

  <style>
    select{
      border: none;
    }
  </style>
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
    <form action="keranjang_act.php" method="post">
      <select name="id_barang" class="pilih js-example-basic-single">
        <option>Pilih Barang..</option>
        <?php while ($row = mysqli_fetch_array($barang)) { ?>
          <option value="<?= $row['id_barang'] ?>"><?= $row['nama'] ?></option>
        <?php } ?>
      </select>
      <input type="number" name="qty" placeholder="Jumlah.." class="qty">
      <span>
        <button class="tambah" type="submit">Tambah</button>
      </span>
      <span><a href="reset.php" class="reset">Reset</a></span>
    </form>
  </div>
  <div class="content2">
    <div class="contennya">
      <div class="tabelnya">
        <form action="keranjang_update.php" method="post">
          <table border="1" class="tbarang">
            <tr bgcolor="#004b84">
              <th>Nama</th>
              <th>Harga</th>
              <th>Qty</th>
              <th>Sub Total</th>
              <th>Aksi</th>
            </tr>
            <?php foreach ($_SESSION['cart'] as $key => $value) { ?>
              <tr bgcolor="#79c9fa">
                <td><?= $value['nama'] ?></td>
                <td><?= isset($value['harga']) ? number_format($value['harga']) : 'Harga tidak tersedia'; ?></td>
                <td><input type="number" name="qty[]" value="<?= $value['qty'] ?>" class="qty2"></td>
                <td>
                  <?= isset($value['harga']) && isset($value['qty']) ? number_format($value['qty'] * $value['harga']) : 'Subtotal tidak tersedia'; ?>
                </td>
                <td align="center"><a href="keranjang_hapus.php?id=<?= $value['id'] ?>" class="hps"><i class="fa-solid fa-trash"
                      style="color: #dc6c6c;"></i></a></td>
              </tr>
            <?php } ?>
          </table>
          <button type="submit" class="tambah">Update</button>
        </form>
      </div>

      <div class="bayarnya">
        <h3>Total Rp.<?= number_format($sum) ?></h3>
        <form action="transaksi_act.php" method="post">
          <input type="hidden" name="total" value="<?= $sum ?>">
          <div class="form-control">
            <input type="text" name="bayar" id="bayar" class="">
            <label>
              <span style="transition-delay:0ms">B</span><span style="transition-delay:50ms">a</span><span
                style="transition-delay:100ms">y</span><span style="transition-delay:150ms">a</span><span
                style="transition-delay:200ms">r</span>
            </label>
          </div>
          <button class="selesai" type="submit">Selesai</button>
        </form>
      </div>
    </div>
  </div>

  <script type="text/javascript">
    var bayar = document.getElementById('bayar');

    bayar.addEventListener('keyup', function (e) {
      bayar.value = formatRupiah(this.value, 'Rp. ');
    });

    function formatRupiah(angka, prefix) {
      var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split = number_string.split(','),
        sisa = split[0].length % 3,
        rupiah = split[0].substr(0, sisa),
        ribuan = split[0].substr(sisa).match(/\d{3}/gi);

      if (ribuan) {
        separator = sisa ? '.' : '';
        rupiah += separator + ribuan.join('.');
      }

      rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
      return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
    }

    function cleanRupiah(rupiah) {
      var clean = rupiah.replace(/\D/g, '');
      return clean;
    }
  </script>

  <script>
    // In your Javascript (external .js resource or <script> tag)
    $(document).ready(function () {
      $('.js-example-basic-single').select2();
    });
  </script>
</body>

</html>