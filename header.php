<?php
include 'config.php';
include 'db.php'; // Koneksi database wajib dipanggil di sini agar tidak error

$current_page = basename($_SERVER['PHP_SELF']);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Meubel Jati Ukir Mutiara Cahaya</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <style>
        :root {
            --brown: #8B5E3C;
            --cream: #F5E9DA;
            --gold: #FFD700;
        }
        
        body {
            background-color: var(--cream);
            color: var(--brown);
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            display: flex;
            flex-direction: column;
            min-height: 100vh;
        }
        
        main {
            flex: 1;
        }
        
        /* Navbar Styles */
        .navbar {
            background-color: var(--brown) !important;
            box-shadow: 0 2px 10px rgba(0,0,0,0.1);
        }
        
        .navbar-brand img {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            border: 2px solid white;
        }
        
        .nav-link {
            color: rgba(255,255,255,0.8) !important;
            font-weight: 500;
            margin: 0 5px;
            border-radius: 20px;
            transition: all 0.3s ease;
            padding: 8px 15px !important;
        }
        
        .nav-link.active, .nav-link:hover {
            background-color: var(--gold) !important;
            color: var(--brown) !important;
            transform: translateY(-2px);
            font-weight: bold;
        }

        .nav-icon-btn {
            color: white;
            text-decoration: none;
            margin-right: 15px;
            position: relative;
            transition: all 0.3s;
        }
        .nav-icon-btn:hover { color: var(--gold); transform: scale(1.1); }
        
        /* HERO SECTION BASE */
        .hero-section {
            background-size: cover;
            background-position: center;
            background-attachment: fixed;
            display: flex;
            align-items: center;
            justify-content: center;
            text-align: center;
            color: white;
            position: relative;
            overflow: hidden;
        }

        .hero-section::before {
            content: '';
            position: absolute;
            top: 0; left: 0; right: 0; bottom: 0;
            background: linear-gradient(rgba(139, 94, 60, 0.7), rgba(139, 94, 60, 0.4));
            z-index: 1;
        }

        .hero-content {
            position: relative;
            z-index: 2;
        }

        /* ANIMASI BANNER */
        @keyframes zoomSlow {
            0% { transform: scale(1); }
            100% { transform: scale(1.1); }
        }
        
        .hero-animate-bg {
            animation: zoomSlow 20s infinite alternate;
        }

        /* Components Styles */
        .feature-card, .product-card, .contact-card, .about-card {
            background: white;
            border-radius: 15px;
            padding: 2rem;
            margin: 1rem 0;
            box-shadow: 0 5px 15px rgba(0,0,0,0.1);
            transition: all 0.3s ease;
            height: 100%;
            border: none;
        }
        
        .feature-card:hover, .product-card:hover {
            transform: translateY(-10px);
            box-shadow: 0 15px 30px rgba(0,0,0,0.2);
        }

        .price-tag {
            background-color: var(--gold);
            color: var(--brown);
            padding: 0.5rem 1rem;
            border-radius: 20px;
            font-weight: bold;
            display: inline-block;
            margin-top: 1rem;
        }

        .login-btn {
            background: white;
            color: var(--brown);
            border-radius: 25px;
            padding: 0.5rem 1.5rem;
            text-decoration: none;
            font-weight: 600;
            transition: all 0.3s ease;
            border: 2px solid transparent;
        }
        .login-btn:hover { background: var(--gold); border-color: var(--gold); }
        
        footer {
            background-color: var(--brown);
            color: white;
            padding: 1.5rem 0;
            margin-top: auto;
        }
        
        .image-placeholder {
            width: 100%;
            height: 200px;
            background: #eee;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            border-radius: 10px;
            margin-bottom: 15px;
        }

        .animate-fade-in { animation: fadeInUp 0.8s ease-out; }
        @keyframes fadeInUp { from { opacity: 0; transform: translateY(30px); } to { opacity: 1; transform: translateY(0); } }
        
        .section-title {
            color: var(--brown);
            font-weight: 700;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>

<nav class="navbar navbar-expand-lg navbar-dark sticky-top">
    <div class="container">
        <a class="navbar-brand" href="index.php">
            <img src="img/logo.png" alt="Logo">
        </a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav me-auto">
                <li class="nav-item"><a class="nav-link <?= ($current_page == 'index.php') ? 'active' : '' ?>" href="index.php">Beranda</a></li>
                <li class="nav-item"><a class="nav-link <?= ($current_page == 'produk.php') ? 'active' : '' ?>" href="produk.php">Produk</a></li>
                <li class="nav-item"><a class="nav-link <?= ($current_page == 'tentang.php') ? 'active' : '' ?>" href="tentang.php">Tentang Kami</a></li>
                <li class="nav-item"><a class="nav-link <?= ($current_page == 'kontak.php') ? 'active' : '' ?>" href="kontak.php">Kontak</a></li>
            </ul>
            
            <div class="d-flex align-items-center">
                
                <?php 
                // LOGIKA KHUSUS ADMIN VS USER
                // Cek apakah user sudah login DAN role-nya adalah admin
                if (isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): 
                ?>
                    <a href="admin_kelola_pesanan.php" class="btn btn-primary rounded-pill me-2 fw-bold text-white shadow-sm" style="font-size: 0.9rem;">
                        <i class="fas fa-tasks me-1"></i> Kelola Pesanan
                    </a>

                    <a href="tambah_produk.php" class="btn btn-warning rounded-pill me-3 fw-bold text-white shadow-sm" style="font-size: 0.9rem;">
                        <i class="fas fa-plus-circle me-1"></i> Tambah Produk
                    </a>

                <?php else: ?>
                    <a href="keranjang.php" class="nav-icon-btn" title="Keranjang">
                        <i class="fas fa-shopping-cart fa-lg"></i>
                        <?php 
                        // HITUNG JUMLAH KERANJANG DARI DATABASE
                        if(isset($_SESSION['user_id'])) {
                            $uid = $_SESSION['user_id'];
                            // Gunakan $conn yang sekarang sudah pasti ada
                            $sql_count = "SELECT SUM(qty) as total FROM keranjang WHERE user_id='$uid'";
                            $res_count = $conn->query($sql_count);
                            
                            if ($res_count) {
                                $row_count = $res_count->fetch_assoc();
                                $total_item = $row_count['total'] ?? 0;
                                
                                if($total_item > 0) {
                                    echo '<span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger" style="font-size:0.6rem;">'.$total_item.'</span>';
                                }
                            }
                        }
                        ?>
                    </a>
                <?php endif; ?>
                
                <?php if(isset($_SESSION['user_id'])): ?>
                    <a href="profil.php" class="btn btn-outline-light rounded-pill ms-2">
                        <i class="fas fa-user-circle me-1"></i> 
                        <?= (isset($_SESSION['role']) && $_SESSION['role'] === 'admin') ? 'Admin' : 'Profil' ?>
                    </a>
                <?php else: ?>
                    <a href="login.php" class="login-btn">Login</a>
                <?php endif; ?>

            </div>
        </div>
    </div>
</nav>