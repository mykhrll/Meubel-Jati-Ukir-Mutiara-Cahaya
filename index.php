<?php include 'header.php'; ?>

<style>
    /* CSS Slider/Marquee Animation */
    .slider-container {
        overflow: hidden;
        padding: 40px 0;
        background: transparent; /* UBAH JADI TRANSPARAN */
        position: relative;
    }
    
    .slider-track {
        display: flex;
        gap: 20px;
        width: calc(300px * 8); 
        animation: scroll 20s linear infinite; /* Sedikit diperlambat biar smooth */
    }

    /* Animasi Jalan */
    @keyframes scroll {
        0% { transform: translateX(0); }
        100% { transform: translateX(calc(-300px * 4)); }
    }

    /* Berhenti saat Hover */
    .slider-track:hover {
        animation-play-state: paused;
    }

    .slide-item {
        width: 300px;
        flex-shrink: 0;
        transition: transform 0.3s;
    }
    
    .slide-item:hover {
        transform: scale(1.05);
    }

    /* Pastikan background kartu produk tetap putih */
    .product-card {
        background: #fff; 
    }
</style>

    <section class="hero-section" style="height: 85vh;">
        <div style="position: absolute; top: 0; left: 0; width: 100%; height: 100%; 
                    background: url('img/banner.png') center/cover; z-index: 0;" 
             class="hero-animate-bg"></div>

        <div class="container hero-content">
            <div class="row">
                <div class="col-12">
                    <h1 class="display-3 fw-bold mb-4 animate-fade-in">Meubel Jati Ukir Mutiara Cahaya</h1>
                    <p class="lead mb-4 fs-4 animate-fade-in" style="animation-delay: 0.2s;">
                        Keindahan Ukiran Jati Khas Indonesia dengan Sentuhan Elegan dan Tahan Lama
                    </p>
                    <a href="produk.php" class="btn btn-warning btn-lg px-5 py-3 rounded-pill fw-bold shadow animate-fade-in" style="animation-delay: 0.4s;">
                        Lihat Koleksi <i class="fas fa-arrow-right ms-2"></i>
                    </a>
                </div>
            </div>
        </div>
    </section>

    <main class="container py-5">
        
        <section class="mb-5">
            <div class="row g-4">
                <div class="col-md-4">
                    <div class="feature-card text-center animate-fade-in">
                        <div class="image-placeholder bg-white">
                             <img src="img/kualitas.jpg" style="width:100%; height:100%; object-fit:contain;">
                        </div>
                        <h4>Kualitas Premium</h4>
                        <p>Kayu jati pilihan dengan ukiran detail.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center animate-fade-in">
                        <div class="image-placeholder bg-white">
                             <img src="img/desain.png" style="width:100%; height:100%; object-fit:contain;">
                        </div>
                        <h4>Desain Eksklusif</h4>
                        <p>Modern dan Tradisional.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card text-center animate-fade-in">
                        <div class="image-placeholder bg-white">
                             <img src="img/pelayanan.jpg" style="width:100%; height:100%; object-fit:contain;">
                        </div>
                        <h4>Pelayanan Terbaik</h4>
                        <p>Konsultasi desain custom.</p>
                    </div>
                </div>
            </div>
        </section>
        
        <section id="produk" class="mb-5 overflow-hidden">
            <h2 class="section-title text-center mb-4">Koleksi Terpopuler</h2>
            <p class="text-center text-muted mb-4">Geser mouse ke produk untuk berhenti.</p>
            
            <div class="slider-container">
                <div class="slider-track">
                    <div class="slide-item">
                        <div class="product-card text-center h-100 shadow-sm">
                            <div class="image-placeholder p-0">
                                <img src="img/kursi jati.jpeg" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                            <h5 class="mt-3">Kursi Tamu Jati</h5>
                            <span class="price-tag" onclick="window.location.href='produk.php'" style="cursor:pointer;">Lihat Detail</span>
                        </div>
                    </div>
                    <div class="slide-item">
                        <div class="product-card text-center h-100 shadow-sm">
                            <div class="image-placeholder p-0">
                                <img src="img/meja makan.jpeg" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                            <h5 class="mt-3">Meja Makan</h5>
                            <span class="price-tag" onclick="window.location.href='produk.php'" style="cursor:pointer;">Lihat Detail</span>
                        </div>
                    </div>
                    <div class="slide-item">
                        <div class="product-card text-center h-100 shadow-sm">
                            <div class="image-placeholder p-0">
                                <img src="img/lemari.jpeg" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                            <h5 class="mt-3">Lemari Pakaian</h5>
                            <span class="price-tag" onclick="window.location.href='produk.php'" style="cursor:pointer;">Lihat Detail</span>
                        </div>
                    </div>
                    <div class="slide-item">
                        <div class="product-card text-center h-100 shadow-sm">
                            <div class="image-placeholder p-0">
                                <img src="img/kasur.jpg" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                            <h5 class="mt-3">Tempat Tidur</h5>
                            <span class="price-tag" onclick="window.location.href='produk.php'" style="cursor:pointer;">Lihat Detail</span>
                        </div>
                    </div>

                    <div class="slide-item">
                        <div class="product-card text-center h-100 shadow-sm">
                            <div class="image-placeholder p-0">
                                <img src="img/kursi jati.jpeg" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                            <h5 class="mt-3">Kursi Tamu Jati</h5>
                            <span class="price-tag" onclick="window.location.href='produk.php'" style="cursor:pointer;">Lihat Detail</span>
                        </div>
                    </div>
                    <div class="slide-item">
                        <div class="product-card text-center h-100 shadow-sm">
                            <div class="image-placeholder p-0">
                                <img src="img/meja makan.jpeg" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                            <h5 class="mt-3">Meja Makan</h5>
                            <span class="price-tag" onclick="window.location.href='produk.php'" style="cursor:pointer;">Lihat Detail</span>
                        </div>
                    </div>
                     <div class="slide-item">
                        <div class="product-card text-center h-100 shadow-sm">
                            <div class="image-placeholder p-0">
                                <img src="img/lemari.jpeg" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                            <h5 class="mt-3">Lemari Pakaian</h5>
                            <span class="price-tag" onclick="window.location.href='produk.php'" style="cursor:pointer;">Lihat Detail</span>
                        </div>
                    </div>
                     <div class="slide-item">
                        <div class="product-card text-center h-100 shadow-sm">
                            <div class="image-placeholder p-0">
                                <img src="img/kasur.jpg" style="width:100%; height:100%; object-fit:cover;">
                            </div>
                            <h5 class="mt-3">Tempat Tidur</h5>
                            <span class="price-tag" onclick="window.location.href='produk.php'" style="cursor:pointer;">Lihat Detail</span>
                        </div>
                    </div>

                </div>
            </div>
        </section>
    </main>

    <?php include 'footer.php'; ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function animateOnScroll() {
            const elements = document.querySelectorAll('.animate-fade-in');
            elements.forEach(element => {
                const elementTop = element.getBoundingClientRect().top;
                if (elementTop < window.innerHeight - 150) {
                    element.style.opacity = '1';
                    element.style.transform = 'translateY(0)';
                }
            });
        }
        window.addEventListener('scroll', animateOnScroll);
        animateOnScroll();
    </script>