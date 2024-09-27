<?php
include "config.php";
session_start();

// Query untuk mengambil data transaksi per hari
$query = "SELECT DATE(tanggal_waktu) AS tanggal, SUM(td.total) AS total_harian 
          FROM transaksi t
          INNER JOIN transaksi_detail td ON t.id_transaksi = td.id_transaksi 
          GROUP BY DATE(tanggal_waktu) 
          ORDER BY tanggal_waktu DESC";
$result = mysqli_query($dbconnect, $query);

?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>hasil</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css"
        integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body>
    <div align="center">
        <table width="500" border="0" cellpadding="1" cellspacing="0">
            <th>
                <br>TokoKu R.A.M</br>
                <h2>Total penjualan per-hari</h2>
            </th>
            </tr>
            <tr align="center">
                <td>
                    <hr>
                </td>
            </tr>
        </table>
        <table width="500" border="0" cellpadding="1" cellspacing="0">
            <tr>
                <th align="left">Tanggal</th>
                <th align="left">Total Penjualan</th>
            </tr>
            <tr align="center">
                <td>
                    <hr>
                </td>
                <td>
                    <hr>
                </td>
            </tr>

            <?php
            // Loop untuk menampilkan data transaksi per hari
            while ($row = mysqli_fetch_assoc($result)) {
                $tanggal = date("d F Y", strtotime($row['tanggal']));
                $total_harian = number_format($row['total_harian']);
                ?>
                <tr>
                    <td><?= $tanggal ?> =</td>
                    <td align="left">Rp. <?= $total_harian ?></td>
                </tr>
            <?php } ?>
        </table>
        <table width="500" border="0" cellpadding="1" cellspacing="0">
            <tr align="center">
                <td>
                    <hr>
                </td>
            </tr>
        </table>
        <table width="500" border="0" cellpadding="1" cellspacing="0">
            <tr align="center">
                <th>
                    jl Cihanjuang Rahayu no 2210 Parongpong <br>
                    Jabar, 55555<br>
                </th>
            </tr>
        </table>
    </div>

</body>

</html>