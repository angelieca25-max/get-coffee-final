<?php
session_start();
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Admin - Get Coffee</title>
    <link rel="stylesheet" href="../css/style.css">
    
    <style>
        html, body {
            background-image: linear-gradient(135deg, #2d1e17 0%, #4a3228 100%) !important;
            background-color: #2d1e17 !important;
            min-height: 100vh;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            font-family: sans-serif;
        }

        /* Kotak Panel Kaca Utama (Glassmorphism) */
        .admin-box {
            background: rgba(255, 255, 255, 0.1) !important;
            backdrop-filter: blur(24px) !important;
            -webkit-backdrop-filter: blur(24px) !important;
            border: 1px solid rgba(255, 255, 255, 0.2) !important;
            border-radius: 24px !important;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.4) !important;
            padding: 40px;
            width: 100%;
            max-width: 420px;
            text-align: center;
        }

        /* Logo Kopi Penguin (Dibuat ke Tengah Layar) */
        .admin-logo {
            width: 100px;
            height: 100px;
            border-radius: 50%;
            object-fit: cover;
            display: block;            
            margin: 0 auto 15px auto;  
            box-shadow: 0 8px 16px rgba(0,0,0,0.3);
            border: 2px solid rgba(255, 255, 255, 0.2);
        }

        .admin-box h2 {
            color: #c9a050 !important; /* Warna Emas Refined Gold */
            font-weight: 800;
            margin: 0 0 5px 0;
            font-size: 1.8rem;
            letter-spacing: 1px;
        }

        .admin-box p {
            color: #faf9f6 !important;
            margin: 0 0 20px 0;
            font-size: 0.95rem;
            opacity: 0.85;
        }

        /* Navigasi Menu */
        .admin-nav {
            padding: 0;
            margin: 20px 0 0 0;
            list-style: none;
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .admin-nav li a {
            display: block;
            text-decoration: none;
            padding: 14px;
            font-weight: 700;
            border-radius: 16px;
            transition: all 0.3s ease;
        }

        /* Tombol Dashboard (Emas Solid) */
        .btn-dash {
            background-color: #c9a050 !important;
            color: #ffffff !important;
            border: 1px solid rgba(255, 255, 255, 0.2);
            box-shadow: 0 4px 12px rgba(201, 144, 80, 0.3);
        }
        .btn-dash:hover {
            background-color: #e2c275 !important;
            transform: translateY(-2px);
        }

        /* Tombol Kelola Menu & Kategori (Gaya Kaca Transparan) */
        .btn-kelola {
            background-color: transparent !important;
            color: #c9a050 !important;
            border: 2px solid #c9a050 !important;
        }
        .btn-kelola:hover {
            background-color: rgba(201, 144, 80, 0.15) !important;
            transform: translateY(-2px);
        }

        /* Tombol Logout (Merah Berani) */
        .btn-out {
            background-color: #d9534f !important;
            color: #ffffff !important;
            border: none;
            box-shadow: 0 4px 12px rgba(217, 83, 79, 0.2);
        }
        .btn-out:hover {
            background-color: #c9302c !important;
            transform: translateY(-2px);
        }
    </style>
</head>
<body>

    <div class="admin-box">
        
        <img src="../images/logo.jpeg" alt="Get Coffee Logo" class="admin-logo">
        
        <h2>GET COFFEE</h2>
        <p style="color: #c9a050 !important; font-weight: 700; font-size: 1.1rem; margin-bottom: 5px; letter-spacing: 2px;">ADMIN HUB</p>
        <p>Selamat Datang di Halaman Kendali Admin!</p>
        
        <hr style="border: 0; border-top: 1px solid rgba(255, 255, 255, 0.15); margin: 15px 0;">
        
        <h3 style="color: #faf9f6; font-size: 1.05rem; font-weight: 700; margin: 0; text-align: left; opacity: 0.9;">Menu Navigasi:</h3>
        
        <ul class="admin-nav">
            <li>
                <a href="dashboard.php" class="btn-dash">Dashboard</a>
            </li>
            <li>
                <a href="menu.php" class="btn-kelola">Kelola Menu</a>
            </li>
            <li>
                <a href="kategori.php" class="btn-kelola">Kelola Kategori</a>
            </li>
            <li>
                <a href="kelola-admin.php" class="btn-kelola">Kelola Akun Admin</a>
            </li>
            <li>
                <a href="../logout.php" class="btn-out">Logout</a>
            </li>
        </ul>

    </div>

</body>
</html>