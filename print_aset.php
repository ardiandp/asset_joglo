<?php
include 'db.php';
$id = $_GET['id'];
$data = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT * FROM aset WHERE id = $id"));
?>

<!DOCTYPE html>
<html>
<head>
    <title>Cetak Data Aset</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 40px;
        }
        h2 {
            text-align: center;
            margin-bottom: 40px;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        td {
            padding: 8px;
            vertical-align: top;
        }
        .label {
            width: 30%;
            font-weight: bold;
        }
        .foto {
            margin-top: 30px;
            text-align: center;
        }
        .foto img {
            width: 250px;
            border: 1px solid #000;
            padding: 5px;
        }
        @media print {
            button#print {
                display: none;
            }
        }
    </style>
</head>
<body>

    <button id="print" onclick="window.print()" style="float: right; margin-bottom: 20px;">🖨 Cetak</button>

    <h2>Data Aset</h2>

    <table>
        <tr>
            <td class="label">Nama Aset</td>
            <td>: <?= htmlspecialchars($data['nama_aset']) ?></td>
        </tr>
        <tr>
            <td class="label">Kategori</td>
            <td>: <?= htmlspecialchars($data['kategori']) ?></td>
        </tr>
        <tr>
            <td class="label">Lokasi</td>
            <td>: <?= htmlspecialchars($data['lokasi']) ?></td>
        </tr>
        <tr>
            <td class="label">Tanggal Perolehan</td>
            <td>: <?= htmlspecialchars($data['tanggal_perolehan']) ?></td>
        </tr>
        <tr>
            <td class="label">Nilai Perolehan</td>
            <td>: Rp <?= number_format($data['nilai_perolehan'], 2, ',', '.') ?></td>
        </tr>
        <tr>
            <td class="label">Jumlah</td>
            <td>: <?= htmlspecialchars($data['jumlah']) ?></td>
        </tr>
        <tr>
            <td class="label">Kondisi</td>
            <td>: <?= htmlspecialchars($data['kondisi']) ?></td>
        </tr>
        <tr>
            <td class="label">Keterangan</td>
            <td>: <?= nl2br(htmlspecialchars($data['keterangan'])) ?></td>
        </tr>
    </table>

    <?php if ($data['foto']): ?>
    <div class="foto">
        <p><strong>Foto Aset:</strong></p>
        <img src="data:image/jpeg;base64,<?= $data['foto'] ?>" alt="Foto Aset">
    </div>
    <?php endif; ?>

</body>
</html>
