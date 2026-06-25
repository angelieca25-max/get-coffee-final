<?php
session_start();

// 1. KONEKSI KE DATABASE
$koneksi = mysqli_connect("localhost", "root", "", "get-coffee"); 

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// 2. PROSES TAMBAH KATEGORI BARU
if (isset($_POST['simpan'])) {
    $nama_kategori = $_POST['nama_kategori'];
    
    if (!empty($nama_kategori)) {
        $insert = mysqli_query($koneksi, "INSERT INTO kategori (nama_kategori) VALUES ('$nama_kategori')");
        if ($insert) {
            header("Location: kategori.php");
            exit;
        }
    }
}

// 3. PROSES HAPUS KATEGORI (Sudah diperbaiki dari id_kat menjadi id_kategori)
if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    // Perbaikan utama: Menggunakan id_kategori sesuai database Anda
    mysqli_query($koneksi, "DELETE FROM kategori WHERE id_kategori = '$id'");
    header("Location: kategori.php");
    exit;
}

// 4. AMBIL DATA KATEGORI UNTUK TABEL
$ambil_data = mysqli_query($koneksi, "SELECT * FROM kategori ORDER BY id_kategori DESC");
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Kategori - Get Coffee</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-gradient: linear-gradient(135deg, #2d1e17 0%, #4a3228 100%);
            --glass-bg: rgba(255, 255, 255, 0.08);
            --glass-border: rgba(255, 255, 255, 0.15);
            --text-light: #f5f5f5;
            --text-muted: #b3a29a;
            --accent-coffee: #dfb287; /* Warna emas/cream kopi */
            --danger-color: #ff6b6b;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background: var(--bg-gradient) !important;
            color: var(--text-light);
            min-height: 100vh;
            margin: 0;
            padding: 40px 20px;
            display: flex;
            justify-content: center;
            align-items: flex-start;
            box-sizing: border-box;
        }

        .admin-box {
            background: var(--glass-bg) !important;
            backdrop-filter: blur(24px) !important;
            -webkit-backdrop-filter: blur(24px) !important;
            border: 1px solid var(--glass-border) !important;
            border-radius: 16px;
            padding: 35px;
            width: 100%;
            max-width: 750px;
            box-shadow: 0 8px 32px rgba(0, 0, 0, 0.3);
        }

        h2 {
            margin: 0 0 5px 0;
            font-size: 24px;
            font-weight: 700;
            color: var(--accent-coffee);
        }

        .btn-back {
            display: inline-block;
            text-decoration: none;
            color: var(--text-muted);
            font-size: 14px;
            margin-bottom: 30px;
            transition: color 0.2s;
        }

        .btn-back:hover {
            color: var(--text-light);
        }

        /* Form Tambah Kategori */
        .form-add {
            display: flex;
            gap: 12px;
            margin-bottom: 30px;
            background: rgba(0, 0, 0, 0.2);
            padding: 15px;
            border-radius: 10px;
            border: 1px solid var(--glass-border);
        }

        .form-add input[type="text"] {
            flex: 1;
            padding: 12px;
            border: 1px solid var(--glass-border);
            border-radius: 8px;
            background: rgba(255, 255, 255, 0.05);
            color: #fff;
            font-family: inherit;
            font-size: 14px;
        }

        .form-add input[type="text"]:focus {
            outline: none;
            border-color: var(--accent-coffee);
            background: rgba(255, 255, 255, 0.1);
        }

        .form-add button {
            background: var(--accent-coffee);
            color: #2d1e17;
            border: none;
            padding: 12px 24px;
            border-radius: 8px;
            font-weight: 600;
            font-family: inherit;
            cursor: pointer;
            transition: opacity 0.2s;
        }

        .form-add button:hover {
            opacity: 0.9;
        }

        /* Desain Tabel Kategori Modern */
        table {
            width: 100%;
            border-collapse: collapse;
            text-align: left;
        }

        th {
            color: var(--accent-coffee);
            font-weight: 600;
            padding: 14px;
            font-size: 14px;
            border-bottom: 2px solid var(--glass-border);
        }

        td {
            padding: 14px;
            border-bottom: 1px solid rgba(255, 255, 255, 0.05);
            font-size: 14px;
        }

        tr:hover td {
            background: rgba(255, 255, 255, 0.02);
        }

        .btn-delete {
            color: var(--danger-color);
            text-decoration: none;
            font-weight: 600;
            font-size: 13px;
            background: rgba(255, 107, 107, 0.1);
            padding: 5px 10px;
            border-radius: 6px;
            transition: background 0.2s;
        }

        .btn-delete:hover {
            background: rgba(255, 107, 107, 0.2);
        }
    </style>
</head>
<body>

<div class="admin-box">
    <h2>Kelola Kategori Menu</h2>
    <a href="dashboard.php" class="btn-back">← Kembali ke Dashboard</a>

    <form action="" method="POST" class="form-add">
        <input type="text" name="nama_kategori" placeholder="Tulis nama kategori baru (cth: Mocktails)..." required>
        <button type="submit" name="simpan">Tambah</button>
    </form>

    <table>
        <thead>
            <tr>
                <th style="width: 80px;">No</th>
                <th>Nama Kategori</th>
                <th style="width: 100px; text-align: center;">Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while($row = mysqli_fetch_assoc($ambil_data)) { 
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td style="font-weight: 500;"><?php echo $row['nama_kategori']; ?></td>
                <td style="text-align: center;">
                    <a href="kategori.php?hapus=<?php echo $row['id_kategori']; ?>" class="btn-delete" onclick="return confirm('Menghapus kategori akan berdampak pada relasi menu. Yakin ingin menghapus?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

</body>
</html>