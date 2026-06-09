<?php
session_start();

$conn = mysqli_connect("localhost", "root", "", "db_getcoffee"); 

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}


$sql = "SELECT * FROM menu";
$query = mysqli_query($conn, $sql);


$kategori_menu = [
    'Signature Coffee'     => [],
    'Espresso Based'       => [],
    'Refreshment Mocktails'=> [],
    'Non Coffee Ritual'    => [],
    'Main Course'          => [],
    'Rice Bowls'           => [],
    'Breakfast'            => [],
    'Snacks & Bites'       => []
];


if (mysqli_num_rows($query) > 0) {
    while ($row = mysqli_fetch_array($query)) {
        $nama = $row['nama_menu'];
        $harga = $row['harga'];
        
        
        $kolom_keys = array_keys($row);
        $desc = isset($kolom_keys[5]) ? $row[$kolom_keys[5]] : ''; 
        
        
        $harga_k = number_format(($harga / 1000), 0) . 'k';

        
        $nama_lc = strtolower($nama);
        if (in_array($nama_lc, ['first strike', 'melonaire', 'scoth latte', 'get aren', 'dubai latte'])) {
            $kategori_menu['Signature Coffee'][] = ['name' => $nama, 'price' => $harga_k, 'desc' => $desc];
        } elseif (in_array($nama_lc, ['espresso', 'americano', 'latte', 'cappuccino', 'mocha latte', 'con hielo', 'caramelt', 'vanilla latte', 'hazelnut latte', 'americano (orange/lemon)', 'caramble'])) {
            $kategori_menu['Espresso Based'][] = ['name' => $nama, 'price' => $harga_k, 'desc' => $desc];
        } elseif (in_array($nama_lc, ['sunset lychee', 'crystall bloom', 'passion paradise', 'sunkissed'])) {
            $kategori_menu['Refreshment Mocktails'][] = ['name' => $nama, 'price' => $harga_k, 'desc' => $desc];
        } elseif (in_array($nama_lc, ['strawberry cloud', 'matcha', 'chocolate', 'chocomint', 'biscoff latte', 'cookies cloud', 'lemon tea', 'peach tea', 'lychee tea'])) {
            $kategori_menu['Non Coffee Ritual'][] = ['name' => $nama, 'price' => $harga_k, 'desc' => $desc];
        } elseif (in_array($nama_lc, ['mie katsu', 'nasi goreng get', 'nasi goreng hongkong', 'american chicken chop', 'ayam goreng kremes', 'sop iga', 'iga bakar', 'nasi ayam'])) {
            $kategori_menu['Main Course'][] = ['name' => $nama, 'price' => $harga_k, 'desc' => $desc];
        } elseif (in_array($nama_lc, ['buttermilk chicken', 'ayam sambal matah', 'beef teriyaki', 'beef blackpepper'])) {
            $kategori_menu['Rice Bowls'][] = ['name' => $nama, 'price' => $harga_k, 'desc' => $desc];
        } elseif (in_array($nama_lc, ['bubur ayam', 'soto ayam', 'get lucky noodle'])) {
            $kategori_menu['Breakfast'][] = ['name' => $nama, 'price' => $harga_k, 'desc' => $desc];
        } else {
           
            $kategori_menu['Snacks & Bites'][] = ['name' => $nama, 'price' => $harga_k, 'desc' => $desc];
        }
    }
}


function tampilkan_seksi_menu($items) {
    if (empty($items)) {
        echo "<p style='color: #999; font-style: italic; margin-bottom: 20px;'>Menu belum tersedia.</p>";
        return;
    }
    foreach ($items as $item) {
        echo '<div class="menu-item-row" data-reveal>';
        echo '  <div class="menu-item-row__header">';
        echo '    <h3 class="menu-item-row__name">' . htmlspecialchars($item['name']) . '</h3>';
        echo '    <span class="menu-item-row__price">Rp ' . htmlspecialchars($item['price']) . '</span>';
        echo '  </div>';
        if (!empty($item['desc'])) {
            echo '  <p class="menu-item-row__desc">' . htmlspecialchars($item['desc']) . '</p>';
        }
        echo '</div>';
    }
}
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Menu – Get Coffee</title>
  <link rel="stylesheet" href="css/style.css" />
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
</head>
<body>

  <nav class="navbar">
    <div class="navbar__inner">
      <a class="navbar__logo" href="index.php">
        <img class="navbar__logo-img" src="images/logo.jpeg" alt="Get Coffee Logo" />
        <span class="navbar__brand">Get Coffee</span>
      </a>
      <ul class="navbar__links">
        <li><a class="navbar__link" href="index.php">Home</a></li>
        <li><a class="navbar__link active" href="menu.php">Menu</a></li>
        <li><a class="navbar__link" href="about.php">About</a></li>
      </ul>
      <a class="navbar__cta" href="https://wa.me/6282148295479">Order Now</a>
      <div class="navbar__hamburger">
        <span></span>
        <span></span>
        <span></span>
      </div>
    </div>
    <div class="navbar__mobile">
      <a class="navbar__link" href="index.php">Home</a>
      <a class="navbar__link active" href="menu.php">Menu</a>
      <a class="navbar__link" href="about.php">About</a>
      <a class="navbar__cta" href="https://wa.me/6282148295479" style="display: block; text-align: center; margin-top: 10px;">Order Now</a>
    </div>
  </nav>

  <main style="padding-top: 140px;">
    <header class="container" style="text-align: center; margin-bottom: 80px;">
      <h1 class="hero__title" style="margin-bottom: 16px;">GetCoffeeID</h1>
      <p class="hero__desc" style="margin: 0 auto;">Pilihan kurasi kopi spesial dan hidangan lezat kami, diracik dengan penuh ketelitian untuk setiap momen berhargamu.</p>
    </header>

    <section class="container menu-editorial">
      <div class="editorial-layout">
        <div class="editorial-sticky">
          <span class="editorial-label">01 — The Roastery</span>
          <h2 class="editorial-title">Coffee Selection</h2>
          <div class="mini-bento mini-bento--coffee">
            <div class="mini-bento__img"><img src="images/Menu/Coffee(3).png" alt="Coffee 1" /></div>
            <div class="mini-bento__img"><img src="images/Menu/Coffee(2).png" alt="Coffee 2" /></div>
            <div class="mini-bento__img"><img src="images/asset2.jpg" alt="Coffee 3" /></div>
            <div class="mini-bento__img"><img src="images/asset.jpg" alt="Coffee 4" /></div>
            <div class="mini-bento__img"><img src="images/Menu/Coffee(5).png" alt="Coffee 5" /></div>
          </div>
        </div>

        <div class="menu-list-items">
          <div style="margin-bottom: 60px;">
            <h3 class="editorial-label" style="font-size: 1.2rem; color: var(--color-primary); margin-bottom: 24px; border-bottom: 2px solid var(--color-accent); display: inline-block;">Signature Coffee</h3>
            <?php tampilkan_seksi_menu($kategori_menu['Signature Coffee']); ?>
          </div>

          <div>
            <h3 class="editorial-label" style="font-size: 1.2rem; color: var(--color-primary); margin-bottom: 24px; border-bottom: 2px solid var(--color-accent); display: inline-block;">Espresso Based</h3>
            <?php tampilkan_seksi_menu($kategori_menu['Espresso Based']); ?>
          </div>
        </div>
      </div>
    </section>

    <section class="menu-editorial" style="background-color: var(--color-surface-mixed);">
      <div class="container">
        <div class="editorial-layout editorial-layout--flipped">
          <div class="menu-list-items">
            <div style="margin-bottom: 60px;">
              <h3 class="editorial-label" style="font-size: 1.2rem; color: var(--color-primary); margin-bottom: 24px; border-bottom: 2px solid var(--color-accent); display: inline-block;">Refreshment Mocktails</h3>
              <?php tampilkan_seksi_menu($kategori_menu['Refreshment Mocktails']); ?>
            </div>

            <div>
              <h3 class="editorial-label" style="font-size: 1.2rem; color: var(--color-primary); margin-bottom: 24px; border-bottom: 2px solid var(--color-accent); display: inline-block;">Non Coffee Ritual</h3>
              <?php tampilkan_seksi_menu($kategori_menu['Non Coffee Ritual']); ?>
            </div>
          </div>
          <div class="editorial-sticky">
            <span class="editorial-label" style="text-align: right;">02 — The Infusion</span>
            <h2 class="editorial-title" style="text-align: right;">Artisan Drinks</h2>
            <div class="mini-bento mini-bento--non-coffee" style="margin-left: auto;">
              <div class="mini-bento__img"><img src="images/Menu/matcha.jfif" alt="Tea 1" /></div>
              <div class="mini-bento__img"><img src="images/Menu/Mocktail.png" alt="Tea 2" /></div>
              <div class="mini-bento__img"><img src="images/Menu/Mocktail 2.png" alt="Tea 3" /></div>
              <div class="mini-bento__img"><img src="images/Menu/Mocktail 3.png" alt="Tea 4" /></div>
              <div class="mini-bento__img"><img src="images/Menu/mockland.png" alt="Tea 5" /></div>
            </div>
          </div>
        </div>
      </div>
    </section>

    <section class="container menu-editorial" id="food">
      <div class="editorial-layout">
        <div class="editorial-sticky">
          <span class="editorial-label">03 — The Kitchen</span>
          <h2 class="editorial-title">Hearty Meals</h2>
          <div class="mini-bento mini-bento--food">
            <div class="mini-bento__img"><img src="images/Menu/Food (11).png" alt="Food 1" /></div>
            <div class="mini-bento__img"><img src="images/Menu/Food (6).png" alt="Food 2" /></div>
            <div class="mini-bento__img"><img src="images/Menu/Food (13).png" alt="Food 3" /></div>
            <div class="mini-bento__img"><img src="images/Menu/Food (14).png" alt="Food 4" /></div>
            <div class="mini-bento__img"><img src="images/Menu/Food (4).png" alt="Food 5" /></div>
          </div>
        </div>
        <div class="menu-list-items">
          <div style="margin-bottom: 48px;">
            <h3 class="editorial-label" style="font-size: 1.1rem; color: var(--color-primary); margin-bottom: 24px; border-bottom: 2px solid var(--color-accent); display: inline-block;">Main Course</h3>
            <?php tampilkan_seksi_menu($kategori_menu['Main Course']); ?>
          </div>

          <div style="margin-bottom: 48px;">
            <h3 class="editorial-label" style="font-size: 1.1rem; color: var(--color-primary); margin-bottom: 24px; border-bottom: 2px solid var(--color-accent); display: inline-block;">Rice Bowls</h3>
            <?php tampilkan_seksi_menu($kategori_menu['Rice Bowls']); ?>
          </div>

          <div style="margin-bottom: 48px;">
            <h3 class="editorial-label" style="font-size: 1.1rem; color: var(--color-primary); margin-bottom: 24px; border-bottom: 2px solid var(--color-accent); display: inline-block;">Breakfast</h3>
            <?php tampilkan_seksi_menu($kategori_menu['Breakfast']); ?>
          </div>

          <div>
            <h3 class="editorial-label" style="font-size: 1.1rem; color: var(--color-primary); margin-bottom: 24px; border-bottom: 2px solid var(--color-accent); display: inline-block;">Snacks & Bites</h3>
            <?php tampilkan_seksi_menu($kategori_menu['Snacks & Bites']); ?>
          </div>
        </div>
      </div>
    </section>
  </main>

  <footer class="footer">
    <div class="container">
      <div class="footer__grid">
        <div class="footer__brand">
          <div class="footer__logo">
            <img class="footer__logo-img" src="images/logo.jpeg" alt="Logo" />
            <span class="footer__logo-name">Get Coffee</span>
          </div>
          <p class="footer__desc">Menyajikan pengalaman kopi berkualitas sejak 2025.</p>
        </div>
        <nav class="footer__nav-col">
          <h4 class="footer__nav-title">Jelajahi</h4>
          <a class="footer__nav-link" href="index.php">Home</a>
          <a class="footer__nav-link" href="menu.php">Menu</a>
          <a class="footer__nav-link" href="about.php">About</a>
        </nav>
      </div>
      <div class="footer__bottom">
        <p>© 2025 Get Coffee. Dibuat dengan ☕ dan semangat.</p>
      </div>
    </div>
  </footer>

  <script src="js/main.js"></script>
</body>
</html>
