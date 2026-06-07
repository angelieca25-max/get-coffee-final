<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>About Us – Get Coffee</title>
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
        <li><a class="navbar__link" href="menu.php">Menu</a></li>
        <li><a class="navbar__link active" href="about.php">About</a></li>
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
      <a class="navbar__link" href="menu.php">Menu</a>
      <a class="navbar__link active" href="about.php">About</a>
      <a class="navbar__cta" href="https://wa.me/6282148295479" style="display: block; text-align: center; margin-top: 10px;">Order Now</a>
    </div>
  </nav>

  <main style="padding-top: 140px;">
    <section class="about-section">
      <div class="container about-inner">
        <div class="about-images" data-reveal>
          <img class="about-img-1" src="images/about2.jpg" alt="Biji kopi pilihan" />
          <img class="about-img-2" src="images/about.jpg" alt="Suasana Kafe" />
        </div>
        <div class="about-content" data-reveal>
          <span class="about-eyebrow">The Story Behind</span>
          <h2 class="about-title">Lebih dari sekadar kopi, ini soal momen.</h2>
          <p class="about-text">
            GetCoffeeID hadir untuk menghadirkan pengalaman menikmati kopi berkualitas dengan cita rasa autentik. Kami percaya bahwa setiap cangkir kopi membawa cerita dan inspirasi tersendiri.
          </p>
          <p class="about-text">
            Sejak 2025, kami berkomitmen menyajikan produk kopi dari biji pilihan yang diproses dengan standar terbaik, menciptakan harmoni rasa yang sempurna untuk menemani hari-harimu.
          </p>
        </div>
      </div>
    </section>

    <section class="locations-section">
      <div class="container">
        <div class="locations-header" data-reveal>
          <h2 class="section-title">Kunjungi & Hubungi Kami</h2>
          <p class="section-subtitle">Temukan gerai Get Coffee terdekat atau hubungi kami untuk informasi lebih lanjut.</p>
        </div>
        <div class="locations-grid">
          <div class="locations-list" data-reveal>
            <div class="location-card active" data-location="0">
              <h3 class="location-card__name">Get Coffee – Pontianak Pusat</h3>
              <p class="location-card__addr">Jl. Ismail Marzuki, Pontianak Selatan</p>
            </div>
            
            <div style="margin-top: 32px;">
              <h3 style="font-size: 1.2rem; font-weight: 800; color: var(--color-primary); margin-bottom: 16px; padding-left: 8px;">Hubungi Kami</h3>
              <a href="https://www.instagram.com/getcoffee.idn?igsh=MXNpODdvMjJueDB1" target="_blank" class="location-card" style="display: flex; align-items: center; gap: 16px; text-decoration: none;">
                <span style="font-size: 1.8rem; line-height: 1;">📷</span>
                <div>
                  <h3 class="location-card__name">Instagram</h3>
                  <p class="location-card__addr">@getcoffee.idn</p>
                </div>
              </a>
              <a href="https://wa.me/6282148295479" target="_blank" class="location-card" style="display: flex; align-items: center; gap: 16px; text-decoration: none;">
                <span style="font-size: 1.8rem; line-height: 1;">📞</span>
                <div>
                  <h3 class="location-card__name">WhatsApp</h3>
                  <p class="location-card__addr">082148295479</p>
                </div>
              </a>
            </div>
          </div>
          <div class="locations-map-panel" data-reveal>
            <iframe src="https://www.google.com/maps/embed?pb=!1m14!1m8!1m3!1d7979.635458500655!2d109.3376837!3d-0.0311881!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d5900113e407f%3A0x78c99b5093792841!2sGet%20Coffee!5e0!3m2!1sen!2sid!4v1777459306905!5m2!1sen!2sid" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
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
