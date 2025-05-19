<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="id">
    <?php include 'header.php';
     ?>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembayaran</title>
    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        .receipt-preview {
            background-color: #f8f9fa;
            border-radius: 8px;
            padding: 20px;
            margin-top: 20px;
            border: 1px dashed #ccc;
        }
        .badge-lunas {
            background-color: #2ecc71;
        }
        .badge-belum {
            background-color: #f39c12;
        }
        .form-section {
            margin-bottom: 20px;
            padding-bottom: 15px;
            border-bottom: 1px solid #eee;
        }
        .modal-header {
            background-color: #8e44ad;
            color: white;
        }
        .modal-content {
            border-radius: 10px;
            overflow: hidden;
        }
    </style>
</head>
<body class="container py-4">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2><i class="fas fa-file-invoice me-2"></i>Form Kwitansi</h2>
        <button type="button" class="btn btn-primary" id="btn-tambah">
            <i class="fas fa-plus-circle me-2"></i>Tambah Data
        </button>
    </div>

    <!-- Modal Form -->
    <div class="modal fade" id="modal-form" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title"><i class="fas fa-receipt me-2"></i>Form Kwitansi Pembayaran</h5>
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="simpan.php" id="form-nota">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-section">
                                    <h6><i class="fas fa-user-circle me-2"></i>Data Pelanggan</h6>
                                    <div class="mb-3">
                                        <label class="form-label">Nama Lengkap</label>
                                        <input type="text" name="nama" class="form-control" required>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">No. Telepon</label>
                                        <input type="tel" name="telepon" class="form-control">
                                    </div>
                                </div>

                                <div class="form-section">
                                    <h6><i class="fas fa-money-bill-wave me-2"></i>Pembayaran</h6>
                                    <div class="mb-3">
                                        <label class="form-label">Jumlah Pembayaran</label>
                                        <div class="input-group">
                                            <span class="input-group-text">Rp</span>
                                            <input type="number" name="jumlah" step="1000" class="form-control" required>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Status Pembayaran</label>
                                        <select name="status" class="form-select" required>
                                            <option value="lunas">Lunas</option>
                                            <option value="belum lunas">Belum Lunas</option>
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-section">
                                    <h6><i class="fas fa-info-circle me-2"></i>Detail Transaksi</h6>
                                    <div class="mb-3">
                                        <label class="form-label">Keterangan Pembayaran</label>
                                        <textarea name="keterangan" class="form-control" rows="3" placeholder="Contoh: DP Gedung Joglo, Paket Wedding, dll"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <label class="form-label">Tanggal Transaksi</label>
                                        <input type="date" name="tanggal" class="form-control" value="<?= date('Y-m-d') ?>" required>
                                    </div>
                                </div>

                                <div class="receipt-preview">
                                    <h6><i class="fas fa-eye me-2"></i>Pratinjau Kwitansi</h6>
                                    <div class="small">
                                        <p class="mb-1"><strong>RUMAH JOGLO DIAN MUSTIKA</strong></p>
                                        <p class="mb-1 text-muted">Jl TPU Bojong Nangka no 88 - Kelapa Dua - Tangerang</p>
                                        <p class="text-muted">Phone: 0812809180</p>
                                        <hr>
                                        <p class="mb-1"><span id="preview-nama">[Nama Pelanggan]</span></p>
                                        <p class="mb-1"><span id="preview-keterangan">[Keterangan Pembayaran]</span></p>
                                        <p class="mb-1">Rp <span id="preview-jumlah">0</span></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Tutup</button>
                    <button type="button" class="btn btn-primary" id="btn-simpan">
                        <i class="fas fa-save me-2"></i>Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </div>
<!-- Bootstrap 5 CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

<!-- DataTables BS5 CSS -->
<link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<!-- Data Table -->
<div class="table-responsive mt-3">
    <table id="table-data" class="table table-bordered table-hover table-striped w-100">
        <thead class="table-light">
            <tr>
                <th style="width: 10%">No Invoice</th>
                <th style="width: 15%">Tanggal</th>
                <th style="width: 30%">Nama</th>
                <th style="width: 20%">Jumlah</th>
                <th style="width: 10%">Status</th>
                <th style="width: 15%">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $query = mysqli_query($koneksi, "SELECT * FROM transaksi ORDER BY id DESC");
            while ($data = mysqli_fetch_assoc($query)) {
                $statusClass = ($data['status'] == 'lunas') ? 'bg-success' : 'bg-warning text-dark';
                echo "<tr>
                    <td class='text-center'>{$data['no_invoice']}</td>
                    <td class='text-center'>" . date('d-m-Y', strtotime($data['tanggal'])) . "</td>
                    <td>{$data['nama']}</td>
                    <td class='text-end'>Rp " . number_format($data['jumlah'], 2, ',', '.') . "</td>
                    <td class='text-center'>
                        <span class='badge {$statusClass}'>{$data['status']}</span>
                    </td>
                    <td class='text-center'>
                        <a class='btn btn-sm btn-outline-primary me-1' href='cetak.php?id={$data['id']}' target='_blank'>
                            <i class='fas fa-print'></i>
                        </a>
                        <a class='btn btn-sm btn-outline-warning me-1' href='edit.php?id={$data['id']}'>
                            <i class='fas fa-edit'></i>
                        </a>
                        <button class='btn btn-sm btn-outline-danger' onclick='konfirmasiHapus({$data['id']})'>
                            <i class='fas fa-trash-alt'></i>
                        </button>
                    </td>
                </tr>";
            }
            ?>
        </tbody>
    </table>
</div>

<!-- Required Scripts -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<!-- DataTables + Bootstrap 5 JS -->
<script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function () {
        $('#table-data').DataTable({
            scrollX: true,
            ordering: false,
            autoWidth: false,
            columnDefs: [
                { width: "10%", targets: 0 },
                { width: "15%", targets: 1 },
                { width: "30%", targets: 2 },
                { width: "20%", targets: 3 },
                { width: "10%", targets: 4 },
                { width: "15%", targets: 5 }
            ]
        });
    });
</script>


    <!-- JavaScript Libraries -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
    
    <script>
        // Initialize modal
        const modalForm = new bootstrap.Modal(document.getElementById('modal-form'));
        
        // Show modal when button clicked
        document.getElementById('btn-tambah').addEventListener('click', function() {
            modalForm.show();
        });
        
        // Form validation and submission
        document.getElementById('btn-simpan').addEventListener('click', function() {
            const form = document.getElementById('form-nota');
            if (form.checkValidity()) {
                form.submit();
            } else {
                form.reportValidity();
            }
        });
        
        // Real-time preview
        $('input[name="nama"], textarea[name="keterangan"], input[name="jumlah"]').on('input', function() {
            $('#preview-nama').text($('input[name="nama"]').val() || '[Nama Pelanggan]');
            $('#preview-keterangan').text($('textarea[name="keterangan"]').val() || '[Keterangan Pembayaran]');
            $('#preview-jumlah').text($('input[name="jumlah"]').val() ? 
                parseInt($('input[name="jumlah"]').val()).toLocaleString('id-ID') : '0');
        });
        
        // Delete confirmation
        function konfirmasiHapus(id) {
            if (confirm('Apakah Anda yakin ingin menghapus transaksi ini?')) {
                window.location.href = 'hapus.php?id=' + id;
            }
        }
    </script>
</body>
</html>


<?php include 'footer.php'; ?>