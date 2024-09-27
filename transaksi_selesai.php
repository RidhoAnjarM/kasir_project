<?php

include "config.php";
session_start();
include "akses2.php";

$id_trx = $_GET['idtrx'];

$data = mysqli_query($dbconnect, "SELECT * FROM transaksi WHERE id_transaksi='$id_trx'");
$trx = mysqli_fetch_assoc($data);

$detail = mysqli_query($dbconnect, "SELECT transaksi_detail.*, barang.nama FROM `transaksi_detail` 
INNER JOIN barang ON transaksi_detail.id_barang=barang.id_barang WHERE transaksi_detail.id_transaksi='$id_trx'")


    ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Transaksi</title>
</head>

<body>
    <div align="center">
        <table width="500" border="0" cellpadding="1" cellspacing="0">
            <th>
                <br>TokoKu R.A.M</br>
                jl Cihanjuang Rahayu no 2210 Parongpong <br>
                Jabar, 55555
            </th>
            </tr>
            <tr align="center">
                <td>
                    <hr>
                </td>
            </tr>
            <tr>
                <td>#<?= $trx['nomor'] ?> | <?= date('d-m-Y H:1:s', strtotime($trx['tanggal_waktu'])) ?> | kasir: <?= $trx['nama'] ?>
                </td>
            </tr>
            <tr>
                <td>
                    <hr>
                </td>
            </tr>
        </table>
        <table width="500" border="0" cellpadding="1" cellspacing="0">
            <tr>
                <th>nama</th>
                <th align="right">qty</th>
                <th align="right">harga</th>
                <th align="right">total</th>
            </tr>
        </table>
        <table width="500" border="0" cellpadding="1" cellspacing="0">
            <?php while ($row = mysqli_fetch_array($detail)) { ?>
                <tr>
                    <td align="left"><?= $row['nama'] ?></td>
                    <td align="right"><?= $row['qty'] ?></td>
                    <td align="right"><?= number_format($row['harga']) ?></td>
                    <td align="right"><?= number_format($row['total']) ?></td>
                </tr>
            <?php } ?>
            <tr>
                <td colspan="4">
                    <hr>
                </td>
            </tr>
            <tr>
                <td align="right" colspan="3">Total</td>
                <td align="right"><?= number_format($trx['total']) ?></td>
            </tr>
            <tr>
                <td align="right" colspan="3">Bayar</td>
                <td align="right"><?= number_format($trx['bayar']) ?></td>
            </tr>
            <tr>
                <td align="right" colspan="3">Kembali</td>
                <td align="right"><?= number_format($trx['kembali']) ?></td>
            </tr>
        </table>
        <table width="500" border="0" cellpadding="1" cellspacing="0">
            <tr>
                <td>
                    <hr>
                </td>
            </tr>
            <tr>
                <th>TerimaKasih Telah Belanja :):</th>
            </tr>
            <tr>
                <th>SMS/CALL 0897658754</th>
            </tr>
        </table>
    </div>
</body>

</html>