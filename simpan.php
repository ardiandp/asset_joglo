<?php
include 'db.php';

$nama = $_POST['nama'];
$keterangan = $_POST['keterangan'];
$jumlah = $_POST['jumlah'];
$status = $_POST['status'];
$tanggal = $_POST['tanggal'];
$no_invoice = 'INV' . date('YmdHis');

$query = "INSERT INTO transaksi (no_invoice, tanggal, nama, keterangan, jumlah, status) 
          VALUES ('$no_invoice', '$tanggal', '$nama', '$keterangan', '$jumlah', '$status')";
mysqli_query($koneksi, $query);

header('Location: index.php');
?>