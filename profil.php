<?php
include 'header.php';
include 'db.php';

// Cek Login
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
$query = "SELECT * FROM users WHERE id = '$user_id'";
$result = $conn->query($query);
$data = $result->fetch_assoc();
?>

<section class="hero-section" style="height: 40vh; background-image: url('img/banner.png');">
    <div class="hero-content container">
        <h1 class="display-4 fw-bold">Profil Saya</h1>
    </div>
</section>

<main class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4 border-0 animate-fade-in">
                <div class="card-body p-5">
                    
                    <div class="text-center mb-4">
                        <?php 
                            // Cek apakah ada foto di database dan filenya benar-benar ada di folder img
                            $foto_profil = !empty($data['foto']) && file_exists($data['foto']) ? $data['foto'] : 'img/default.png';
                        ?>
                        
                        <img src="<?= $foto_profil ?>" class="rounded-circle shadow" style="width: 150px; height: 150px; object-fit: cover; border: 4px solid var(--gold);">
                        
                        <h3 class="mt-3 text-brown fw-bold"><?= $data['nama_lengkap'] ?></h3>
                        <span class="badge bg-warning text-dark px-3 py-2 rounded-pill"><?= ucfirst($data['role']) ?></span>
                    </div>
                    <hr>
                    
                    <div class="row g-4 mt-2">
                        <div class="col-sm-6">
                            <label class="text-muted small">Email</label>
                            <p class="fw-bold"><?= $data['email'] ?></p>
                        </div>
                        <div class="col-sm-6">
                            <label class="text-muted small">Bergabung Sejak</label>
                            <p class="fw-bold"><?= date('d F Y', strtotime($data['created_at'])) ?></p>
                        </div>
                        <div class="col-sm-6">
                            <label class="text-muted small">No. Telepon</label>
                            <p class="fw-bold"><?= $data['no_telp'] ?? '-' ?></p>
                        </div>
                        <div class="col-sm-12">
                            <label class="text-muted small">Alamat Pengiriman</label>
                            <p class="fw-bold"><?= $data['alamat'] ?? 'Belum diatur' ?></p>
                        </div>
                    </div>

                    <?php if ($data['role'] !== 'admin'): ?>
                    <div class="mt-4 d-grid gap-2">
                         <a href="status_pesanan.php" class="btn btn-info text-white btn-lg fw-bold rounded-pill">
                            <i class="fas fa-truck me-2"></i>Lacak Status Pesanan
                         </a>
                    </div>
                    <?php endif; ?>

                    <div class="mt-3 d-grid gap-2">
                        <a href="editprofil.php" class="btn btn-warning btn-lg rounded-pill fw-bold text-white">
                            <i class="fas fa-edit me-2"></i>Edit Profil
                        </a>
                    </div>
                    
                    <div class="mt-3 d-grid gap-2">
                        <a href="logout.php" class="btn btn-outline-danger btn-lg rounded-pill fw-bold">
                            <i class="fas fa-sign-out-alt me-2"></i>Keluar / Logout
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>