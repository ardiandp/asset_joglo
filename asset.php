<?php include 'db.php'; 
require 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2 class="mb-4">Daftar Aset</h2>
    <a href="asset_tambah.php" class="btn btn-success mb-3">+ Tambah Aset</a>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Kode Aset</th>
                <th>Nama Aset</th>
                <th>Kategori</th>
                <th>Lokasi</th>
                <th>Tanggal Perolehan</th>
                <th>Nilai</th>
                <th>Kondisi</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM aset ORDER BY id DESC");
            while ($data = mysqli_fetch_assoc($query)) {
                echo "<tr>
                    <td>{$data['kode_aset']}</td>
                    <td>{$data['nama_aset']}</td>
                    <td>{$data['kategori']}</td>
                    <td>{$data['lokasi']}</td>
                    <td>{$data['tanggal_perolehan']}</td>
                    <td>Rp " . number_format($data['nilai_perolehan'], 2, ',', '.') . "</td>
                    <td><span class='badge bg-" . 
                        ($data['kondisi'] == 'baik' ? 'success' : ($data['kondisi'] == 'rusak ringan' ? 'warning' : 'danger')) .
                        "'>{$data['kondisi']}</span></td>
                    <td>
                        <a href='asset_edit.php?id={$data['id']}' class='btn btn-sm btn-primary'>Edit</a>
                        <a href='asset_hapus.php?id={$data['id']}' onclick='return confirm(\"Hapus aset ini?\")' class='btn btn-sm btn-danger'>Hapus</a>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</body>
</html>


<?php require 'footer.php'; ?>