<?php
session_start();

// include "../koneksi.php";

$conn = mysqli_connect("localhost", "root", "", "db_getcoffee"); 

$sql = "SELECT * FROM menu";
$query = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kelola Menu - Get Coffee</title>
</head>
<body>

    <h1>KELOLA MENU COFFEE SHOP</h1>

    <a href="dashboard.php">Kembali ke Dashboard</a> | 
    <a href="tambah-menu.php">Tambah Menu Baru</a>
    <br><br>

    <table border="1" cellpadding="8" cellspacing="0">
        <thead>
            <tr>
                <th>No</th>
                <th>Nama Menu</th>
                <th>Deskripsi</th>
                <th>Harga</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            
            while($result = mysqli_fetch_array($query)){
                
                $id = $result['id']; 
                $nama_menu = $result['nama_menu']; 
                $deskripsi = $result['deskripsi']; 
                $harga = $result['harga']; 
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $nama_menu; ?></td>
                <td><?php echo $deskripsi; ?></td>
                <td>Rp <?php echo number_format($harga, 0, ',', '.'); ?></td>
                <td>
                    <a href="edit-menu.php?id=<?php echo $id; ?>">Edit</a> | 
                    <a href="hapus-menu.php?id=<?php echo $id; ?>" onclick="return confirm('Yakin ingin menghapus menu ini?')">Hapus</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>

</body>
</html>
