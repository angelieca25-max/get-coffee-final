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
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menu - Get Coffee</title>
 
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@400;600;700;800&display=swap" rel="stylesheet">
    
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Plus Jakarta Sans', sans-serif;
        }

        body {
            background-color: #fcf8f4;
            color: #2b2b2b;
            padding-bottom: 50px;
        }

        /* Navbar Styling */
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            background-color: #ffffff;
            margin: 20px auto;
            padding: 15px 40px;
            border-radius: 50px;
            width: 95%;
            max-width: 1200px;
            box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        }

        .brand {
            display: flex;
            align-items: center;
            gap: 10px;
            font-weight: 700;
            font-size: 20px;
        }

        .brand img {
            width: 35px;
            height: 35px;
            border-radius: 50%;
        }

        .nav-links {
            display: flex;
            gap: 30px;
            align-items: center;
        }

        .nav-links a {
            text-decoration: none;
            color: #666;
            font-weight: 600;
            font-size: 15px;
        }

        .nav-links a.active {
            color: #2b2b2b;
            background-color: #f0e6df;
            padding: 8px 20px;
            border-radius: 20px;
        }

        .btn-order {
            background-color: #321f14;
            color: #ffffff;
            padding: 12px 30px;
            border-radius: 25px;
            text-decoration: none;
            font-weight: 700;
            font-size: 15px;
        }

        /* Main Content Layout */
        .container {
            display: flex;
            max-width: 1200px;
            margin: 60px auto 0 auto;
            padding: 0 40px;
            gap: 50px;
        }

        /* Bagian Kiri: Grid Foto */
        .left-content {
            flex: 1;
        }

        .sub-title {
            color: #c49a6c;
            font-size: 12px;
            font-weight: 700;
            letter-spacing: 2px;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .main-title {
            font-size: 48px;
            font-weight: 800;
            line-height: 1.1;
            margin-bottom: 30px;
            color: #2b2b2b;
        }

        .image-grid {
            display: grid;
            grid-template-columns: 2fr 1fr;
            gap: 15px;
        }

        .img-big {
            width: 100%;
            height: 320px;
            object-fit: cover;
            border-radius: 20px;
        }

        .img-small-container {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .img-small {
            width: 100%;
            height: 152px;
            object-fit: cover;
            border-radius: 20px;
        }

        /* Bagian Kanan: List Menu Dinamis */
        .right-content {
            flex: 1.2;
            padding-top: 20px;
        }

        .section-title {
            font-size: 22px;
            font-weight: 700;
            letter-spacing: 1px;
            border-bottom: 2px solid #e8dec9;
            padding-bottom: 10px;
            margin-bottom: 25px;
            text-transform: uppercase;
        }

        .menu-list {
            display: flex;
            flex-direction: column;
            gap: 20px;
        }

        .menu-item {
            display: flex;
            justify-content: space-between;
            align-items: baseline;
            border-bottom: 1px dashed #e4dcd3;
            padding-bottom: 10px;
        }

        .menu-name {
            font-size: 18px;
            font-weight: 700;
            color: #2b2b2b;
        }

        .menu-price {
            font-size: 16px;
            font-weight: 700;
            color: #c49a6c;
            white-space: nowrap;
        }
    </style>
</head>
<body>

    <!-- NAVBAR UTAMA -->
    <nav class="navbar">
        <div class="brand">
          
            <img src="https://placehold.co/100x100/321f14/fff?text=☕" alt="Logo"> 
            <span>Get Coffee</span>
        </div>
        <div class="nav-links">
            <a href="index.php">Home</a>
            <a href="menu.php" class="active">Menu</a>
            <a href="about.php">About</a>
        </div>
        <a href="#order" class="btn-order">Order Now</a>
    </nav>

    <!-- KONTEN UTAMA -->
    <main class="container">
        
        <!-- SEKSI KIRI: FOTO & COFFEE SELECTION -->
        <section class="left-content">
            <div class="sub-title">01 — The Roastery</div>
            <h1 class="main-title">Coffee<br>Selection</h1>
            
            <div class="image-grid">
             
                <img class="img-big" src="https://images.unsplash.com/photo-1541167760496-1628856ab772?q=80&w=600" alt="Es Kopi Susu">
                
              
                <div class="img-small-container">
                    <img class="img-small" src="https://images.unsplash.com/photo-1509042239860-f550ce710b93?q=80&w=300" alt="Biji Kopi">
                    <img class="img-small" src="https://images.unsplash.com/photo-1514432324607-a09d9b4aefdd?q=80&w=300" alt="Latte Art">
                </div>
            </div>
        </section>

        <!-- SEKSI KANAN: SIGNATURE COFFEE (LOOP DATABASE) -->
        <section class="right-content">
            <h2 class="section-title">Signature Coffee</h2>
            
            <div class="menu-list">
                <?php 
                // LOOP DARI DATABASE START
                if(mysqli_num_rows($query) > 0) {
                    while($result = mysqli_fetch_array($query)){
                        $nama_menu = $result['nama_menu']; 
                        $harga = $result['harga']; 
                    
                        $harga_k = number_format(($harga / 1000), 0) . 'k';
                ?>
                        <div class="menu-item">
                            <span class="menu-name"><?php echo $nama_menu; ?></span>
                            <span class="menu-price">Rp <?php echo $harga_k; ?></span>
                        </div>
                <?php 
                    }
                } else {
                    echo "<p style='color:#999; font-style:italic;'>Belum ada menu yang ditambahkan.</p>";
                }
                // LOOP DARI DATABASE END
                ?>
            </div>
        </section>

    </main>

</body>
</html>
