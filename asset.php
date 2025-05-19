<?php include 'db.php'; 
require 'header.php';
?>
<!DOCTYPE html>
<html>
<head>
    <title>Data Aset</title>
    <!-- Bootstrap 5 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- DataTables Bootstrap 5 -->
    <link href="https://cdn.datatables.net/1.13.6/css/dataTables.bootstrap5.min.css" rel="stylesheet">
    <!-- Buttons -->
    <link href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.bootstrap5.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>
<body class="container py-4">
    <h2 class="mb-4">Daftar Aset</h2>
    <a href="asset_tambah.php" class="btn btn-success mb-3">+ Tambah Aset</a>

    <div class="table-responsive">
        <table id="table-aset" class="table table-bordered table-striped table-hover" style="width:100%">
            <thead class="table-dark">
                <tr>
                    <th>Kode Aset</th>
                    <th>Nama Aset</th>
                    <th>Kategori</th>
                    <th>Foto</th>
                    <th>Nilai</th>
                    <th>Jumlah</th>
                    <th>Total</th>
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
                        <td>";
                            if (!empty($data['foto'])) {
                                echo "<img src='data:image/jpg;base64,{$data['foto']}' width='80'>";
                            } else {
                                echo "<span class='text-muted'>Tidak ada foto</span>";
                            }
                    echo "</td>
                        <td class='text-end'>Rp " . number_format($data['nilai_perolehan'], 2, ',', '.') . "</td>
                        <td class='text-center'>{$data['jumlah']}</td>
                        <td class='text-end'>Rp " . number_format($data['jumlah'] * $data['nilai_perolehan'], 2, ',', '.') . "</td>
                        <td class='text-center'>
                            <span class='badge bg-" . 
                                ($data['kondisi'] == 'baik' ? 'success' : ($data['kondisi'] == 'rusak ringan' ? 'warning' : 'danger')) . "'>
                                {$data['kondisi']}
                            </span>
                        </td>
                        <td class='text-center'>
                            <a href='asset_edit.php?id={$data['id']}' class='btn btn-sm btn-warning'>
                                <i class='fas fa-edit me-1'></i>Edit
                            </a>
                            <a href='asset_hapus.php?id={$data['id']}' onclick='return confirm(\"Hapus aset ini?\")' class='btn btn-sm btn-danger'>
                                <i class='fas fa-trash-alt me-1'></i>Hapus
                            </a>
                        </td>
                    </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.7.1.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/dataTables.bootstrap5.min.js"></script>

    <!-- DataTables Export -->
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.bootstrap5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.2.7/vfs_fonts.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.print.min.js"></script>

    <script>
        $(document).ready(function () {
            $('#table-aset').DataTable({
                "ordering": true,
                "autoWidth": false,
                "scrollX": true,
                dom: 'Bfrtip',
                buttons: [
                    {
                        extend: 'excelHtml5',
                        text: '<i class="fas fa-file-excel me-1"></i> Excel',
                        className: 'btn btn-success btn-sm'
                    },
                    {
                        extend: 'pdfHtml5',
                        text: '<i class="fas fa-file-pdf me-1"></i> PDF',
                        className: 'btn btn-danger btn-sm',
                        orientation: 'landscape',
                        pageSize: 'A4',
                        exportOptions: {
                            columns: ':not(:last-child)' // exclude the Aksi column
                        }
                    },
                    {
                        extend: 'print',
                        text: '<i class="fas fa-print me-1"></i> Print',
                        className: 'btn btn-secondary btn-sm'
                    }
                ]
            });
        });
    </script>
</body>
</html>

<?php require 'footer.php'; ?>
