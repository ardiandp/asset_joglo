<?php
include 'db.php';
$id = $_GET['id'];
$query = mysqli_query($koneksi, "SELECT * FROM transaksi WHERE id = $id");
$data = mysqli_fetch_assoc($query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembayaran - Rumah Joglo Dian Mustika</title>
    <!-- Bootstrap CSS CDN -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
        }
        .receipt-container {
            max-width: 500px;
            margin: 20px auto;
            background: white;
            padding: 30px;
            box-shadow: 0 0 20px rgba(0,0,0,0.1);
            border-radius: 10px;
        }
        .header {
            text-align: center;
            margin-bottom: 25px;
            border-bottom: 2px dashed #eee;
            padding-bottom: 20px;
        }
        .logo {
            font-size: 24px;
            font-weight: bold;
            color: #8e44ad;
            margin-bottom: 5px;
        }
        .address {
            font-size: 12px;
            color: #777;
        }
        .title {
            font-size: 18px;
            font-weight: bold;
            text-align: center;
            margin: 20px 0;
            color: #333;
        }
        .divider {
            border-top: 1px dashed #ddd;
            margin: 15px 0;
        }
        .payment-details {
            margin: 20px 0;
        }
        .payment-row {
            display: flex;
            justify-content: space-between;
            margin-bottom: 8px;
        }
        .label {
            font-weight: 500;
            color: #555;
        }
        .value {
            font-weight: 600;
        }
        .amount {
            font-size: 24px;
            font-weight: bold;
            text-align: center;
            margin: 25px 0;
            color: #2ecc71;
        }
        .footer {
            text-align: center;
            margin-top: 30px;
            font-size: 12px;
            color: #999;
            border-top: 1px dashed #eee;
            padding-top: 15px;
        }
        .stamp {
            float: right;
            margin-top: 20px;
            opacity: 0.7;
            font-family: cursive;
            border: 2px solid #e74c3c;
            color: #e74c3c;
            padding: 5px 10px;
            transform: rotate(15deg);
            border-radius: 5px;
        }
        .signature {
            margin-top: 50px;
            text-align: right;
        }
        @media print {
            body {
                background: none;
            }
            .receipt-container {
                box-shadow: none;
                padding: 0;
                max-width: 100%;
            }
            .no-print {
                display: none;
            }
        }
    </style>
</head>
<body onload="window.print()">
    <div class="container">
        <div class="receipt-container">
            <div class="header">
                <div class="logo">
                    <i class="fas fa-home"></i> RUMAH JOGLO DIAN MUSTIKA
                </div>
                <div class="address">
                    Jl TPU Bojong Nangka no 88 - Kelapa Dua - Tangerang<br>
                    Phone: 0812809180
                </div>
            </div>
            
            <div class="title">
                NOTA PEMBAYARAN
            </div>
            
            <div class="payment-details">
                <div class="payment-row">
                    <span class="label">Tanggal:</span>
                    <span class="value"><?= date('d-m-Y', strtotime($data['tanggal'])) ?></span>
                </div>
                <div class="payment-row">
                    <span class="label">No. Invoice:</span>
                    <span class="value"><?= $data['no_invoice'] ?></span>
                </div>
                
                <div class="divider"></div>
                
                <div class="payment-row">
                    <span class="label">Sudah terima dari:</span>
                    <span class="value"><?= $data['nama'] ?></span>
                </div>
                <div class="payment-row">
                    <span class="label">Untuk pembayaran:</span>
                    <span class="value"><?= $data['keterangan'] ?></span>
                </div>
                
                <div class="divider"></div>
                
                <div class="amount">
                    Rp <?= number_format($data['jumlah'], 2, ',', '.') ?>
                </div>
                
                <div class="stamp">
                    <?= strtoupper($data['status']) ?>
                </div>
                <div style="clear: both;"></div>
                
                <div class="signature">
                    <p>Hormat Kami,</p>
                    <br><br><br>
                    <p>(___________________)</p>
                </div>
            </div>
            
            <div class="footer">
                Terima kasih atas kepercayaan Anda<br>
                Pembayaran dapat dilakukan via transfer ke:<br>
                BCA 3243279158 a.n WELLY RETNO AYU AM
            </div>
        </div>
        
        <div class="text-center no-print mt-3">
            <button onclick="window.print()" class="btn btn-primary">
                <i class="fas fa-print"></i> Cetak Nota
            </button>
        </div>
    </div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>