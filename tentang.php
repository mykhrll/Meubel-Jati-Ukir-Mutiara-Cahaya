<?php include 'header.php'; ?>

<style>
    /* CSS Timeline & Animasi */
    .timeline { position: relative; max-width: 1200px; margin: 0 auto; padding: 40px 0; }
    .timeline::after { content: ''; position: absolute; width: 6px; background-color: var(--brown); top: 0; bottom: 0; left: 50%; margin-left: -3px; border-radius: 3px; }
    
    /* State Awal Animasi: Hidden */
    .timeline-container { 
        padding: 10px 40px; 
        position: relative; 
        width: 50%; 
        opacity: 0; 
        transform: translateY(50px);
        transition: all 1s ease-out;
    }
    
    /* State Akhir: Muncul */
    .timeline-container.visible {
        opacity: 1;
        transform: translateY(0);
    }

    .timeline-container.left { left: 0; }
    .timeline-container.right { left: 50%; }
    .content-box { padding: 20px 30px; background-color: white; position: relative; border-radius: 15px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); border-left: 5px solid var(--gold); }
    
    .timeline-container::after { content: ''; position: absolute; width: 25px; height: 25px; right: -17px; background-color: white; border: 4px solid var(--gold); top: 20px; border-radius: 50%; z-index: 1; }
    .timeline-container.right::after { left: -16px; }

    @media screen and (max-width: 600px) {
      .timeline::after { left: 31px; }
      .timeline-container { width: 100%; padding-left: 70px; padding-right: 25px; }
      .timeline-container.right { left: 0%; }
      .timeline-container.left::after, .timeline-container.right::after { left: 15px; }
    }
</style>

<section class="hero-section" style="height: 50vh; background-image: url('img/banner.png');">
    <div class="hero-content container">
        <h1 class="display-4 fw-bold mb-3 animate-fade-in">Tentang Kami</h1>
        <p class="lead animate-fade-in">Mengenal Dedikasi Meubel Jati Ukir Mutiara Cahaya</p>
    </div>
</section>

<main class="container py-5">
    
    <div class="text-center mb-5 animate-fade-in">
        <h2 class="fw-bold text-brown">Perjalanan Kami</h2>
        <p class="text-muted">Sebuah kisah dedikasi dan seni ukir.</p>
    </div>

    <div class="timeline">
        
        <div class="timeline-container left">
            <div class="content-box">
                <h4 class="fw-bold text-brown">2010 - Awal Mula</h4>
                <p>Berdiri sebagai bengkel kayu sederhana di Lampung Utara. Dengan semangat melestarikan seni ukir, kami memulai dengan pesanan kecil dari tetangga sekitar.</p>
            </div>
        </div>

        <div class="timeline-container right">
            <div class="content-box">
                <h4 class="fw-bold text-brown">2015 - Pengembangan</h4>
                <p>Mulai merekrut pengrajin lokal berbakat. Kami memperluas workshop dan mulai menerima pesanan dari luar kota berkat kualitas kayu jati asli yang kami pertahankan.</p>
            </div>
        </div>

        <div class="timeline-container left">
            <div class="content-box p-0 overflow-hidden">
                 <div class="ratio ratio-16x9">
                   <iframe src="https://www.youtube.com/embed/Azv18m3QwTs?si=93JY13MsyPAywrWQ" title="Profil Meubel" allowfullscreen style="border-radius: 10px 10px 0 0;"></iframe>
                </div>
                <div class="p-3">
                    <h5 class="fw-bold mt-2">Profil Video Kami</h5>
                    <p class="small text-muted mb-0">Lihat bagaimana kami bekerja.</p>
                </div>
            </div>
        </div>

        <div class="timeline-container right">
            <div class="content-box">
                <h4 class="fw-bold text-brown">2025 - Era Digital</h4>
                <p>Meubel Jati Ukir Mutiara Cahaya kini hadir secara online. Memudahkan pelanggan di seluruh Indonesia untuk mengakses furnitur berkualitas premium dengan mudah.</p>
            </div>
        </div>

    </div>

    <section class="mt-5 pt-5 border-top">
        <div class="row g-4">
            <div class="col-md-6">
                <div class="p-4 bg-light rounded-4 text-center h-100 shadow-sm animate-fade-in">
                    <i class="fas fa-bullseye fa-3x text-warning mb-3"></i>
                    <h3 class="text-brown fw-bold">Visi</h3>
                    <p>Menjadi produsen meubel terkemuka yang mengharumkan seni ukir khas Indonesia ke kancah nasional.</p>
                </div>
            </div>
            <div class="col-md-6">
                <div class="p-4 bg-light rounded-4 text-center h-100 shadow-sm animate-fade-in">
                    <i class="fas fa-hands-helping fa-3x text-warning mb-3"></i>
                    <h3 class="text-brown fw-bold">Misi</h3>
                    <p>Menghasilkan produk berkualitas tinggi, memberdayakan pengrajin lokal, dan memprioritaskan kepuasan pelanggan.</p>
                </div>
            </div>
        </div>
    </section>

</main>

<?php include 'footer.php'; ?>

<script>
    // Menggunakan Intersection Observer API untuk performa lebih baik
    const observer = new IntersectionObserver((entries) => {
        entries.forEach((entry) => {
            if (entry.isIntersecting) {
                entry.target.classList.add('visible'); // Tambahkan class visible saat masuk layar
            }
        });
    }, {
        threshold: 0.2 // Animasi jalan saat 20% elemen terlihat
    });

    const hiddenElements = document.querySelectorAll('.timeline-container');
    hiddenElements.forEach((el) => observer.observe(el));
</script>