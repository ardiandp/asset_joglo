<?php
include 'header.php';
include 'db.php';


// Total transaksi
$total = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM transaksi"))['total'];

// Status lunas & belum lunas
$lunas = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM transaksi WHERE status = 'lunas'"))['total'];
$belum_lunas = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT COUNT(*) as total FROM transaksi WHERE status = 'belum lunas'"))['total'];

// Total uang masuk dan belum masuk
$uang_lunas = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) as total FROM transaksi WHERE status = 'lunas'"))['total'] ?? 0;
$uang_belum = mysqli_fetch_assoc(mysqli_query($koneksi, "SELECT SUM(jumlah) as total FROM transaksi WHERE status = 'belum lunas'"))['total'] ?? 0;

// Ambil data transaksi per bulan
$query_perbulan = mysqli_query($koneksi, "
    SELECT DATE_FORMAT(tanggal, '%Y-%m') AS bulan, SUM(jumlah) as total
    FROM transaksi
    GROUP BY bulan
    ORDER BY bulan ASC
");

$bulan_array = [];
$jumlah_array = [];

while ($row = mysqli_fetch_assoc($query_perbulan)) {
    $bulan_array[] = date('M Y', strtotime($row['bulan'] . '-01')); // format: Jan 2024
    $jumlah_array[] = $row['total'];
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Nota</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/chart.js@4.4.0/dist/chart.umd.min.js"></script>
</head>
<body class="container py-5">

    <h1 class="mb-4 text-center">Dashboard Nota Pembayaran</h1>

    <div class="row text-center mb-4">
        <div class="col-md-3">
            <div class="p-3 bg-primary text-white rounded shadow">
                <h5>Total Transaksi</h5>
                <h2><?= $total ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 bg-success text-white rounded shadow">
                <h5>Lunas</h5>
                <h2><?= $lunas ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 bg-warning text-dark rounded shadow">
                <h5>Belum Lunas</h5>
                <h2><?= $belum_lunas ?></h2>
            </div>
        </div>
        <div class="col-md-3">
            <div class="p-3 bg-dark text-white rounded shadow">
                <h5>Uang Masuk</h5>
                <h2>Rp <?= number_format($uang_lunas, 2, ',', '.') ?></h2>
            </div>
        </div>
    </div>

    <!-- Chart Status -->
    <div class="card shadow p-4 mb-5">
        <h5 class="mb-4">Perbandingan Uang Lunas dan Belum Lunas</h5>
        <canvas id="statusChart" height="100"></canvas>
    </div>

    <!-- Chart Perbulan -->
    <div class="card shadow p-4 mb-5">
        <h5 class="mb-4">Transaksi Per Bulan</h5>
        <canvas id="perbulanChart" height="100"></canvas>
    </div>

    <script>
        // Chart Status
        const ctx1 = document.getElementById('statusChart');
        new Chart(ctx1, {
            type: 'bar',
            data: {
                labels: ['Lunas', 'Belum Lunas'],
                datasets: [{
                    label: 'Jumlah (Rp)',
                    data: [<?= $uang_lunas ?>, <?= $uang_belum ?>],
                    backgroundColor: ['#198754', '#ffc107']
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => 'Rp ' + value.toLocaleString('id-ID')
                        }
                    }
                }
            }
        });

        // Chart Per Bulan
        const ctx2 = document.getElementById('perbulanChart');
        new Chart(ctx2, {
            type: 'bar',
            data: {
                labels: <?= json_encode($bulan_array) ?>,
                datasets: [{
                    label: 'Total Transaksi (Rp)',
                    data: <?= json_encode($jumlah_array) ?>,
                    backgroundColor: '#0d6efd'
                }]
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true,
                        ticks: {
                            callback: value => 'Rp ' + value.toLocaleString('id-ID')
                        }
                    }
                }
            }
        });
    </script>

</body>
</html>

<?php include 'footer.php'; ?>
