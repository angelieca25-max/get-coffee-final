<?php
session_start();

if (!isset($_SESSION['status']) || $_SESSION['status'] !== 'login') {
    header('Location: ../login.php');
    exit;
}

include '../koneksi.php';

$currentAdminId = isset($_SESSION['id_admin']) ? intval($_SESSION['id_admin']) : null;
$currentAdminUsername = isset($_SESSION['username']) ? $_SESSION['username'] : 'Admin';

function sanitize($conn, $value) {
    return mysqli_real_escape_string($conn, trim($value));
}

function logAdminAction($conn, $actorId, $activity, $targetId = null, $details = '') {
    if (!$actorId) {
        return;
    }

    $actorId = intval($actorId);
    $targetValue = is_numeric($targetId) ? intval($targetId) : 'NULL';
    $activity = mysqli_real_escape_string($conn, trim($activity));
    $details = mysqli_real_escape_string($conn, trim($details));
    $ipAddress = mysqli_real_escape_string($conn, $_SERVER['REMOTE_ADDR'] ?? '');

    $sql = "INSERT INTO admin_history (admin_id, target_admin_id, activity, details, ip_address, created_at) VALUES ($actorId, $targetValue, '$activity', '$details', '$ipAddress', NOW())";
    mysqli_query($conn, $sql);
}

$message = '';
$editMode = false;
$editAdmin = [
    'id_admin' => '',
    'username' => '',
    'nama_lengkap' => '',
    'role' => 'admin'
];

if (isset($_POST['tambah_admin'])) {
    $username = sanitize($koneksi, $_POST['username']);
    $password = sanitize($koneksi, $_POST['password']);
    $namaLengkap = sanitize($koneksi, $_POST['nama_lengkap']);
    $role = sanitize($koneksi, $_POST['role']);

    if ($username === '' || $password === '') {
        $message = 'Username dan password wajib diisi.';
    } else {
        $exists = mysqli_query($koneksi, "SELECT id_admin FROM admin WHERE username = '$username'");
        if (mysqli_num_rows($exists) > 0) {
            $message = 'Username sudah digunakan. Pilih username lain.';
        } else {
            $insert = mysqli_query($koneksi, "INSERT INTO admin (username, password, nama_lengkap, role, created_at, updated_at) VALUES ('$username', '$password', '$namaLengkap', '$role', NOW(), NOW())");
            if ($insert) {
                logAdminAction($koneksi, $currentAdminId, 'Tambah Akun Admin', mysqli_insert_id($koneksi), "username=$username, role=$role");
                $message = 'Akun admin berhasil ditambahkan.';
            } else {
                $message = 'Gagal menambahkan akun admin: ' . mysqli_error($koneksi);
            }
        }
    }
}

if (isset($_POST['update_admin'])) {
    $idAdmin = intval($_POST['id_admin']);
    $username = sanitize($koneksi, $_POST['username']);
    $namaLengkap = sanitize($koneksi, $_POST['nama_lengkap']);
    $role = sanitize($koneksi, $_POST['role']);
    $password = isset($_POST['password']) ? sanitize($koneksi, $_POST['password']) : '';

    if ($idAdmin === 0 || $username === '') {
        $message = 'Data tidak valid untuk diubah.';
    } else {
        $duplicate = mysqli_query($koneksi, "SELECT id_admin FROM admin WHERE username = '$username' AND id_admin != '$idAdmin'");
        if (mysqli_num_rows($duplicate) > 0) {
            $message = 'Username sudah dipakai oleh akun lain.';
        } else {
            $updateFields = "username = '$username', nama_lengkap = '$namaLengkap', role = '$role', updated_at = NOW()";
            if ($password !== '') {
                $updateFields .= ", password = '$password'";
            }
            $update = mysqli_query($koneksi, "UPDATE admin SET $updateFields WHERE id_admin = '$idAdmin'");

            if ($update) {
                logAdminAction($koneksi, $currentAdminId, 'Perbarui Akun Admin', $idAdmin, "username=$username, role=$role");
                $message = 'Data akun berhasil diperbarui.';
            } else {
                $message = 'Gagal memperbarui akun: ' . mysqli_error($koneksi);
            }
        }
    }
}

if (isset($_GET['hapus_admin'])) {
    $deleteId = intval($_GET['hapus_admin']);
    if ($deleteId === $currentAdminId) {
        $message = 'Anda tidak dapat menghapus akun yang sedang aktif.';
    } else {
        $delete = mysqli_query($koneksi, "DELETE FROM admin WHERE id_admin = '$deleteId'");
        if ($delete) {
            logAdminAction($koneksi, $currentAdminId, 'Hapus Akun Admin', $deleteId, 'Akun dihapus dari daftar admin');
            header('Location: kelola-admin.php?message=' . urlencode('Akun admin berhasil dihapus.'));
            exit;
        } else {
            $message = 'Gagal menghapus akun: ' . mysqli_error($koneksi);
        }
    }
}

if (isset($_GET['edit_admin'])) {
    $editId = intval($_GET['edit_admin']);
    $result = mysqli_query($koneksi, "SELECT id_admin, username, nama_lengkap, role FROM admin WHERE id_admin = '$editId'");
    if ($row = mysqli_fetch_assoc($result)) {
        $editMode = true;
        $editAdmin = $row;
    } else {
        $message = 'Akun admin tidak ditemukan.';
    }
}

$usersResult = mysqli_query($koneksi, "SELECT id_admin, username, nama_lengkap, role, created_at, updated_at FROM admin ORDER BY id_admin ASC");
$historyResult = mysqli_query($koneksi, "SELECT h.*, a.username AS actor_username, t.username AS target_username FROM admin_history h LEFT JOIN admin a ON a.id_admin = h.admin_id LEFT JOIN admin t ON t.id_admin = h.target_admin_id ORDER BY h.created_at DESC LIMIT 50");

if (isset($_GET['message'])) {
    $message = sanitize($koneksi, $_GET['message']);
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Admin - Get Coffee</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bg: #f4f1ed;
            --surface: #ffffff;
            --primary: #6f4e37;
            --primary-soft: #e9d4ba;
            --text: #2f2f2f;
            --muted: #7f7f7f;
            --danger: #c0392b;
            --success: #27ae60;
            --border: #d8d3cd;
        }
        * { box-sizing: border-box; }
        body {
            margin: 0;
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg);
            color: var(--text);
            min-height: 100vh;
            padding: 24px;
        }
        .page-shell {
            max-width: 1200px;
            margin: 0 auto;
        }
        .header {
            display: flex;
            flex-wrap: wrap;
            justify-content: space-between;
            gap: 16px;
            align-items: center;
            margin-bottom: 24px;
        }
        .header h1 {
            margin: 0;
            font-size: 28px;
            letter-spacing: 0.3px;
        }
        .header .subtext {
            color: var(--muted);
            font-size: 0.95rem;
        }
        .card {
            background: var(--surface);
            border: 1px solid var(--border);
            border-radius: 18px;
            box-shadow: 0 18px 40px rgba(0,0,0,0.06);
            padding: 24px;
            margin-bottom: 24px;
        }
        .nav-actions {
            display: flex;
            flex-wrap: wrap;
            gap: 12px;
            align-items: center;
            justify-content: flex-end;
        }
        .btn {
            display: inline-flex;
            text-decoration: none;
            border: none;
            cursor: pointer;
            font-weight: 700;
            border-radius: 12px;
            padding: 12px 16px;
            transition: transform 0.18s ease, background-color 0.18s ease;
        }
        .btn:hover { transform: translateY(-1px); }
        .btn-primary { background: var(--primary); color: #fff; }
        .btn-secondary { background: var(--primary-soft); color: var(--text); }
        .btn-danger { background: var(--danger); color: #fff; }
        .message { margin-bottom: 20px; padding: 14px 18px; border-radius: 14px; border: 1px solid transparent; }
        .message.success { background: #eaf7ef; color: #1f6d3b; border-color: #c7eed3; }
        .message.error { background: #fde6e6; color: #933333; border-color: #f2c7c7; }
        .grid-2 { display: grid; grid-template-columns: 1.2fr 1fr; gap: 24px; }
        .grid-3 { display: grid; grid-template-columns: 1fr 1fr 1fr; gap: 20px; }
        .form-row { display: grid; gap: 10px; }
        label { display: block; font-size: 0.92rem; margin-bottom: 6px; color: var(--muted); }
        input, select { width: 100%; padding: 12px 14px; border: 1px solid var(--border); border-radius: 12px; background: #fff; font-size: 0.95rem; color: var(--text); }
        input:focus, select:focus { outline: none; border-color: var(--primary); box-shadow: 0 0 0 3px rgba(111,78,55,0.12); }
        table { width: 100%; border-collapse: collapse; margin-top: 16px; }
        th, td { text-align: left; padding: 14px 12px; border-bottom: 1px solid #ece8e4; }
        th { color: var(--primary); font-size: 0.95rem; font-weight: 700; }
        td { font-size: 0.93rem; color: #4c4c4c; }
        tr:hover td { background: #faf6f2; }
        .badge { display: inline-flex; align-items: center; gap: 6px; padding: 6px 10px; font-size: 0.82rem; border-radius: 999px; text-transform: capitalize; }
        .badge-superadmin { background: rgba(111,78,55,0.14); color: var(--primary); }
        .badge-admin { background: rgba(108,95,125,0.12); color: #5b3b1f; }
        .badge-operator { background: rgba(41,128,185,0.14); color: #1d4f8f; }
        .text-muted { color: var(--muted); font-size: 0.88rem; }
        .history-table { overflow-x: auto; }
        .note { font-size: 0.88rem; color: var(--muted); margin-top: 8px; }
        @media (max-width: 900px) { .grid-2 { grid-template-columns: 1fr; } }
        @media (max-width: 640px) { .header { flex-direction: column; align-items: flex-start; } }
    </style>
</head>
<body>
<div class="page-shell">
    <div class="header">
        <div>
            <h1>Kelola Akun Pengelola</h1>
            <p class="subtext">Buat, hapus, dan atur hak akses akun admin serta lihat riwayat aktivitas setiap pengelola.</p>
        </div>
        <div class="nav-actions">
            <a href="dashboard.php" class="btn btn-secondary">← Kembali ke Dashboard</a>
            <a href="kelola-admin.php#form" class="btn btn-primary">Tambah Akun Baru</a>
        </div>
    </div>

    <?php if ($message !== ''): ?>
    <div class="message success"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <div class="grid-2">
        <div class="card">
            <h2 style="margin-top: 0;">Form Akun Pengelola</h2>
            <form method="POST" action="kelola-admin.php#form">
                <input type="hidden" name="id_admin" value="<?php echo htmlspecialchars($editAdmin['id_admin']); ?>">

                <div class="form-row">
                    <label for="username">Username</label>
                    <input type="text" id="username" name="username" required value="<?php echo htmlspecialchars($editAdmin['username']); ?>">
                </div>
                <div class="form-row">
                    <label for="nama_lengkap">Nama Lengkap</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" value="<?php echo htmlspecialchars($editAdmin['nama_lengkap']); ?>" placeholder="Nama lengkap pengelola">
                </div>
                <div class="form-row">
                    <label for="role">Hak Akses</label>
                    <select id="role" name="role" required>
                        <option value="superadmin" <?php echo $editAdmin['role'] === 'superadmin' ? 'selected' : ''; ?>>Superadmin</option>
                        <option value="admin" <?php echo $editAdmin['role'] === 'admin' ? 'selected' : ''; ?>>Admin</option>
                        <option value="operator" <?php echo $editAdmin['role'] === 'operator' ? 'selected' : ''; ?>>Operator</option>
                    </select>
                </div>
                <div class="form-row">
                    <label for="password"><?php echo $editMode ? 'Ubah Password (biarkan kosong jika tidak ingin mengubah)' : 'Password'; ?></label>
                    <input type="password" id="password" name="password" <?php echo $editMode ? '' : 'required'; ?> placeholder="Masukkan password baru">
                </div>

                <div class="form-row" style="margin-top: 10px; display: flex; gap: 10px; flex-wrap: wrap;">
                    <?php if ($editMode): ?>
                        <button type="submit" name="update_admin" class="btn btn-primary">Simpan Perubahan</button>
                        <a href="kelola-admin.php" class="btn btn-secondary">Batalkan</a>
                    <?php else: ?>
                        <button type="submit" name="tambah_admin" class="btn btn-primary">Tambah Akun</button>
                    <?php endif; ?>
                </div>
            </form>
            <p class="note">Role <strong>Superadmin</strong> memiliki hak utama, sementara <strong>Admin</strong> dan <strong>Operator</strong> dapat dijadikan akun pengelola dengan hak akses berbeda.</p>
        </div>

        <div class="card">
            <h2 style="margin-top: 0;">Daftar Akun Pengelola</h2>
            <div class="history-table">
                <table>
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Username</th>
                            <th>Nama Lengkap</th>
                            <th>Role</th>
                            <th>Terdaftar</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $no = 1; while ($user = mysqli_fetch_assoc($usersResult)): ?>
                        <tr>
                            <td><?php echo $no++; ?></td>
                            <td><?php echo htmlspecialchars($user['username']); ?></td>
                            <td><?php echo htmlspecialchars($user['nama_lengkap'] ?: '-'); ?></td>
                            <td><span class="badge badge-<?php echo htmlspecialchars($user['role']); ?>"><?php echo htmlspecialchars($user['role']); ?></span></td>
                            <td><?php echo htmlspecialchars(date('d M Y', strtotime($user['created_at'] ?: 'now'))); ?></td>
                            <td style="white-space: nowrap;">
                                <a href="kelola-admin.php?edit_admin=<?php echo $user['id_admin']; ?>#form" class="btn btn-secondary" style="font-size:0.82rem; padding: 8px 10px;">Edit</a>
                                <?php if ($user['id_admin'] != $currentAdminId): ?>
                                    <a href="kelola-admin.php?hapus_admin=<?php echo $user['id_admin']; ?>" class="btn btn-danger" style="font-size:0.82rem; padding: 8px 10px;" onclick="return confirm('Yakin ingin menghapus akun admin ini?');">Hapus</a>
                                <?php else: ?>
                                    <span class="text-muted" style="font-size:0.82rem;">Akun aktif</span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <?php endwhile; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="card">
        <h2>Riwayat Aktivitas Admin</h2>
        <div class="history-table">
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Waktu</th>
                        <th>Oleh</th>
                        <th>Target</th>
                        <th>Kegiatan</th>
                        <th>Detail</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (mysqli_num_rows($historyResult) > 0): ?>
                        <?php $historyNo = 1; while ($history = mysqli_fetch_assoc($historyResult)): ?>
                        <tr>
                            <td><?php echo $historyNo++; ?></td>
                            <td><?php echo htmlspecialchars(date('d M Y H:i', strtotime($history['created_at']))); ?></td>
                            <td><?php echo htmlspecialchars($history['actor_username'] ?: 'Unknown'); ?></td>
                            <td><?php echo htmlspecialchars($history['target_username'] ?: '-'); ?></td>
                            <td><?php echo htmlspecialchars($history['activity']); ?></td>
                            <td><?php echo htmlspecialchars($history['details'] ?: '-'); ?></td>
                        </tr>
                        <?php endwhile; ?>
                    <?php else: ?>
                        <tr>
                            <td colspan="6" style="text-align: center; color: #7f7f7f; padding: 24px;">Belum ada riwayat aktivitas admin.</td>
                        </tr>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
</body>
</html>
