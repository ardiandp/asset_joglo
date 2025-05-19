<?php include 'db.php'; ?>
<!DOCTYPE html>
<html lang="id">
<head>
    <?php include 'header.php'; ?>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nota Pembayaran</title>

    <!-- Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <!-- DataTables CSS -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">

    <style>
        .receipt-preview { background-color: #f8f9fa; border-radius: 8px; padding: 20px; border: 1px dashed #ccc; margin-top: 20px; }
        .badge-lunas { background-color: #2ecc71; }
        .badge-belum { background-color: #f39c12; }
        .form-section { margin-bottom: 20px; padding-bottom: 15px; border-bottom: 1px solid #eee; }
        .modal-header { background-color: #8e44ad; color: white; }
        .modal-content { border-radius: 10px; overflow: hidden; }
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
                    <button type="button" class="btn-close btn-close-white" data-bs-dismiss="modal"></button>
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
                                        <textarea name="keterangan" class="form-control" rows="3"></textarea>
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
                    <button type="submit" form="form-nota" class="btn btn-primary">
                        <i class="fas fa-save me-2"></i>Simpan Data
                    </button>
                </div>
            </div>
        </div>
    </div>

    <!-- TABEL DATA -->
    <div class="table-responsive mt-3">
        <table id="table-data" class="table table-bordered table-striped w-100">
            <thead class="table-light">
                <tr>
                    <th>No Invoice</th>
                    <th>Tanggal</th>
                    <th>Nama</th>
                    <th>Jumlah</th>
                    <th>Status</th>
                    <th>Aksi</th>
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
                        <td class='text-center'><span class='badge {$statusClass}'>{$data['status']}</span></td>
                        <td class='text-center'>
                            <a class='btn btn-sm btn-outline-primary me-1' href='cetak.php?id={$data['id']}' target='_blank'><i class='fas fa-print'></i></a>
                            <a class='btn btn-sm btn-outline-warning me-1' href='edit.php?id={$data['id']}'><i class='fas fa-edit'></i></a>
                            <button class='btn btn-sm btn-outline-danger' onclick='konfirmasiHapus({$data['id']})'><i class='fas fa-trash-alt'></i></button>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Script JS -->
    <script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

    <!-- DataTables JS + Buttons -->
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#table-data').DataTable({
                scrollX: true,
                ordering: false,
                autoWidth: false,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        title: 'Data Transaksi'
                    },
                    {
                        extend: 'pdfHtml5',
                        title: 'Data Transaksi'
                    },
                    {
                        extend: 'print',
                        title: 'Data Transaksi'
                    }
                ]
            });

            const modalForm = new bootstrap.Modal(document.getElementById('modal-form'));
            document.getElementById('btn-tambah').addEventListener('click', () => modalForm.show());
        });

        function konfirmasiHapus(id) {
            if (confirm("Yakin ingin menghapus data ini?")) {
                window.location.href = "hapus.php?id=" + id;
            }
        }
    </script>
</body>
</html>
