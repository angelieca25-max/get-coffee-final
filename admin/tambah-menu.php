<?php
session_start();

// 1. KONEKSI KE DATABASE
$conn = mysqli_connect("localhost", "root", "", "get-coffee"); 

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

// 2. LOGIKA PENYIMPANAN DATA (Jika form disubmit)
if (isset($_POST['simpan'])) {
    $nama_menu   = $_POST['nama_menu'];
    $id_kategori = $_POST['id_kategori']; // Menangkap data kategori pilihan admin
    $harga       = $_POST['harga'];
    $deskripsi   = $_POST['deskripsi'];
    
    $nama_gambar = "";

    // Upload Gambar
    if ($_FILES['gambar']['name'] != "") {
        $nama_gambar = time() . '_' . $_FILES['gambar']['name']; 
        $tmp_gambar  = $_FILES['gambar']['tmp_name'];
        move_uploaded_file($tmp_gambar, "../uploads/" . $nama_gambar);
    }

    // Query simpan ke database (Sesuaikan susunan kolom tabel menu Anda)
    $sql_insert = "INSERT INTO menu (nama_menu, id_kategori, harga, deskripsi, gambar) 
                   VALUES ('$nama_menu', '$id_kategori', '$harga', '$deskripsi', '$nama_gambar')";
                   
    $query_insert = mysqli_query($conn, $sql_insert);

    if ($query_insert) {
        echo "<script>
                alert('Menu baru berhasil ditambahkan!');
                window.location.href = 'menu.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal menambahkan menu: " . mysqli_error($conn) . "');
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu Baru - Get Coffee</title>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;500;600;700&display=swap" rel="stylesheet">
    
    <style>
        :root {
            --bg-color: #f8f9fa;
            --card-bg: #ffffff;
            --primary-color: #6f4e37; /* Tema Cokelat Kopi */
            --primary-hover: #5a3e2b;
            --text-main: #2d2d2d;
            --text-muted: #7c7c7c;
            --border-color: #eaeaea;
        }

        body {
            font-family: 'Plus Jakarta Sans', sans-serif;
            background-color: var(--bg-color);
            color: var(--text-main);
            margin: 0;
            padding: 40px 20px;
        }

        .container {
            max-width: 600px;
            margin: 0 auto;
            background: var(--card-bg);
            padding: 35px;
            border-radius: 16px;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.04);
        }

        h2 {
            margin: 0 0 5px 0;
            font-size: 24px;
            font-weight: 700;
            color: var(--primary-color);
            text-transform: uppercase;
            letter-spacing: 0.5px;
        }

        .btn-back {
            display: inline-block;
            text-decoration: none;
            color: var(--text-muted);
            font-size: 14px;
            font-weight: 500;
            margin-bottom: 25px;
            transition: color 0.2s;
        }

        .btn-back:hover {
            color: var(--text-main);
        }

        /* Form Table Layout Modernization */
        table {
            width: 100%;
            border-collapse: collapse;
        }

        td {
            padding: 12px 4px;
            vertical-align: middle;
            font-size: 14px;
            font-weight: 500;
        }

        td:first-child {
            width: 130px;
            color: #4a4a4a;
            font-weight: 600;
        }

        td:nth-child(2) {
            width: 20px;
            color: var(--text-muted);
        }

        /* Input Controls Aesthetic Styling */
        input[type="text"],
        input[type="number"],
        select,
        textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid var(--border-color);
            border-radius: 8px;
            font-family: inherit;
            font-size: 14px;
            color: var(--text-main);
            box-sizing: border-box;
            background-color: #fafafa;
            transition: all 0.3s;
        }

        input:focus,
        select:focus,
        textarea:focus {
            outline: none;
            border-color: var(--primary-color);
            background-color: #fff;
            box-shadow: 0 0 0 3px rgba(111, 78, 55, 0.1);
        }

        textarea {
            resize: none;
        }

        input[type="file"] {
            font-family: inherit;
            font-size: 13px;
            margin-top: 5px;
        }

        /* Buttons Design */
        .btn-submit {
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            background-color: var(--primary-color);
            color: #fff;
            transition: background 0.2s;
            margin-right: 8px;
        }

        .btn-submit:hover {
            background-color: var(--primary-hover);
        }

        .btn-reset {
            font-family: inherit;
            font-size: 14px;
            font-weight: 600;
            padding: 12px 24px;
            border-radius: 8px;
            border: none;
            cursor: pointer;
            background-color: #eaeaea;
            color: #4a4a4a;
            transition: background 0.2s;
        }

        .btn-reset:hover {
            background-color: #ddd;
        }
    </style>
</head>
<body>

<div class="container">
    <h2>Tambah Menu Baru</h2>
    <a href="menu.php" class="btn-back">← Kembali ke Kelola Menu</a>

    <form action="" method="POST" enctype="multipart/form-data">
        <table>
            <tr>
                <td>Nama Menu</td>
                <td>:</td>
                <td><input type="text" name="nama_menu" placeholder="Masukkan nama menu..." required></td>
            </tr>
            <tr>
                <td>Kategori</td>
                <td>:</td>
                <td>
                    <select name="id_kategori" required>
                        <option value="">-- Pilih Kategori Menu --</option>
                        <?php
                        // Baris otomatis memanggil data dari tabel kategori database Anda
                        $ambil_kat = mysqli_query($conn, "SELECT * FROM kategori");
                        while($kat = mysqli_fetch_assoc($ambil_kat)) {
                            echo "<option value='".$kat['id_kategori']."'>".$kat['nama_kategori']."</option>";
                        }
                        ?>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td>:</td>
                <td><textarea name="deskripsi" rows="4" placeholder="Tulis deskripsi menu..." required></textarea></td>
            </tr>
            <tr>
                <td>Harga</td>
                <td>:</td>
                <td><input type="number" name="harga" placeholder="Contoh: 20000" required></td>
            </tr>
            <tr>
                <td>Gambar Menu</td>
                <td>:</td>
                <td><input type="file" name="gambar" accept="image/*" required></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td style="padding-top: 20px;">
                    <button type="submit" name="simpan" class="btn-submit">Simpan Menu</button>
                    <button type="reset" class="btn-reset">Reset</button>
                </td>
            </tr>
        </table>
    </form>
</div>

</body>
</html>