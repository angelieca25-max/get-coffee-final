<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "get-coffee");

if (!isset($_GET['id'])) {
    header("Location: menu.php");
    exit;
}

$id_menu = $_GET['id'];

$sql = "SELECT * FROM menu WHERE id_menu = '$id_menu'";
$query = mysqli_query($conn, $sql);
$data = mysqli_fetch_assoc($query);

if (mysqli_num_rows($query) < 1) {
    header("Location: menu.php");
    exit;
}

if (isset($_POST['simpan'])) {
    $id_menu     = $_POST['id_menu']; 
    $nama_menu   = $_POST['nama_menu'];
    $id_kategori = $_POST['id_kategori'];
    $harga       = $_POST['harga'];
    $deskripsi   = $_POST['deskripsi'];

    // LOGIKA PROSES UPDATE (Menyimpan id_kategori ke database)
    $sql_update = "UPDATE menu SET 
                    nama_menu = '$nama_menu', 
                    id_kategori = '$id_kategori', 
                    harga = '$harga', 
                    deskripsi = '$deskripsi' 
                   WHERE id_menu = '$id_menu'";
                   
    $query_update = mysqli_query($conn, $sql_update);

    if ($query_update) {
        echo "<script>
                alert('Data menu berhasil diperbarui!');
                window.location.href = 'menu.php';
              </script>";
    } else {
        echo "<script>
                alert('Gagal memperbarui data!');
              </script>";
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Edit Menu - Get Coffee</title>
</head>
<body>

    <h2>Edit Data Menu - Get Coffee</h2>
    <a href="menu.php">← Kembali ke Kelola Menu</a>
    <br><br>

    <form action="" method="POST">
        <table cellpadding="8">
            <tr>
                <td>Nama Menu:</td>
                <td><input type="text" name="nama_menu" value="<?php echo $data['nama_menu']; ?>" required style="width: 250px;"></td>
            </tr>
            <tr>
                <td>Kategori:</td>
                <td>
                    <select name="id_kategori" required style="width: 258px;">
                        <option value="1" <?php echo ($data['id_kategori'] == 1) ? 'selected' : ''; ?>>Minuman (1)</option>
                        <option value="2" <?php echo ($data['id_kategori'] == 2) ? 'selected' : ''; ?>>Makanan (2)</option>
                    </select>
                </td>
            </tr>
            <tr>
                <td>Harga (Rp):</td>
                <td><input type="number" name="harga" value="<?php echo $data['harga']; ?>" required style="width: 250px;"></td>
            </tr>
            <tr>
                <td>Deskripsi:</td>
                <td><textarea name="deskripsi" rows="4" style="width: 250px;"><?php echo $data['deskripsi']; ?></textarea></td>
            </tr>
            <tr>
                <td></td>
                <td><button type="submit" name="simpan" style="padding: 6px 15px; cursor: pointer;">Simpan Perubahan</button></td>
            </tr>
        </table>
    </form>

</body>
</html>