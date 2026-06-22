<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tambah Menu Baru - Get Coffee</title>
</head>
<body>

    <h1>TAMBAH MENU BARU</h1>
    <a href="menu.php">Kembali ke Kelola Menu</a>
    <br><br>

    <form action="proses-tambah.php" method="POST" enctype="multipart/form-data">
        <table cellpadding="8">
            <tr>
                <td>Nama Menu</td>
                <td>:</td>
                <td><input type="text" name="nama_menu" required></td>
            </tr>
            <tr>
                <td>Deskripsi</td>
                <td>:</td>
                <td><textarea name="deskripsi" rows="4" required></textarea></td>
            </tr>
                <tr>
            <td>Harga</td>
            <td>:</td>
            <td><input type="number" name="harga" required></td>
        </tr>

        <tr>
            <td>Gambar Menu</td>
            <td>:</td>
            <td><input type="file" name="gambar" accept="image/*" required></td>
        </tr>

        <tr>
    <td></td>
    <td></td>
    <td>
        <button type="submit" name="simpan">Simpan Menu</button>
        <button type="reset">Reset</button>
    </td>
</tr>
        </table>
    </form>

</body>
</html>
