<?php include 'header.php'; ?>

<section class="hero-section" style="height: 40vh; background-image: url('img/banner.png');">
    <div class="hero-content container">
        <h1 class="display-4 fw-bold mb-3">Hubungi Kami</h1>
        <p class="lead">Kami siap melayani kebutuhan furnitur Anda</p>
    </div>
</section> 

<main class="container py-5">
    
    <div class="row justify-content-center mb-5">
        <div class="col-lg-8">
            <div class="contact-card text-center shadow animate-fade-in" style="background: #fff;">
                <h3 class="section-title mb-4">Informasi Kontak</h3>
                
                <div class="row g-4 text-start">
                    <div class="col-md-6 d-flex align-items-center gap-3">
                        <div class="bg-light p-3 rounded-circle text-brown"><i class="fas fa-map-marker-alt fa-2x"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">Alamat</h6>
                            <p class="small text-muted mb-0">Widoro Payung, Gg. Kenanga 8, RT002/RW002, Abung Jayo, Abung Selatan, Lampung Utara, Lampung, Indonesia 34581</p>
                        </div>
                    </div>
                    <div class="col-md-6 d-flex align-items-center gap-3">
                        <div class="bg-light p-3 rounded-circle text-brown"><i class="fas fa-phone-alt fa-2x"></i></div>
                        <div>
                            <h6 class="fw-bold mb-1">WhatsApp</h6>
                            <a href="https://wa.me/6289517821430" target="_blank" class="text-decoration-none text-success fw-bold">
                                +62 895-1782-1430 <i class="fas fa-external-link-alt small"></i>
                            </a>
                        </div>
                    </div>
                </div>

                <div class="mt-4 pt-4 border-top">
                    <h6 class="fw-bold mb-3">Media Sosial Kami</h6>
                    <div class="d-flex justify-content-center gap-3">
                        <a href="https://www.instagram.com/meubeljatiukirmutiaracahaya/" target="_blank" class="btn btn-danger btn-sm rounded-pill px-4"><i class="fab fa-instagram me-1"></i> Instagram</a>
                        <a href="https://web.facebook.com/meubeljatiukirmutiaracahaya" target="_blank" class="btn btn-primary btn-sm rounded-pill px-4"><i class="fab fa-facebook-f me-1"></i> Facebook</a>
                        <a href="https://www.threads.com/@meubeljatiukirmutiaracahaya" target="_blank" class="btn btn-dark btn-sm rounded-pill px-4"><i class="fas fa-at me-1"></i> Threads</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center mb-5">
        <div class="col-lg-10">
            <div class="card shadow p-2 rounded-4 animate-fade-in">
                <div style="height: 450px; width: 100%; border-radius: 12px; overflow: hidden;">
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3975.602678394883!2d104.9278005743645!3d-4.838083295137485!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x2e38a99d00135df1%3A0x6d4ff533b1426c53!2sMeubel%20Jati%20Ukir%20Mutiara%20Cahaya!5e0!3m2!1sid!2sid!4v1765600170886!5m2!1sid!2sid" width="100%" height="100%" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                </div>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="contact-card shadow animate-fade-in">
                <h3 class="section-title text-center">Kirim Pesan</h3>
                <p class="text-center text-muted mb-4">Punya pertanyaan khusus? Kirimkan pesan kepada kami.</p>
                <form>
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Nama Lengkap</label>
                            <input type="text" class="form-control bg-light" placeholder="Nama Anda" required>
                        </div>
                        <div class="col-md-6 mb-3">
                            <label class="form-label fw-bold">Email</label>
                            <input type="email" class="form-control bg-light" placeholder="email@contoh.com" required>
                        </div>
                    </div>
                    <div class="mb-3">
                        <label class="form-label fw-bold">Pesan</label>
                        <textarea class="form-control bg-light" rows="5" placeholder="Tulis pesan Anda di sini..." required></textarea>
                    </div>
                    <button type="submit" class="btn btn-warning w-100 rounded-pill fw-bold py-2 text-white shadow">
                        <i class="fas fa-paper-plane me-2"></i> Kirim Pesan
                    </button>
                </form>
            </div>
        </div>
    </div>

</main>

<?php include 'footer.php'; ?>