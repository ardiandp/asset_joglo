<?php include 'db.php'; 
require 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Tambah Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2>Tambah Aset</h2>
    <form method="POST" action="">
        <div class="row">
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Kode Aset</label>
                    <input type="text" name="kode_aset" class="form-control" readonly 
                           value="<?= 'AS-' . sprintf('%04d', mysqli_num_rows(mysqli_query($koneksi, "SELECT * FROM aset")) + 1) ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nama Aset</label>
                    <input type="text" name="nama_aset" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kategori</label>
                    <input type="text" name="kategori" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Lokasi</label>
                    <input type="text" name="lokasi" class="form-control" required>
                </div>
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Tanggal Perolehan</label>
                    <input type="date" name="tanggal_perolehan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Nilai Perolehan</label>
                    <input type="number" step="0.01" name="nilai_perolehan" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Kondisi</label>
                    <select name="kondisi" class="form-control" required>
                        <option value="baik">Baik</option>
                        <option value="rusak ringan">Rusak Ringan</option>
                        <option value="rusak berat">Rusak Berat</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label class="form-label">Keterangan</label>
                    <textarea name="keterangan" class="form-control"></textarea>
                </div>
            </div>
        </div>
        <button type="submit" name="simpan" class="btn btn-success">Simpan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>

    <?php
    if (isset($_POST['simpan'])) {
        $sql = "INSERT INTO aset (kode_aset, nama_aset, kategori, lokasi, tanggal_perolehan, nilai_perolehan, kondisi, keterangan)
                VALUES (
                    '{$_POST['kode_aset']}',
                    '{$_POST['nama_aset']}',
                    '{$_POST['kategori']}',
                    '{$_POST['lokasi']}',
                    '{$_POST['tanggal_perolehan']}',
                    '{$_POST['nilai_perolehan']}',
                    '{$_POST['kondisi']}',
                    '{$_POST['keterangan']}'
                )";
        mysqli_query($koneksi, $sql);
        echo "<script>window.location='asset.php';</script>";
    }
    ?>
</body>
</html>

<?php include 'footer.php'; ?>
