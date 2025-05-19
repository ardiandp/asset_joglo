<?php
include 'db.php';
$id = $_GET['id'];
mysqli_query($koneksi, "DELETE FROM aset WHERE id = $id");
header("Location: asset.php");
