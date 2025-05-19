<?php include 'db.php';
require 'header.php'; ?>
<?php
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM aset WHERE id = $id"));
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Aset</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-4">
    <h2>Edit Aset</h2>
    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Nama Aset</label>
            <input type="text" name="nama_aset" class="form-control" value="<?= $data['nama_aset'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kategori</label>
            <input type="text" name="kategori" class="form-control" value="<?= $data['kategori'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Lokasi</label>
            <input type="text" name="lokasi" class="form-control" value="<?= $data['lokasi'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Tanggal Perolehan</label>
            <input type="date" name="tanggal_perolehan" class="form-control" value="<?= $data['tanggal_perolehan'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Nilai</label>
            <input type="number" name="nilai_perolehan" step="0.01" class="form-control" value="<?= $data['nilai_perolehan'] ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Kondisi</label>
            <select name="kondisi" class="form-control">
                <option <?= $data['kondisi'] == 'baik' ? 'selected' : '' ?>>baik</option>
                <option <?= $data['kondisi'] == 'rusak ringan' ? 'selected' : '' ?>>rusak ringan</option>
                <option <?= $data['kondisi'] == 'rusak berat' ? 'selected' : '' ?>>rusak berat</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Keterangan</label>
            <textarea name="keterangan" class="form-control"><?= $data['keterangan'] ?></textarea>
        </div>
        <button type="submit" name="update" class="btn btn-primary">Update</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>

    <?php
    if (isset($_POST['update'])) {
        $sql = "UPDATE aset SET 
            nama_aset = '{$_POST['nama_aset']}',
            kategori = '{$_POST['kategori']}',
            lokasi = '{$_POST['lokasi']}',
            tanggal_perolehan = '{$_POST['tanggal_perolehan']}',
            nilai_perolehan = '{$_POST['nilai_perolehan']}',
            kondisi = '{$_POST['kondisi']}',
            keterangan = '{$_POST['keterangan']}'
            WHERE id = $id";
        mysqli_query($koneksi, $sql);
        echo "<script>window.location='asset.php';</script>";
    }
    ?>
</body>
</html>

<?php include 'footer.php'; ?>