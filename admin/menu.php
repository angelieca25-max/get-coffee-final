<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "db_getcoffee"); 

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

$sql = "SELECT * FROM menu";
$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Kelola Menu - Get Coffee</title>
    <style>
        body { font-family: sans-serif; padding: 20px; background-color: #fff; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        table, th, td { border: 1px solid #333; padding: 10px; text-align: left; }
        th { background-color: #f2f2f2; }
        a { color: blue; text-decoration: none; }
        a:hover { text-decoration: underline; }
    </style>
</head>
<body>

    <h2>Kelola Menu - Admin Hub</h2>
    <a href="dashboard.php">← Kembali ke Dashboard</a> | <a href="tambah-menu.php">+ Tambah Menu Baru</a>
    
    <table>
        <thead>
        <tr>
            <th>No</th>
            <th>Nama Menu</th>
            <th>Gambar</th> <th>Keterangan / Varian</th>
            <th>Harga</th>
            <th>Aksi</th>
        </tr>
        </thead>
        <tbody>
        <?php
        if(mysqli_num_rows($query) > 0) {
            while($result = mysqli_fetch_array($query)){

                $id_menu = isset($result['id']) ? $result['id'] : (isset($result['id_menu']) ? $result['id_menu'] : '');
                $nama_menu = $result['nama_menu'];
                $harga = $result['harga'];

                $kolom_keys = array_keys($result);
                $kolom_ketiga = isset($kolom_keys[5]) ? $result[$kolom_keys[5]] : '';
                $gambar = isset($result['gambar']) ? $result['gambar'] : '';
        ?>
        <tr>
            <td><?php echo $id_menu; ?></td>
            <td><?php echo $nama_menu; ?></td>
            <td align="center">
                <?php if (!empty($gambar)): ?>
                    <img src="../uploads/<?php echo $gambar; ?>" style="width: 65px; height: 65px; object-fit: cover; border-radius: 5px; border: 1px solid #ddd;">
                <?php else: ?>
                    <small style="color: gray; font-style: italic;">No Image</small>
                <?php endif; ?>
            </td>
            <td><?php echo $kolom_ketiga; ?></td>
            <td>Rp <?php echo number_format($harga, 0, ',', '.'); ?></td>
            <td>
                <a href="edit-menu.php?id=<?php echo $id_menu; ?>">Edit</a> | 
                <a href="hapus-menu.php?id=<?php echo $id_menu; ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
            </td>
        </tr>
        <?php
            }
        } else {
        ?>
            <tr><td colspan="6" style="text-align:center;">Belum ada data menu.</td></tr>
        <?php
        }
    ?>
        </tbody>
    </table>

</body>
</html>