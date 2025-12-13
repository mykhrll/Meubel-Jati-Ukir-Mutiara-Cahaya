<?php
include 'header.php';
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Silakan login!'); window.location.href='login.php';</script>";
    exit;
}
$user_id = $_SESSION['user_id'];

// 1. AMBIL ITEM DARI DATABASE
$query = "SELECT k.*, p.harga, p.nama FROM keranjang k JOIN produk p ON k.produk_id = p.id WHERE k.user_id = '$user_id'";
$result = $conn->query($query);
$items = [];
while ($row = $result->fetch_assoc()) {
    $items[] = $row;
}

if (empty($items)) {
    echo "<script>alert('Keranjang kosong!'); window.location.href='produk.php';</script>";
    exit;
}

// 2. CEK ALAMAT
$cek_user = $conn->query("SELECT alamat, no_telp FROM users WHERE id = '$user_id'")->fetch_assoc();
if (empty($cek_user['alamat']) || empty($cek_user['no_telp'])) {
    echo "<script>alert('Lengkapi alamat dulu!'); window.location.href='editprofil.php';</script>";
    exit;
}

// PROSES BAYAR
if (isset($_POST['bayar'])) {
    $total = 0;
    foreach ($items as $item) {
        $total += $item['harga'] * $item['qty'];
    }
    $metode = $_POST['metode_pembayaran'];

    // Insert Pesanan
    $sql = "INSERT INTO pesanan (user_id, total_harga, status, tanggal) VALUES ('$user_id', '$total', 'Diproses', NOW())";
    
    if ($conn->query($sql)) {
        // HAPUS KERANJANG DARI DATABASE SETELAH SUKSES
        $conn->query("DELETE FROM keranjang WHERE user_id = '$user_id'");
        
        echo "<script>
            alert('Pesanan Berhasil! Keranjang telah dikosongkan.'); 
            window.location.href='status_pesanan.php';
        </script>";
    } else {
        echo "<script>alert('Gagal Checkout: " . $conn->error . "');</script>";
    }
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-7">
            <div class="card shadow-sm mb-4 border-0 rounded-4">
                <div class="card-body bg-light">
                    <h5 class="fw-bold text-brown mb-2"><i class="fas fa-map-marker-alt me-2"></i>Alamat Pengiriman</h5>
                    <p class="mb-1 fw-bold"><?= $_SESSION['nama'] ?></p>
                    <p class="mb-1"><?= $cek_user['no_telp'] ?></p>
                    <p class="text-muted small mb-0"><?= $cek_user['alamat'] ?></p>
                    <a href="editprofil.php" class="btn btn-sm btn-link text-decoration-none p-0 mt-2">Ubah Alamat</a>
                </div>
            </div>

            <div class="card shadow rounded-4 border-0">
                <div class="card-header bg-warning text-white fw-bold py-3 rounded-top-4">Konfirmasi Checkout</div>
                <div class="card-body p-4">
                    <h6 class="fw-bold mb-3">Ringkasan Item</h6>
                    <ul class="list-group mb-4">
                        <?php 
                        $total_bayar = 0;
                        foreach ($items as $item): 
                            $subtotal = $item['harga'] * $item['qty'];
                            $total_bayar += $subtotal;
                        ?>
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            <div>
                                <span class="fw-bold"><?= $item['nama'] ?></span>
                                <div class="text-muted small"><?= $item['qty'] ?> x Rp <?= number_format($item['harga'],0,',','.') ?></div>
                            </div>
                            <span class="fw-bold text-brown">Rp <?= number_format($subtotal, 0, ',', '.') ?></span>
                        </li>
                        <?php endforeach; ?>
                        <li class="list-group-item d-flex justify-content-between fw-bold bg-light fs-5">
                            <span>Total Bayar</span>
                            <span>Rp <?= number_format($total_bayar, 0, ',', '.') ?></span>
                        </li>
                    </ul>

                    <form method="POST">
                        <div class="mb-3">
                            <label class="fw-bold mb-2">Metode Pembayaran</label>
                            <select class="form-select py-2" name="metode_pembayaran" id="metodePembayaran" onchange="cekQris()">
                                <option value="Transfer Bank">Transfer Bank</option>
                                <option value="COD">COD</option>
                                <option value="QRIS">QRIS</option>
                            </select>
                        </div>
                        <div id="areaQris" class="text-center mb-4 p-4 border rounded bg-white shadow-sm" style="display: none;">
                            <h6 class="fw-bold mb-3">Scan QRIS</h6>
                            <img src="img/qris.jpg" alt="QRIS" class="img-fluid mb-2" style="max-width: 200px;">
                        </div>
                        <button type="submit" name="bayar" class="btn btn-success w-100 py-3 rounded-pill fw-bold shadow">Bayar Sekarang</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function cekQris() {
        var metode = document.getElementById("metodePembayaran").value;
        var areaQris = document.getElementById("areaQris");
        areaQris.style.display = (metode === "QRIS") ? "block" : "none";
    }
</script>
<?php include 'footer.php'; ?>