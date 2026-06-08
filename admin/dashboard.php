<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "db_getcoffee");

$sql_menu = "SELECT * FROM menu";
$query_menu = mysqli_query($conn, $sql_menu);
$total_menu = mysqli_num_rows($query_menu);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Get Coffee</title>
</head>
<body>

    <h1>GET COFFEE - ADMIN HUB</h1>
    <p>Selamat Datang di Halaman Kendali Admin!</p>
    <hr>

    <div style="display: flex; gap: 20px; margin-top: 20px; margin-bottom: 25px;">
        <div style="border: 2px solid #333; padding: 15px 30px; border-radius: 8px; background-color: #f9f9f9; text-align: center;">
            <h3 style="margin: 0; color: #555;">TOTAL MENU KOPI</h3>
            
            <p style="font-size: 36px; font-weight: bold; margin: 10px 0 0 0; color: #7f5539;"><?php echo $total_menu; ?></p>
        </div>
    </div>

    <hr>
    <h3>Menu Navigasi:</h3>
    <ul>
        <li><a href="dashboard.php">Dashboard</a></li>
        <li><a href="menu.php">Kelola Menu</a></li>
        <li><a href="../logout.php">Logout</a></li>
    </ul>

</body>
</html>
