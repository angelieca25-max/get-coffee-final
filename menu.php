<?php
include 'connection.php';
include 'functions.php';

$query = get_all_menus_with_categories($connection);

$menu_categories = [
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
        $menu_name = $row['menu_name'];
        $price = $row['price'];
        $description = isset($row['description']) ? $row['description'] : ''; 
        $price_k = number_format(($price / 1000), 0) . 'k';
        $category_name = $row['category_name'];

        // Check image path
        $image_src = '';
        if (!empty($row['image'])) {
            if (file_exists('uploads/' . $row['image'])) {
                $image_src = 'uploads/' . $row['image'];
            } elseif (file_exists('images/Menu/' . $row['image'])) {
                $image_src = 'images/Menu/' . $row['image'];
            } elseif (file_exists('images/' . $row['image'])) {
                $image_src = 'images/' . $row['image'];
            }
        }

        $item_data = ['name' => $menu_name, 'price' => $price_k, 'desc' => $description, 'image' => $image_src];

        // Group dynamically using category_name from database
        if (!isset($menu_categories[$category_name])) {
            $menu_categories[$category_name] = [];
        }
        $menu_categories[$category_name][] = $item_data;
    }
}


function display_menu_section($items) {
    if (empty($items)) {
        echo "<p style='color: #999; font-style: italic; margin-bottom: 20px;'>Menu not available.</p>";
        return;
    }
    foreach ($items as $item) {
        echo '<div class="menu-item-row" data-reveal style="display: flex; gap: 20px; align-items: flex-start; margin-bottom: 24px;">';
        if (!empty($item['image'])) {
            echo '  <div class="menu-item-img-wrapper" style="width: 75px; height: 75px; border-radius: 8px; overflow: hidden; flex-shrink: 0; border: 1px solid rgba(255,255,255,0.1);">';
            echo '    <img src="' . htmlspecialchars($item['image']) . '" alt="' . htmlspecialchars($item['name']) . '" style="width: 100%; height: 100%; object-fit: cover;" />';
            echo '  </div>';
        }
        echo '  <div style="flex-grow: 1;">';
        echo '    <div class="menu-item-row__header">';
        echo '      <h3 class="menu-item-row__name">' . htmlspecialchars($item['name']) . '</h3>';
        echo '      <span class="menu-item-row__price">Rp ' . htmlspecialchars($item['price']) . '</span>';
        echo '    </div>';
        if (!empty($item['desc'])) {
            echo '    <p class="menu-item-row__desc">' . htmlspecialchars($item['desc']) . '</p>';
        }
        echo '  </div>';
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
            <?php display_menu_section($menu_categories['Signature Coffee']); ?>
          </div>

          <div>
            <h3 class="editorial-label" style="font-size: 1.2rem; color: var(--color-primary); margin-bottom: 24px; border-bottom: 2px solid var(--color-accent); display: inline-block;">Espresso Based</h3>
            <?php display_menu_section($menu_categories['Espresso Based']); ?>
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
              <?php display_menu_section($menu_categories['Refreshment Mocktails']); ?>
            </div>

            <div>
              <h3 class="editorial-label" style="font-size: 1.2rem; color: var(--color-primary); margin-bottom: 24px; border-bottom: 2px solid var(--color-accent); display: inline-block;">Non Coffee Ritual</h3>
              <?php display_menu_section($menu_categories['Non Coffee Ritual']); ?>
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
            <?php display_menu_section($menu_categories['Main Course']); ?>
          </div>

          <div style="margin-bottom: 48px;">
            <h3 class="editorial-label" style="font-size: 1.1rem; color: var(--color-primary); margin-bottom: 24px; border-bottom: 2px solid var(--color-accent); display: inline-block;">Rice Bowls</h3>
            <?php display_menu_section($menu_categories['Rice Bowls']); ?>
          </div>

          <div style="margin-bottom: 48px;">
            <h3 class="editorial-label" style="font-size: 1.1rem; color: var(--color-primary); margin-bottom: 24px; border-bottom: 2px solid var(--color-accent); display: inline-block;">Breakfast</h3>
            <?php display_menu_section($menu_categories['Breakfast']); ?>
          </div>

          <div>
            <h3 class="editorial-label" style="font-size: 1.1rem; color: var(--color-primary); margin-bottom: 24px; border-bottom: 2px solid var(--color-accent); display: inline-block;">Snacks & Bites</h3>
            <?php display_menu_section($menu_categories['Snacks & Bites']); ?>
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
