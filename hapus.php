<?php
include 'db.php';

if (isset($_GET['id'])) {
    $id = intval($_GET['id']);
    $query = mysqli_query($koneksi, "DELETE FROM transaksi WHERE id = $id");

    if ($query) {
        header("Location: index.php");
        exit();
    } else {
        echo "Gagal menghapus data.";
    }
} else {
    echo "ID tidak ditemukan.";
}
