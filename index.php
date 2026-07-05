<?php 
session_start();
include 'connection.php';

// Process testimonial submission
if (isset($_POST['submit_testimonial'])) {
    $customer_name = mysqli_real_escape_string($connection, trim($_POST['customer_name']));
    $comment = mysqli_real_escape_string($connection, trim($_POST['comment']));
    
    if (!empty($customer_name) && !empty($comment)) {
        $sql = "INSERT INTO testimonials (customer_name, comment) VALUES ('$customer_name', '$comment')";
        if (mysqli_query($connection, $sql)) {
            echo "<script>alert('Thank you for your testimonial!'); window.location.href='index.php';</script>";
            exit();
        } else {
            echo "<script>alert('Failed to submit testimonial: " . mysqli_error($connection) . "');</script>";
        }
    } else {
        echo "<script>alert('Please fill in all fields!');</script>";
    }
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
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

        <!-- TESTIMONIALS SECTION -->
        <section id="testimonials" style="background: var(--color-primary, #2d1e17) !important; padding: 80px 0; border-top: 1px solid rgba(255, 255, 255, 0.05);">
            <div class="container">
                <div style="text-align: center; margin-bottom: 40px;">
                    <span class="about-eyebrow" style="color: #c9a050; font-size: 0.9rem; font-weight: 600; text-transform: uppercase; letter-spacing: 2px;">What Customers Say</span>
                    <h2 class="about-title" style="color: #faf9f6; font-size: 2.5rem; font-weight: 800; margin: 10px 0;">Latest Testimonials</h2>
                    <p style="color: #a8968e; font-size: 1rem; max-width: 600px; margin: 10px auto 0 auto;">Feedback and comments from our loyal customers.</p>
                </div>

                <!-- Testimonial Carousel Layout -->
                <div class="testimonial-carousel-container" style="max-width: 750px; margin: 0 auto 50px auto; position: relative; overflow: hidden; padding: 10px 0;">
                    <div class="testimonial-carousel-slides" style="position: relative; width: 100%; min-height: 250px;">
                        <?php
                        $query_testimonials = mysqli_query($connection, "SELECT * FROM testimonials ORDER BY id_testimonial DESC LIMIT 5");
                        $index = 0;
                        if (mysqli_num_rows($query_testimonials) > 0) {
                            while ($testimonial = mysqli_fetch_assoc($query_testimonials)) {
                        ?>
                                <div class="testimonial-slide" style="width: 100%; box-sizing: border-box; padding: 0 40px; text-align: center; opacity: 0; transition: opacity 0.6s ease-in-out; position: absolute; top: 0; left: 0; pointer-events: none; z-index: 1;">
                                    <div style="background: rgba(255, 255, 255, 0.02); border: 1px solid rgba(255, 255, 255, 0.07); border-radius: 16px; padding: 40px 30px; box-shadow: 0 10px 30px rgba(0,0,0,0.15);">
                                        <div style="font-size: 3rem; color: #c9a050; line-height: 0.8; font-family: Georgia, serif; margin-bottom: 5px;">“</div>
                                        <p style="font-style: italic; font-size: 1.15rem; line-height: 1.8; margin-bottom: 24px; color: #e5dfd9; margin-top: 0;">
                                            <?php echo htmlspecialchars($testimonial['comment']); ?>
                                        </p>
                                        <h4 style="color: #c9a050; font-size: 1.25rem; font-weight: 700; margin: 0 0 4px 0;"><?php echo htmlspecialchars($testimonial['customer_name']); ?></h4>
                                        <small style="color: #a8968e; font-size: 0.85rem;"><?php echo date('d M Y', strtotime($testimonial['date'])); ?></small>
                                    </div>
                                </div>
                        <?php
                                $index++;
                            }
                        } else {
                            echo '<div class="testimonial-slide" style="width: 100%; text-align: center; opacity: 1; position: relative;"><p style="color: #a8968e; font-style: italic;">No testimonials yet.</p></div>';
                        }
                        ?>
                    </div>

                    <!-- Navigation arrows -->
                    <?php if ($index > 1): ?>
                        <button class="carousel-prev" onclick="moveSlide(-1)" style="position: absolute; left: -10px; top: 40%; transform: translateY(-50%); background: transparent; border: none; color: #c9a050; font-size: 2.5rem; cursor: pointer; padding: 10px; transition: color 0.2s; z-index: 10;">‹</button>
                        <button class="carousel-next" onclick="moveSlide(1)" style="position: absolute; right: -10px; top: 40%; transform: translateY(-50%); background: transparent; border: none; color: #c9a050; font-size: 2.5rem; cursor: pointer; padding: 10px; transition: color 0.2s; z-index: 10;">›</button>
                        
                        <!-- Indicator Dots -->
                        <div class="carousel-dots" style="text-align: center; margin-top: 15px; display: flex; justify-content: center; gap: 8px; z-index: 10; position: relative;">
                            <?php for ($i = 0; $i < $index; $i++): ?>
                                <span class="dot" onclick="setSlide(<?php echo $i; ?>)" style="height: 10px; width: 10px; background-color: rgba(255,255,255,0.2); border-radius: 50%; display: inline-block; cursor: pointer; transition: all 0.3s;"></span>
                            <?php endfor; ?>
                        </div>
                    <?php endif; ?>
                </div>

                <!-- Testimonial Input Form -->
                <div style="max-width: 500px; margin: 0 auto; background: rgba(255, 255, 255, 0.03); border: 1px solid rgba(255, 255, 255, 0.08); border-radius: 16px; padding: 32px; box-shadow: 0 10px 30px rgba(0,0,0,0.2);">
                    <h3 style="color: #c9a050; font-size: 1.3rem; font-weight: 700; text-align: center; margin-bottom: 24px; margin-top: 0;">Submit Your Testimonial</h3>
                    <form action="index.php" method="POST">
                        <div style="margin-bottom: 16px;">
                            <label style="display: block; color: #faf9f6; font-size: 0.9rem; margin-bottom: 8px; font-weight: 500;">Full Name</label>
                            <input type="text" name="customer_name" required placeholder="Enter your name..." style="width: 100%; padding: 12px; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 8px; background: rgba(255, 255, 255, 0.05); color: #fff; box-sizing: border-box; font-size: 0.95rem;">
                        </div>
                        <div style="margin-bottom: 24px;">
                            <label style="display: block; color: #faf9f6; font-size: 0.9rem; margin-bottom: 8px; font-weight: 500;">Comment / Message</label>
                            <textarea name="comment" rows="4" required placeholder="Share your experience enjoying our coffee..." style="width: 100%; padding: 12px; border: 1px solid rgba(255, 255, 255, 0.15); border-radius: 8px; background: rgba(255, 255, 255, 0.05); color: #fff; box-sizing: border-box; font-size: 0.95rem; font-family: inherit; resize: vertical;"></textarea>
                        </div>
                        <button type="submit" name="submit_testimonial" style="width: 100%; padding: 14px; background-color: #c9a050; border: none; border-radius: 8px; color: #2d1e17; font-weight: bold; font-size: 1rem; cursor: pointer; transition: background 0.3s; box-shadow: 0 4px 12px rgba(201, 144, 80, 0.3);">Send Testimonial</button>
                    </form>
                </div>
            </div>
        </section>

        <!-- Carousel Javascript -->
        <script>
            let currentSlideIdx = 0;
            const slides = document.querySelectorAll('.testimonial-slide');
            const dots = document.querySelectorAll('.dot');
            let carouselInterval;

            function showSlide(n) {
                if (slides.length === 0) return;
                
                slides.forEach((slide) => {
                    slide.style.opacity = '0';
                    slide.style.pointerEvents = 'none';
                    slide.style.zIndex = '1';
                });
                if (dots.length > 0) {
                    dots.forEach((dot) => {
                        dot.style.backgroundColor = 'rgba(255, 255, 255, 0.2)';
                        dot.style.transform = 'scale(1)';
                    });
                }

                currentSlideIdx = (n + slides.length) % slides.length;
                
                slides[currentSlideIdx].style.opacity = '1';
                slides[currentSlideIdx].style.pointerEvents = 'auto';
                slides[currentSlideIdx].style.zIndex = '2';

                if (dots.length > 0 && dots[currentSlideIdx]) {
                    dots[currentSlideIdx].style.backgroundColor = '#c9a050';
                    dots[currentSlideIdx].style.transform = 'scale(1.2)';
                }
            }

            function moveSlide(step) {
                clearInterval(carouselInterval);
                showSlide(currentSlideIdx + step);
                startAutoPlay();
            }

            function setSlide(n) {
                clearInterval(carouselInterval);
                showSlide(n);
                startAutoPlay();
            }

            function startAutoPlay() {
                carouselInterval = setInterval(() => {
                    showSlide(currentSlideIdx + 1);
                }, 5000);
            }

            document.addEventListener('DOMContentLoaded', () => {
                showSlide(0);
                if (slides.length > 1) {
                    startAutoPlay();
                }
            });
        </script>

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
