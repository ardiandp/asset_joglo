<?php
//session_start();
//include 'auth.php';  // untuk cek session login
include 'db.php';
include 'header.php';

$username = $_SESSION['username'];
$pesan = '';

// Ambil data user dari database
$stmt = $koneksi->prepare("SELECT * FROM users WHERE username = ?");
$stmt->bind_param("s", $username);
$stmt->execute();
$user = $stmt->get_result()->fetch_assoc();

// Proses update data
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $telp = $_POST['telp'];
    $status = $_POST['status'];
    $role = $_POST['role'];

    $update = $koneksi->prepare("UPDATE users SET nama=?, email=?, telp=?, status=?, role=? WHERE username=?");
    $update->bind_param("ssssss", $nama, $email, $telp, $status, $role, $username);

    if ($update->execute()) {
        $pesan = "Profil berhasil diperbarui.";
        // refresh data
        $user['nama'] = $nama;
        $user['email'] = $email;
        $user['telp'] = $telp;
        $user['status'] = $status;
        $user['role'] = $role;
    } else {
        $pesan = "Gagal memperbarui profil.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Profil Pengguna</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container py-5">
    <h3 class="mb-4">Profil Pengguna</h3>

    <?php if ($pesan): ?>
        <div class="alert alert-info"><?= $pesan ?></div>
    <?php endif; ?>

    <form method="POST">
        <div class="mb-3">
            <label class="form-label">Username</label>
            <input type="text" class="form-control" value="<?= htmlspecialchars($user['username']) ?>" readonly>
        </div>
        <div class="mb-3">
            <label class="form-label">Nama</label>
            <input type="text" name="nama" class="form-control" value="<?= htmlspecialchars($user['nama']) ?>" required>
        </div>
        <div class="mb-3">
            <label class="form-label">Email</label>
            <input type="email" name="email" class="form-control" value="<?= htmlspecialchars($user['email']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Telepon</label>
            <input type="text" name="telp" class="form-control" value="<?= htmlspecialchars($user['telp']) ?>">
        </div>
        <div class="mb-3">
            <label class="form-label">Status</label>
            <select name="status" class="form-select">
                <option value="aktif" <?= $user['status'] === 'aktif' ? 'selected' : '' ?>>Aktif</option>
                <option value="nonaktif" <?= $user['status'] === 'nonaktif' ? 'selected' : '' ?>>Nonaktif</option>
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Role</label>
            <select name="role" class="form-select">
                <option value="admin" <?= $user['role'] === 'admin' ? 'selected' : '' ?>>Admin</option>
                <option value="staff" <?= $user['role'] === 'staff' ? 'selected' : '' ?>>Staff</option>
                <option value="user" <?= $user['role'] === 'user' ? 'selected' : '' ?>>User</option>
            </select>
        </div>
        <button class="btn btn-success">Simpan Perubahan</button>
        <a href="index.php" class="btn btn-secondary">Kembali</a>
    </form>
</body>
</html>


<?php include 'footer.php'; ?>