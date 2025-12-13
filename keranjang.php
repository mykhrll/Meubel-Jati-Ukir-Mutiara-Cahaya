<?php 
include 'header.php'; 
include 'db.php';

// Cek Login
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Silakan login dulu!'); window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
?>

<section class="hero-section" style="height: 30vh; background-image: url('img/banner.png');">
    <div class="container hero-content">
        <h1 class="display-5 fw-bold">Keranjang Belanja</h1>
        <p class="lead">Selesaikan pesanan Anda</p>
    </div>
</section>

<main class="container my-5">
    <div class="row justify-content-center">
        <div class="col-lg-10">
            <div class="card border-0 shadow-lg rounded-4 overflow-hidden">
                <div class="card-body p-4">
                    
                    <?php 
                    // AMBIL DATA DARI DATABASE (JOIN)
                    $query = "SELECT k.id as keranjang_id, k.qty, p.nama, p.harga, p.gambar 
                              FROM keranjang k 
                              JOIN produk p ON k.produk_id = p.id 
                              WHERE k.user_id = '$user_id'";
                    $result = $conn->query($query);
                    
                    if ($result->num_rows == 0): 
                    ?>
                        <div class="text-center py-5">
                            <i class="fas fa-shopping-basket fa-4x text-muted mb-3"></i>
                            <h3 class="text-brown">Keranjang Masih Kosong</h3>
                            <p class="text-muted">Data keranjang tersimpan aman di akun Anda.</p>
                            <a href="produk.php" class="btn btn-warning text-white px-4 py-2 mt-2 rounded-pill">
                                <i class="fas fa-arrow-left me-2"></i>Belanja Sekarang
                            </a>
                        </div>
                    <?php else: ?>

                    <div class="table-responsive">
                        <table class="table table-hover align-middle">
                            <thead class="table-warning text-brown">
                                <tr>
                                    <th width="40%">Produk</th>
                                    <th>Harga</th>
                                    <th>Qty</th>
                                    <th>Total</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php 
                                $grand = 0;
                                while ($item = $result->fetch_assoc()): 
                                    $total = $item['harga'] * $item['qty'];
                                    $grand += $total;
                                ?>
                                <tr>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <img src="<?= $item['gambar'] ?>" class="rounded-3 shadow-sm" width="70" height="70" style="object-fit:cover;">
                                            <div class="ms-3">
                                                <h6 class="mb-0 fw-bold text-brown"><?= $item['nama'] ?></h6>
                                            </div>
                                        </div>
                                    </td>
                                    <td>Rp <?= number_format($item['harga'], 0, ',', '.') ?></td>
                                    <td>
                                        <span class="badge bg-light text-dark border border-secondary px-3 py-2">
                                            <?= $item['qty'] ?>
                                        </span>
                                    </td>
                                    <td class="fw-bold text-success">Rp <?= number_format($total, 0, ',', '.') ?></td>
                                    <td>
                                        <a href="hapus_keranjang.php?id=<?= $item['keranjang_id'] ?>" class="btn btn-outline-danger btn-sm rounded-circle" title="Hapus" onclick="return confirm('Hapus produk ini?');">
                                            <i class="fas fa-trash"></i>
                                        </a>
                                    </td>
                                </tr>
                                <?php endwhile; ?>
                            </tbody>
                            <tfoot class="bg-light">
                                <tr>
                                    <td colspan="3" class="text-end fw-bold py-3 fs-5">Total Belanja:</td>
                                    <td colspan="2" class="fw-bold text-brown py-3 fs-5">
                                        Rp <?= number_format($grand, 0, ',', '.') ?>
                                    </td>
                                </tr>
                            </tfoot>
                        </table>
                    </div>

                    <div class="d-flex justify-content-between align-items-center mt-4">
                        <a href="produk.php" class="btn btn-outline-secondary rounded-pill px-4">
                            <i class="fas fa-arrow-left me-2"></i>Lanjut Belanja
                        </a>
                        <a href="checkout.php" class="btn btn-success rounded-pill px-5 py-2 fw-bold shadow">
                            <i class="fas fa-check-circle me-2"></i>Checkout Sekarang
                        </a>
                    </div>

                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</main>

<?php include 'footer.php'; ?>