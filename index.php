<?php 
session_start();
if (!isset($_SESSION['status']) || $_SESSION['status'] != "login") {
    header("location:login.php");
    exit;
}
?>

<!DOCTYPE html>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Get Coffee – Kopi Berkualitas, Momen Bermakna</title>
    <meta name="description" content="Get Coffee – Brand kopi pilihan dengan cita rasa autentik. Tersedia minuman kopi, non-coffee, dan makanan berkualitas." />
    <link rel="stylesheet" href="css/style.css" />
    <link rel="preconnect" href="https://fonts.googleapis.com" />
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght@300;400;500;600;700;800&display=swap" rel="stylesheet" />
</head>
<body>

    <!-- NAVBAR -->
    <nav class="navbar">
        <div class="navbar__inner">
            <a class="navbar__logo" href="index.php">
                <img class="navbar__logo-img" src="images/logo.jpeg" alt="Get Coffee Logo" />
                <span class="navbar__brand">Get Coffee</span>
            </a>
            <ul class="navbar__links">
                <li><a class="navbar__link active" href="index.php">Home</a></li>
                <li><a class="navbar__link" href="menu.php">Menu</a></li>
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
            <a class="navbar__link active" href="index.php">Home</a>
            <a class="navbar__link" href="menu.php">Menu</a>
            <a class="navbar__link" href="about.php">About</a>
            <a class="navbar__cta" href="https://wa.me/6282148295479" style="display: block; text-align: center; margin-top: 10px;">Order Now</a>
        </div>
    </nav>

    <main>
        <!-- HERO -->
        <section class="hero">
            <div class="container hero__inner">
                <div class="hero__content">
                    <span class="hero__badge animate-fade-up">
                        <svg class="hero__badge-icon" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="M17 8h1a4 4 0 0 1 0 8h-1" />
                            <path d="M3 8h14v9a4 4 0 0 1-4 4H7a4 4 0 0 1-4-4V8z" />
                            <line x1="6" y1="1" x2="6" y2="4" />
                            <line x1="10" y1="1" x2="10" y2="4" />
                            <line x1="14" y1="1" x2="14" y2="4" />
                        </svg>
                        Premium Specialty Coffee
                    </span>
                    <h1 class="hero__title animate-fade-up delay-1">
                        Mulai Hari dengan <span class="highlight">Kopi Sempurna.</span>
                    </h1>
                    <p class="hero__desc animate-fade-up delay-2">
                        Nikmati mahakarya kopi dari biji pilihan. Diracik dengan presisi untuk menghadirkan harmoni rasa yang tak terlupakan di setiap sesapan.
                    </p>
                    <div class="hero__buttons animate-fade-up delay-3">
                        <a href="https://wa.me/6282148295479" class="btn-primary--large">Pesan Sekarang</a>
                        <a href="about.php" class="btn-link">Pelajari Rahasia Kami</a>
                    </div>
                </div>
                <div class="hero__image-panel animate-fade-in delay-2">
                    <div class="hero__floating-card">
                        <div class="hero__floating-card-icon">☕</div>
                        <div>
                            <div class="hero__floating-card-text">Specialty Grade</div>
                            <div class="hero__floating-card-sub">Top 5% Global Beans</div>
                        </div>
                    </div>
                    <div class="hero__main-img-wrapper">
                        <img class="hero__main-img" src="images/hero.jpg" alt="Premium Latte Art" />
                    </div>
                </div>
            </div>
        </section>

        <!-- MENU UNGGULAN -->
        <section class="menu-section">
            <div class="container">
                <div class="menu-section__header" data-reveal>
                    <h2 class="section-title">Menu Unggulan</h2>
                    <p class="section-subtitle">Koleksi minuman spesial yang diracik dengan dedikasi tinggi untuk para pecinta kopi sejati.</p>
                </div>
                <div class="menu-grid">
                    <article class="menu-card card-large" data-reveal>
                        <div class="menu-card__bg"><img src="images/Menu/Coffee(2).png" alt="Dubai Latte" loading="lazy" /></div>
                        <div class="menu-card__content">
                            <span class="menu-card__label">Signature Brew</span>
                            <h3 class="menu-card__title">First Strike</h3>
                            <div class="menu-card__price">Rp 20.000</div>
                        </div>
                    </article>
                    <article class="menu-card card-tall" data-reveal>
                        <div class="menu-card__bg"><img src="images/Menu/Coffee(3).png" alt="Matcha Premium" loading="lazy" /></div>
                        <div class="menu-card__content">
                            <span class="menu-card__label">Signature</span>
                            <h3 class="menu-card__title">Scotch Latte</h3>
                            <div class="menu-card__price">Rp 25.000</div>
                        </div>
                    </article>                    <article class="menu-card card-tall" data-reveal>
                        <div class="menu-card__bg"><img src="images/Menu/mockptr.png" alt="sunkissed" loading="lazy" /></div>
                        <div class="menu-card__content">
                            <span class="menu-card__label">Mocktail</span>
                            <h3 class="menu-card__title">Sunkissed</h3>
                            <div class="menu-card__price">Rp 25.000</div>
                        </div>
                    </article>
                    <article class="menu-card card-wide" data-reveal>
                        <div class="menu-card__bg"><img src="images/Menu/mockland.png" alt="passion Paradise" loading="lazy" /></div>
                        <div class="menu-card__content">
                            <span class="menu-card__label">Mocktail</span>
                            <h3 class="menu-card__title">Passion Paradise</h3>
                            <div class="menu-card__price">Rp 25.000</div>
                        </div>
                    </article>
                    <article class="menu-card" data-reveal>
                        <div class="menu-card__bg"><img src="images/Menu/Food (4).png" alt="Dubai Latte" loading="lazy" /></div>
                        <div class="menu-card__content">
                            <h3 class="menu-card__title">Mie Katsu</h3>
                            <div class="menu-card__price">Rp 28.000</div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- ABOUT -->
        <section class="about-section">
            <div class="container about-inner">
                <div class="about-images" data-reveal>
                    <img class="about-img-1" src="images/about2.jpg" alt="Biji kopi pilihan" />
                    <img class="about-img-2" src="images/about.jpg" alt="Suasana Kafe" />
                </div>
                <div class="about-content" data-reveal>
                    <span class="about-eyebrow">The Story Behind</span>
                    <h2 class="about-title">Lebih dari sekadar kopi, ini soal momen.</h2>
                    <p class="about-text">GetCoffeeID hadir untuk menghadirkan pengalaman menikmati kopi berkualitas dengan cita rasa autentik. Kami percaya bahwa setiap cangkir kopi membawa cerita dan inspirasi tersendiri.</p>
                    <a class="btn-primary" href="about.php">Tentang Kami</a>
                </div>
            </div>
        </section>

    </main>

    <!-- FOOTER -->
    <footer class="footer">
        <div class="container">
            <div class="footer__grid">
                <div class="footer__brand">
                    <div class="footer__logo">
                        <img class="footer__logo-img" src="images/logo.jpeg" alt="Get Coffee Logo" />
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

// refresh stats github
// update index ke php
