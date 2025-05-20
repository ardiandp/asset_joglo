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
    <form method="POST" enctype="multipart/form-data">
        <div class="row">
            <div class="col-md-6">
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
            </div>
            <div class="col-md-6">
                <div class="mb-3">
                    <label class="form-label">Nilai</label>
                    <input type="number" name="nilai_perolehan" step="0.01" class="form-control" value="<?= $data['nilai_perolehan'] ?>" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Jumlah</label>
                    <input type="number" name="jumlah" class="form-control" value="<?= $data['jumlah'] ?>" required>
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
                <div class="mb-3">
                    <label class="form-label">Foto</label><br>
                    <img src="data:image/jpg;base64,<?= $data['foto'] ?>" width="200px" id="preview">
                    <input type="file" name="foto" class="form-control mt-2" accept="image/*" onchange="previewImage(event)">
                </div>
                <script>
                    function previewImage(event) {
                        var reader = new FileReader();
                        reader.onload = function(){
                            var output = document.getElementById('preview');
                            output.src = reader.result;
                        };
                        reader.readAsDataURL(event.target.files[0]);
                    }
                </script>
                <button type="submit" name="update" class="btn btn-primary">Update</button>
                <a href="asset.php" class="btn btn-secondary">Kembali</a>
            </div>
        </div>
    </form>

    <?php
if (isset($_POST['update'])) {
    $foto = $data['foto']; // Default to existing photo
    if (!empty($_FILES['foto']['tmp_name'])) {
        $foto = base64_encode(file_get_contents($_FILES['foto']['tmp_name']));
    }

    $sql = "UPDATE aset SET 
        nama_aset = '{$_POST['nama_aset']}',
        kategori = '{$_POST['kategori']}',
        lokasi = '{$_POST['lokasi']}',
        tanggal_perolehan = '{$_POST['tanggal_perolehan']}',
        nilai_perolehan = '{$_POST['nilai_perolehan']}',
        jumlah = '{$_POST['jumlah']}',
        kondisi = '{$_POST['kondisi']}',
        keterangan = '{$_POST['keterangan']}'" .
        (!empty($_FILES['foto']['tmp_name']) ? ", foto = '{$foto}'" : "") .
        " WHERE id = $id";
        
    mysqli_query($koneksi, $sql);
    echo "<script>window.location='asset.php';</script>";
}
?>
</body>
</html>

<?php include 'footer.php'; ?>
