document.addEventListener('DOMContentLoaded', () => {

  /* ---------- Navbar Scroll Effect ---------- */
  const navbar = document.querySelector('.navbar');
  const handleScroll = () => {
    navbar.classList.toggle('scrolled', window.scrollY > 50);
  };
  window.addEventListener('scroll', handleScroll);

  /* ---------- Mobile Menu Toggle ---------- */
  const hamburger = document.querySelector('.navbar__hamburger');
  const mobileNav = document.querySelector('.navbar__mobile');

  hamburger?.addEventListener('click', () => {
    hamburger.classList.toggle('open');
    mobileNav.classList.toggle('open');
  });

  /* ---------- Active Nav Link Logic ---------- */
  const navLinks = document.querySelectorAll('.navbar__link');
  const currentPath = window.location.pathname.split('/').pop() || 'index.html';

  const updateActiveOnPath = () => {
    navLinks.forEach(link => {
      const href = link.getAttribute('href');
      // Handle both absolute and relative paths
      const linkPath = href.split('/').pop();
      link.classList.toggle('active', linkPath === currentPath);
    });
  };

  updateActiveOnPath();

  /* ---------- Scroll Reveal Animation ---------- */
  const revealElements = document.querySelectorAll('[data-reveal]');
  const revealObserver = new IntersectionObserver((entries) => {
    entries.forEach(entry => {
      if (entry.isIntersecting) {
        entry.target.classList.add('revealed');
      }
    });
  }, { threshold: 0.15 });

  revealElements.forEach(el => revealObserver.observe(el));

  /* ---------- Location Tab Switching ---------- */
  const locationCards = document.querySelectorAll('.location-card');
  const mapIframe = document.getElementById('map-iframe');

  const maps = [
    'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.6756!2d109.3306!3d-0.0263!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e1d591b1334b4fd%3A0xa7de8f7b2d1c4f1e!2sGet%20Coffee!5e0!3m2!1sen!2sid!4v1690000000000',
    'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3989.68!2d109.335!3d-0.02!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x0%3A0x0!2zMMKwMDEnMTIuMCJTIDEwOcKwMjAnMDYuMCJF!5e0!3m2!1sen!2sid!4v1690000000000'
  ];

  locationCards.forEach((card, index) => {
    card.addEventListener('click', () => {
      locationCards.forEach(c => c.classList.remove('active'));
      card.classList.add('active');
      if (mapIframe) mapIframe.src = maps[index];
    });
  });

  /* ---------- Smooth Anchor Scrolling ---------- */
  document.querySelectorAll('a[href^="#"]').forEach(anchor => {
    anchor.addEventListener('click', function (e) {
      const targetId = this.getAttribute('href');
      const targetElement = document.querySelector(targetId);
      
      if (targetElement) {
        e.preventDefault();
        const offset = 100;
        const targetPosition = targetElement.getBoundingClientRect().top + window.pageYOffset - offset;
        window.scrollTo({
          top: targetPosition,
          behavior: 'smooth'
        });
        
        // Close mobile nav if open
        hamburger?.classList.remove('open');
        mobileNav?.classList.remove('open');
      }
    });
  });

  /* ---------- Scroll To Top ---------- */
  const scrollTopBtn = document.querySelector('.scroll-top');
  window.addEventListener('scroll', () => {
    scrollTopBtn?.classList.toggle('visible', window.scrollY > 600);
  });
  scrollTopBtn?.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
});
