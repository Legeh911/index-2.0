<?php 
session_start(); 
// 1. Determine login status via PHP Session immediately
$loggedIn = isset($_SESSION['user']); 
$username = $loggedIn ? $_SESSION['user'] : ''; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>INDEX 2.0</title>
  <link href="style.css" rel="stylesheet">
  <link rel="shortcut icon" type="image/jpeg" href="favicon1.jpg">

  <style>
    /* ── AUTH NAV PROFILE ── */
    .nav-profile {
      display: flex;
      align-items: center;
      gap: 0.65rem;
      position: relative;
    }

    .nav-avatar {
      width: 32px;
      height: 32px;
      border-radius: 50%;
      background: #d2691e; /* chocolate color */
      color: #ffffff;
      font-size: 0.85rem;
      font-weight: 700;
      display: flex;
      align-items: center;
      justify-content: center;
      letter-spacing: 0;
      flex-shrink: 0;
    }

    .nav-username {
      font-size: 0.78rem;
      font-weight: 500;
      letter-spacing: 0.08em;
      color: rgba(255,255,255,0.85);
      text-transform: none;
    }

    .nav-logout-btn {
      background: transparent;
      border: 1px solid rgba(210,105,30,0.35);
      color: rgba(255,255,255,0.5);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.72rem;
      letter-spacing: 0.1em;
      text-transform: uppercase;
      padding: 0.3rem 0.75rem;
      border-radius: 40px;
      cursor: pointer;
      text-decoration: none;
      transition: all 0.25s;
    }
    .nav-logout-btn:hover {
      border-color: #d2691e;
      color: #ffffff;
      background: rgba(210,105,30,0.1);
    }

    /* ── AUTH WIDGET ── */
    .auth-nav-widget {
      display: flex;
      align-items: center;
      margin-left: 1.5rem;
      flex-shrink: 0;
    }
    .nav-login-btn {
      display: inline-block;
      padding: 0.38rem 1.1rem;
      border: 1px solid rgba(210,105,30,0.55);
      border-radius: 40px;
      color: rgba(255,255,255,0.8);
      font-family: 'DM Sans', sans-serif;
      font-size: 0.78rem;
      font-weight: 500;
      letter-spacing: 0.09em;
      text-transform: uppercase;
      text-decoration: none;
      transition: all 0.25s;
      white-space: nowrap;
    }
    .nav-login-btn:hover {
      background: rgba(210,105,30,0.15);
      border-color: #d2691e;
      color: #ffffff;
    }

    /* ── HAMBURGER ── */
    .hamburger {
      display: none;
      flex-direction: column;
      gap: 5px;
      background: none;
      border: none;
      cursor: pointer;
      padding: 4px;
    }
    .hamburger span {
      display: block;
      width: 22px;
      height: 1.5px;
      background: #ffffff;
      border-radius: 2px;
      transition: all 0.3s;
    }
    @media (max-width: 600px) {
      .hamburger { display: flex; }
      .nav-links.open { display: flex !important; flex-direction: column; position: fixed; top: 60px; left: 0; right: 0; background: rgba(14,6,0,0.98); padding: 2rem 6%; gap: 1.2rem; border-bottom: 1px solid rgba(210,105,30,0.15); z-index: 99; }
    }

    /* ── WELCOME TOAST ── */
    .toast {
      position: fixed;
      bottom: 2rem;
      right: 2rem;
      background: #0e0600;
      border: 1px solid rgba(210,105,30,0.3);
      border-radius: 10px;
      padding: 1rem 1.4rem;
      display: flex;
      align-items: center;
      gap: 0.8rem;
      z-index: 9999;
      transform: translateY(120%);
      opacity: 0;
      transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
      max-width: 320px;
    }
    .toast.show { transform: translateY(0); opacity: 1; }
    .toast-avatar {
      width: 36px; height: 36px;
      border-radius: 50%;
      background: #d2691e;
      color: white;
      font-size: 1rem;
      font-weight: 700;
      display: flex; align-items: center; justify-content: center;
      flex-shrink: 0;
    }
    .toast-text strong { display: block; font-size: 0.88rem; color: #ffffff; margin-bottom: 0.1rem; }
    .toast-text span { font-size: 0.75rem; color: rgba(255,255,255,0.4); }
  </style>
</head>
<body>

<div class="toast" id="welcomeToast">
  <div class="toast-avatar" id="toastAvatar">?</div>
  <div class="toast-text">
    <strong id="toastTitle">Welcome!</strong>
    <span id="toastSub">You're now signed in.</span>
  </div>
</div>

<nav>
  <div class="nav-logo">Index <span>2.0</span></div>

  <button class="hamburger" id="hamburger" aria-label="Toggle menu">
    <span></span>
    <span></span>
    <span></span>
  </button>

  <ul class="nav-links" id="nav-links">
    <li><a href="index.php">Home</a></li>
    <li><a href="about.html">About</a></li>
    <li class="dropdown">
      <a href="#" class="dropbtn">Services ▾</a>
      <div class="dropdown-content">
        <a href="videography.html">Videography</a>
        <a href="photography.html">Photography</a>
        <a href="web-design.html">Web Design</a>
        <a href="contentcreation.html">Content Creation</a>
      </div>
    </li>
    <li><a href="contact.html">Contact</a></li>
    <li><a href="book us page.html" class="nav-cta">Book Us</a></li>
  </ul>

  <div class="auth-nav-widget">
    <?php if ($loggedIn): ?>
      <div class="nav-profile">
        <div class="nav-avatar"><?= strtoupper(substr($username, 0, 1)) ?></div>
        <span class="nav-username"><?= htmlspecialchars($username) ?></span>
        <a href="logout.php" class="nav-logout-btn">Log Out</a>
      </div>
    <?php else: ?>
      <a href="login.html" class="nav-login-btn">Log In</a>
    <?php endif; ?>
  </div>
</nav>


<div class="slider" id="slider">
  <div class="progress-track">
    <div class="progress-fill" id="progressFill"></div>
  </div>

  <div class="slide slide-1 active">
    <div class="slide-bg"></div>
    <div class="slide-overlay"></div>
    <div class="slide-content">
      <div class="slide-tag">Creative Studio — Accra</div>
      <h1 class="slide-title">We Tell Stories<br>That <em>Move People</em></h1>
      <p class="slide-desc">A creative media house dedicated to helping brands and individuals bring ideas to life through powerful digital content.</p>
    </div>
  </div>

  <div class="slide slide-2">
    <div class="slide-bg"></div>
    <div class="slide-overlay"></div>
    <div class="slide-content">
      <div class="slide-tag">Photography & Visuals</div>
      <h1 class="slide-title">Frame Your Brand<br>in <em>Pure Light</em></h1>
      <p class="slide-desc">Editorial and commercial photography that captures the essence of your brand with intentional, striking imagery.</p>
    </div>
  </div>

  <div class="slide slide-3">
    <div class="slide-bg"></div>
    <div class="slide-overlay"></div>
    <div class="slide-content">
      <div class="slide-tag">Content Creation</div>
      <h1 class="slide-title">Where <em>Ideas</em><br>Come Alive</h1>
      <p class="slide-desc">Strategy-led content for social media, campaigns and brands that want to stay relevant, engaged and growing.</p>
    </div>
  </div>

  <div class="slider-nav" id="dotsContainer">
    <div class="dot active" data-index="0"></div>
    <div class="dot" data-index="1"></div>
    <div class="dot" data-index="2"></div>
  </div>

  <div class="arrow">
    <button class="arrow-btn" id="prevBtn" aria-label="Previous">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="15 18 9 12 15 6"/></svg>
    </button>
    <button class="arrow-btn" id="nextBtn" aria-label="Next">
      <svg viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.5"><polyline points="9 6 15 12 9 18"/></svg>
    </button>
  </div>
</div>

<script>
  const slides = document.querySelectorAll('.slide');
  const dots = document.querySelectorAll('.dot');
  const progressFill = document.getElementById('progressFill');
  const DURATION = 5500;
  let current = 0;
  let timer;

  function goTo(index) {
    slides[current].classList.remove('active');
    dots[current].classList.remove('active');
    current = (index + slides.length) % slides.length;
    slides[current].classList.add('active');
    dots[current].classList.add('active');
    startProgress();
  }

  function startProgress() {
    clearTimeout(timer);
    progressFill.style.transition = 'none';
    progressFill.style.width = '0%';
    requestAnimationFrame(() => {
      requestAnimationFrame(() => {
        progressFill.style.transition = `width ${DURATION}ms linear`;
        progressFill.style.width = '100%';
      });
    });
    timer = setTimeout(() => goTo(current + 1), DURATION);
  }

  document.getElementById('nextBtn').addEventListener('click', () => goTo(current + 1));
  document.getElementById('prevBtn').addEventListener('click', () => goTo(current - 1));

  dots.forEach(dot => {
    dot.addEventListener('click', () => goTo(parseInt(dot.dataset.index)));
  });

  document.getElementById('hamburger').addEventListener('click', () => {
    document.getElementById('nav-links').classList.toggle('open');
  });

  startProgress();
</script>
  
<section class="services" id="services">
  <div class="section-label">What We Do</div>
  <h2 class="section-title">Crafted for Brands That Want to Stand Out</h2>
  <div class="services-grid">
    <div class="service-card">
      <div class="service-icon"><svg viewBox="0 0 24 24"><rect x="2" y="2" width="20" height="20" rx="2.18" ry="2.18"/><line x1="7" y1="2" x2="7" y2="22"/><line x1="17" y1="2" x2="17" y2="22"/><line x1="2" y1="12" x2="22" y2="12"/><line x1="2" y1="7" x2="7" y2="7"/><line x1="2" y1="17" x2="7" y2="17"/><line x1="17" y1="17" x2="22" y2="17"/><line x1="17" y1="7" x2="22" y2="7"/></svg></div>
      <h3>Videography</h3>
      <p>Cinematic storytelling from concept to final cut. Brand films, documentaries, event coverage, and social-first video content.</p>
    </div>
    <div class="service-card">
      <div class="service-icon"><svg viewBox="0 0 24 24"><circle cx="12" cy="12" r="10"/><circle cx="12" cy="10" r="3"/><path d="M7 20.662V19a2 2 0 0 1 2-2h6a2 2 0 0 1 2 2v1.662"/></svg></div>
      <h3>Photography</h3>
      <p>Editorial, commercial, and portrait photography that captures the essence of your brand with intentional, striking imagery.</p>
    </div>
    <div class="service-card">
      <div class="service-icon"><svg viewBox="0 0 24 24"><polyline points="16 18 22 12 16 6"/><polyline points="8 6 2 12 8 18"/></svg></div>
      <h3>Web Design</h3>
      <p>Beautiful, high-performance websites and digital experiences that convert visitors into loyal customers.</p>
    </div>
    <div class="service-card">
      <div class="service-icon"><svg viewBox="0 0 24 24"><path d="M12 20h9"/><path d="M16.5 3.5a2.121 2.121 0 0 1 3 3L7 19l-4 1 1-4L16.5 3.5z"/></svg></div>
      <h3>Content Creation</h3>
      <p>Strategy-led content for social media, blogs, and campaigns. We help brands stay relevant, engaged, and growing.</p>
    </div>
  </div>
</section>

<!-- GALLERY PREVIEW -->
<section class="gallery">
  <div class="gallery-header">
    <div>
      <div class="section-label">Our Work</div>
      <h2 class="section-title" style="color:var(--white)">Our Creative Studio</h2>
    </div>
  </div>

  <div class="gallery-grid">
    <div class="gallery-item1">
      <div class="gallery-item-inner" style="background: linear-gradient(160deg, rgba(210,105,30,0.3) 0%, rgba(26,10,0,0.95) 100%);">
        <span class="gallery-label">Videography</span>
      </div>
    </div>
   
    <div class="gallery-item3">
      <div class="gallery-item-inner2" style="background: linear-gradient(160deg, rgba(160,60,0,0.35) 0%, rgba(26,10,0,0.9) 100%);">
        <span class="gallery-label">Photography</span>
      </div>
    </div>
     <div class="gallery-item2">
      <div class="gallery-item-inner1" style="background: linear-gradient(160deg, rgba(255,106,0,0.25) 0%, rgba(26,10,0,0.9) 100%);">
        <span class="gallery-label">Editorial</span>
      </div>
    </div>
    <div class="gallery-item4">
      <div class="gallery-item-inner" style="background: linear-gradient(160deg, rgba(210,105,30,0.2) 0%, rgba(26,10,0,0.9) 100%);">
        <span class="gallery-label">Web Design</span>
      </div>
    </div>
    <div class="gallery-item5">
      <div class="gallery-item-inner4" style="background: linear-gradient(160deg, rgba(255,179,71,0.2) 0%, rgba(26,10,0,0.9) 100%);">
        <span class="gallery-label">Social Content</span>
      </div>
    </div>
  </div>
</section>

<!-- ABOUT STRIP -->
<section class="about-strip">
  <div>
    <h2>Built on a Passion<br>for Storytelling</h2>
    <div class="stats-row">
      <div>
        <div class="stat-num">100+</div>
        <div class="stat-label">Projects Delivered</div>
      </div>
      <div>
        <div class="stat-num">4</div>
        <div class="stat-label">Core Services</div>
      </div>
      <div>
        <div class="stat-num">∞</div>
        <div class="stat-label">Creative Ideas</div>
      </div>
    </div>
  </div>
  <div>
    <p>Every brand has a unique story that deserves to be told in a compelling and professional way. At Index 2.0, we combine creative vision with technical excellence to produce content that resonates, converts, and endures.</p>
    <br/>
    <p>Based in Accra, Ghana — we serve clients across West Africa and beyond.</p>
    <br/>
  </div>
</section>

<footer>
  <div class="footer-top">
    <div class="footer-brand">
      <h3>Index <span>2.0</span></h3>
      <p>A creative media house bringing brands to life through powerful digital content and innovative design.</p>
    </div>
    <div class="footer-col">
      <h4>Services</h4>
      <a href="videography.html">Videography</a>
      <a href="photography.html">Photography</a>
      <a href="web-design.html">Web Design</a>
      <a href="contentcreation.html">Content Creation</a>
    </div>
    <div class="footer-col">
      <h4>Company</h4>
      <a href="index.php">Home</a>
      <a href="about.html">About</a>
      <a href="contact.html">Contact</a>
    </div>
    <div class="footer-col">
      <h4>Contact</h4>
      <a href="#">index2.0@gmail.com</a>
      <a href="#">+233 557 438 156</a>
      <a href="#">Octagon, Accra</a>
    </div>
  </div>
  <div class="footer-bottom">
    <p>&copy; 2026 Index 2.0. All rights reserved.</p>
  </div>
</footer>

<script src="auth.js"></script>
<script>
  
  
  // 4. Show welcome toast if just logged in using PHP session trigger
  <?php if (isset($_SESSION['just_logged_in'])): ?>
      const toast = document.getElementById('welcomeToast');
      document.getElementById('toastAvatar').textContent = "<?= strtoupper(substr($username, 0, 1)) ?>";
      document.getElementById('toastTitle').textContent  = "Welcome back, <?= htmlspecialchars($username) ?>!";
      setTimeout(() => toast.classList.add('show'), 500);
      setTimeout(() => toast.classList.remove('show'), 5000);
      <?php unset($_SESSION['just_logged_in']); ?>
  <?php endif; ?>
</script>

</body>
</html>