<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "get-coffee"); 

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql = "SELECT * FROM menu ORDER BY id_menu DESC";
$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu - Get Coffee</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-color: #f8f9fa;
            --card-bg: #ffffff;
            --primary-color: #6f4e37; /* Warna khas Kopi */
            --primary-hover: #5a3e2b;
            --text-main: #2d2d2d;
            --text-muted: #7c7c7c;
            --border-color: #eaeaea;
            --danger-color: #dc3545;
            --edit-color: #0d6efd;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 1100px;
            margin: 0 auto;
            background: var(--card-bg);
            padding: 30px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        }

        /* Header Styling */
        .header-area {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            border-bottom: 2px solid var(--border-color);
            padding-bottom: 20px;
        }

        .header-area h2 {
            margin: 0;
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
        }

        .nav-links a {
            text-decoration: none;
            font-size: 14px;
            font-weight: 500;
            padding: 8px 16px;
            border-radius: 8px;
            transition: all 0.3s;
        }

        .btn-back {
            color: var(--text-muted);
            margin-right: 10px;
        }

        .btn-back:hover {
            color: var(--text-main);
        }

        .btn-add {
            background-color: var(--primary-color);
            color: #fff !important;
        }

        .btn-add:hover {
            background-color: var(--primary-hover);
            transform: translateY(-2px);
        }

        /* Table Aesthetic Styling */
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 10px;
            text-align: left;
        }

        th {
            background-color: #fdfaf7;
            color: var(--primary-color);
            font-weight: 600;
            padding: 16px;
            font-size: 14px;
            border-bottom: 2px solid var(--border-color);
        }

        td {
            padding: 16px;
            border-bottom: 1px solid var(--border-color);
            font-size: 14px;
            color: #4a4a4a;
            vertical-align: middle;
        }

        tr:hover {
            background-color: #fafafa;
        }

        /* Image Styling di Tabel */
        .img-container {
            width: 60px;
            height: 60px;
            border-radius: 8px;
            overflow: hidden;
            background-color: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            border: 1px solid var(--border-color);
        }

        .img-container img {
            width: 100%;
            height: 100%;
            object-fit: cover;
        }

        .no-image {
            font-size: 11px;
            color: var(--text-muted);
            font-style: italic;
        }

        /* Badge Harga */
        .price-badge {
            font-weight: 600;
            color: var(--text-main);
        }

        /* Tombol Aksi */
        .actions a {
            text-decoration: none;
            font-size: 13px;
            font-weight: 600;
            padding: 6px 12px;
            border-radius: 6px;
            margin-right: 5px;
            display: inline-block;
            transition: background 0.2s;
        }

        .btn-edit {
            color: var(--edit-color);
            background-color: #ecf3ff;
        }

        .btn-edit:hover {
            background-color: #d7e6ff;
        }

        .btn-delete {
            color: var(--danger-color);
            background-color: #fff1f2;
        }

        .btn-delete:hover {
            background-color: #ffe4e6;
        }
    </style>
</head>
<body>

<div class="container">
    <div class="header-area">
        <h2>Kelola Menu - Admin Hub</h2>
        <div class="nav-links">
            <a href="dashboard.php" class="btn-back">← Kembali ke Dashboard</a>
            <a href="tambah-menu.php" class="btn-add">+ Tambah Menu Baru</a>
        </div>
    </div>

    <table>
        <thead>
            <tr>
                <th style="width: 50px;">No</th>
                <th>Nama Menu</th>
                <th style="width: 100px;">Gambar</th>
                <th>Keterangan / Varian</th>
                <th>Harga</th>
                <th style="width: 150px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            if(mysqli_num_rows($query) > 0) {
                $no = 1;
                while($result = mysqli_fetch_array($query)) { 
                    
                    // Menjamin pengambilan ID utama agar link edit/hapus tidak kosong
                    $id_menu = isset($result['id_menu']) ? $result['id_menu'] : (isset($result['id']) ? $result['id'] : '');
                    $nama_menu = $result['nama_menu'];
                    $harga = $result['harga'];
                    $deskripsi = isset($result['deskripsi']) ? $result['deskripsi'] : ''; 
                    $gambar = isset($result['gambar']) ? $result['gambar'] : '';
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td style="font-weight: 600; color: var(--text-main);"><?php echo $nama_menu; ?></td>
                <td>
                    <div class="img-container">
                        <?php if(!empty($gambar) && file_exists("../uploads/".$gambar)): ?>
                            <img src="../uploads/<?php echo $gambar; ?>" alt="Menu">
                        <?php else: ?>
                            <span class="no-image">No Image</span>
                        <?php endif; ?>
                    </div>
                </td>
                <td style="color: var(--text-muted);"><?php echo $deskripsi; ?></td>
                <td>
                    <span class="price-badge">Rp <?php echo number_format($harga, 0, ',', '.'); ?></span>
                </td>
                <td class="actions" style="text-align: center;">
                    <a href="edit-menu.php?id=<?php echo $id_menu; ?>" class="btn-edit">Edit</a>
                    <a href="hapus-menu.php?id=<?php echo $id_menu; ?>" onclick="return confirm('Yakin ingin menghapus menu ini?')" class="btn-delete">Hapus</a>
                </td>
            </tr>
            <?php 
                } 
            } else {
            ?>
                <tr><td colspan="6" style="text-align:center; color: var(--text-muted);">Belum ada data menu.</td></tr>
            <?php 
            } 
            ?>
        </tbody>
    </table>
</div>

</body>
</html>