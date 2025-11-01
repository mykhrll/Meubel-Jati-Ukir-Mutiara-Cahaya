<?php
// Halaman Beranda Meubel Jati Ukir Mutiara Cahaya
?>
<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Meubel Jati Ukir Mutiara Cahaya</title>
  <link rel="stylesheet" href="style.css">
  <!-- AOS Animation Library -->
  <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
</head>
<body>

  <!-- Header -->
  <header>
    <div class="logo-container">
      <img src="img/logo.png" alt="Logo Meubel Jati Ukir" class="logo">
    </div>
    <nav class="navbar">
      <ul>
        <li><a href="index.php" class="active">Beranda</a></li>
        <li><a href="#">Produk</a></li>
        <li><a href="#">Tentang Kami</a></li>
        <li><a href="#">Kontak</a></li>
      </ul>
    </nav>
  </header>

  <!-- Banner -->
  <section class="hero">
    <div class="banner-container">
      <img src="img/banner.png" alt="Banner Meubel Jati Ukir" class="banner">
      <div class="gradient-overlay"></div>
    </div>
  </section>

  <!-- Konten utama -->
  <section class="content">
    <h2 class="hidden">Selamat Datang di Meubel Jati Ukir Mutiara Cahaya</h2>
    <p class="hidden">
      Kami menghadirkan keindahan ukiran jati khas Indonesia dengan sentuhan elegan dan tahan lama. 
      Setiap produk kami dibuat oleh pengrajin berpengalaman yang menjaga keaslian seni dan kualitas kayu terbaik.
    </p>

    <div class="feature">
      <div class="card hidden">
        <h3>Kualitas Premium</h3>
        <p>Produk dibuat dari kayu jati pilihan dengan ukiran detail dan finishing halus.</p>
      </div>
      <div class="card hidden">
        <h3>Desain Eksklusif</h3>
        <p>Menggabungkan tradisi dan modernitas dalam setiap karya meubel kami.</p>
      </div>
      <div class="card hidden">
        <h3>Pelayanan Terbaik</h3>
        <p>Kami siap membantu Anda dalam pemesanan custom dan konsultasi desain.</p>
      </div>
    </div>
  </section>

  <!-- Footer -->
  <footer>
    <p>&copy; <?php echo date("Y"); ?> Meubel Jati Ukir Mutiara Cahaya. All rights reserved.</p>
  </footer>

  <!-- Script AOS dan animasi scroll -->
  <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
  <script>
    AOS.init({
      duration: 1000,
      once: false, // biar animasi muncul terus tiap scroll
      offset: 100,
    });

    // Intersection Observer untuk elemen custom class "hidden"
    const observer = new IntersectionObserver((entries) => {
      entries.forEach(entry => {
        if (entry.isIntersecting) {
          entry.target.classList.add('show');
        } else {
          entry.target.classList.remove('show');
        }
      });
    });

    const hiddenElements = document.querySelectorAll('.hidden');
    hiddenElements.forEach(el => observer.observe(el));
  </script>
</body>
</html>