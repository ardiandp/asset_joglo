<?php
include 'db.php';
include 'header.php';
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id = $id");
$data = mysqli_fetch_assoc($query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Update Transaksi</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <h1>Update Transaksi</h1>
        <form action="" method="post">
            <input type="hidden" name="id" value="<?= $id ?>">
            <div class="mb-3">
                <label for="no_invoice" class="form-label">No. Invoice</label>
                <input type="text" name="no_invoice" id="no_invoice" class="form-control" value="<?= $data['no_invoice'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="tanggal" class="form-label">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" class="form-control" value="<?= $data['tanggal'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="nama" class="form-label">Nama</label>
                <input type="text" name="nama" id="nama" class="form-control" value="<?= $data['nama'] ?>" required>
            </div>
            <div class="mb-3">
                <label for="keterangan" class="form-label">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="form-control" rows="3"><?= $data['keterangan'] ?></textarea>
            </div>
            <div class="mb-3">
                <label for="jumlah" class="form-label">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" class="form-control" value="<?= $data['jumlah'] ?>" step="0.01" required>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select name="status" id="status" class="form-select">
                    <option value="lunas" <?= $data['status'] == 'lunas' ? 'selected' : '' ?>>Lunas</option>
                    <option value="belum lunas" <?= $data['status'] == 'belum lunas' ? 'selected' : '' ?>>Belum Lunas</option>
                </select>
            </div>
            <button type="submit" name="update" class="btn btn-primary">Update</button>
            <a href="index.php" class="btn btn-secondary">Kembali</a>
        </form>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-LtrjvnR4T03zJXmsYFkzblu42VTaMFm2eR5QejhZlDw6P09" crossorigin="anonymous"></script>
</body>
</html>

<?php
if (isset($_POST['update'])) {
    $id = $_POST['id'];
    $no_invoice = $_POST['no_invoice'];
    $tanggal = $_POST['tanggal'];
    $nama = $_POST['nama'];
    $keterangan = $_POST['keterangan'];
    $jumlah = $_POST['jumlah'];
    $status = $_POST['status'];

    $sql = "UPDATE transaksi SET 
        no_invoice = '$no_invoice',
        tanggal = '$tanggal',
        nama = '$nama',
        keterangan = '$keterangan',
        jumlah = '$jumlah',
        status = '$status'
        WHERE id = $id";
    mysqli_query($koneksi, $sql);
    echo "<script>window.location='index.php';</script>";
}
?>

