<?php 
include 'header.php'; 
include 'db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];
?>

<div class="container py-5">
    
    <div class="text-center mb-5">
        <h2 class="fw-bold text-brown">Riwayat Pesanan</h2>
        <p class="text-muted">Pantau status pengiriman barang Anda di sini.</p>
    </div>

    <?php if (isset($_GET['id'])): 
        $order_id = $_GET['id'];
        // Ambil data pesanan spesifik punya user ini
        $detail = $conn->query("SELECT * FROM pesanan WHERE id='$order_id' AND user_id='$user_id'")->fetch_assoc();
        
        if($detail):
            $status = $detail['status']; // Diproses, Dikemas, Dikirim, Selesai
            
            // Logika Progress Bar
            $step = 1; // Default Pesanan Diterima
            if($status == 'Dikemas') $step = 2;
            if($status == 'Dikirim') $step = 3;
            if($status == 'Selesai') $step = 4;
            
            $width = ($step - 1) * 33; // 0%, 33%, 66%, 99%
    ?>
        <div class="card shadow border-0 rounded-4 mb-5 animate-fade-in">
            <div class="card-body p-4">
                <div class="d-flex justify-content-between align-items-center mb-4">
                    <h5 class="fw-bold mb-0">Lacak Pesanan #<?= $order_id ?></h5>
                    <a href="status_pesanan.php" class="btn btn-sm btn-outline-secondary rounded-pill"><i class="fas fa-arrow-left"></i> Kembali</a>
                </div>

                <style>
                    .track-line { height: 6px; background-color: #eee; width: 100%; position: relative; margin: 30px 0; border-radius: 10px; }
                    .track-progress { height: 100%; background-color: #28a745; transition: width 1s; border-radius: 10px; }
                    .step-dot { width: 45px; height: 45px; background-color: #eee; border-radius: 50%; display: flex; align-items: center; justify-content: center; color: #aaa; position: absolute; top: -20px; z-index: 1; border: 3px solid #fff; box-shadow: 0 2px 5px rgba(0,0,0,0.1); }
                    .step-active { background-color: #28a745 !important; color: white !important; }
                </style>

                <div class="position-relative mx-4 my-5">
                    <div class="track-line">
                        <div class="track-progress" style="width: <?= $width ?>%;"></div>
                    </div>
                    
                    <div class="d-flex justify-content-between">
                        <div class="text-center position-relative">
                            <div class="step-dot <?= ($step >= 1) ? 'step-active' : '' ?>" style="left: 50%; transform: translateX(-50%);">
                                <i class="fas fa-clipboard-check"></i>
                            </div>
                            <div class="mt-4 fw-bold small">Diterima</div>
                        </div>
                        <div class="text-center position-relative">
                            <div class="step-dot <?= ($step >= 2) ? 'step-active' : '' ?>" style="left: 50%; transform: translateX(-50%);">
                                <i class="fas fa-box"></i>
                            </div>
                            <div class="mt-4 fw-bold small">Dikemas</div>
                        </div>
                        <div class="text-center position-relative">
                            <div class="step-dot <?= ($step >= 3) ? 'step-active' : '' ?>" style="left: 50%; transform: translateX(-50%);">
                                <i class="fas fa-truck"></i>
                            </div>
                            <div class="mt-4 fw-bold small">Dikirim</div>
                        </div>
                        <div class="text-center position-relative">
                            <div class="step-dot <?= ($step >= 4) ? 'step-active' : '' ?>" style="left: 50%; transform: translateX(-50%);">
                                <i class="fas fa-check-circle"></i>
                            </div>
                            <div class="mt-4 fw-bold small">Selesai</div>
                        </div>
                    </div>
                </div>

                <div class="alert alert-light border text-center">
                    Status Terkini: <strong class="text-success"><?= strtoupper($status) ?></strong>
                    <br>
                    <small class="text-muted">Total Pesanan: Rp <?= number_format($detail['total_harga'], 0, ',', '.') ?></small>
                </div>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-danger text-center">Pesanan tidak ditemukan.</div>
    <?php endif; endif; ?>


    <div class="card shadow border-0 rounded-4">
        <div class="card-body p-4">
            <h5 class="fw-bold mb-3"><i class="fas fa-list me-2"></i>Daftar Transaksi Anda</h5>
            <div class="table-responsive">
                <table class="table table-hover align-middle">
                    <thead class="table-light">
                        <tr>
                            <th>ID Order</th>
                            <th>Tanggal</th>
                            <th>Total Harga</th>
                            <th>Status</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        $list_query = "SELECT * FROM pesanan WHERE user_id='$user_id' ORDER BY id DESC";
                        $list_result = $conn->query($list_query);

                        if ($list_result->num_rows > 0):
                            while($row = $list_result->fetch_assoc()):
                        ?>
                        <tr>
                            <td>#<?= $row['id'] ?></td>
                            <td><?= date('d M Y H:i', strtotime($row['tanggal'])) ?></td>
                            <td class="fw-bold">Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                            <td>
                                <?php 
                                    $badge = 'bg-secondary';
                                    if($row['status'] == 'Dikemas') $badge = 'bg-warning text-dark';
                                    if($row['status'] == 'Dikirim') $badge = 'bg-info text-white';
                                    if($row['status'] == 'Selesai') $badge = 'bg-success';
                                ?>
                                <span class="badge rounded-pill <?= $badge ?>"><?= $row['status'] ?></span>
                            </td>
                            <td>
                                <a href="status_pesanan.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary rounded-pill px-3">
                                    <i class="fas fa-search-location me-1"></i> Lacak
                                </a>
                            </td>
                        </tr>
                        <?php endwhile; else: ?>
                        <tr>
                            <td colspan="5" class="text-center py-4 text-muted">Belum ada riwayat pesanan.</td>
                        </tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<?php include 'footer.php'; ?>