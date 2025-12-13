<?php
include 'header.php';
include 'db.php';

// CEK APAKAH ADMIN
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses Ditolak!'); window.location.href='index.php';</script>";
    exit;
}

// LOGIKA UPDATE STATUS
if (isset($_POST['update_status'])) {
    $id_pesanan = $_POST['id_pesanan'];
    $status_baru = $_POST['status_baru'];

    $sql = "UPDATE pesanan SET status = '$status_baru' WHERE id = '$id_pesanan'";
    
    if ($conn->query($sql)) {
        echo "<script>alert('Status pesanan #$id_pesanan berhasil diubah menjadi $status_baru'); window.location.href='admin_kelola_pesanan.php';</script>";
    } else {
        echo "<script>alert('Gagal update status');</script>";
    }
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-12">
            <div class="card shadow rounded-4 border-0">
                <div class="card-header bg-brown text-white py-3">
                    <h4 class="mb-0 fw-bold"><i class="fas fa-tasks me-2"></i>Kelola Pesanan Masuk</h4>
                </div>
                <div class="card-body p-4">
                    
                    <div class="table-responsive">
                        <table class="table table-hover align-middle table-bordered">
                            <thead class="table-light text-center">
                                <tr>
                                    <th>ID Order</th>
                                    <th>Tanggal</th>
                                    <th>Nama Pemesan</th>
                                    <th>Total Harga</th>
                                    <th>Status Saat Ini</th>
                                    <th width="25%">Aksi (Ubah Status)</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                // AMBIL SEMUA PESANAN + NAMA USER (JOIN)
                                $query = "SELECT p.*, u.nama_lengkap 
                                          FROM pesanan p 
                                          JOIN users u ON p.user_id = u.id 
                                          ORDER BY p.tanggal DESC";
                                $result = $conn->query($query);

                                if ($result->num_rows > 0):
                                    while($row = $result->fetch_assoc()):
                                ?>
                                <tr>
                                    <td class="text-center fw-bold">#<?= $row['id'] ?></td>
                                    <td class="text-center"><?= date('d M Y H:i', strtotime($row['tanggal'])) ?></td>
                                    <td><?= $row['nama_lengkap'] ?></td>
                                    <td>Rp <?= number_format($row['total_harga'], 0, ',', '.') ?></td>
                                    
                                    <td class="text-center">
                                        <?php 
                                            $badge = 'bg-secondary';
                                            if($row['status'] == 'Diproses') $badge = 'bg-info text-dark';
                                            if($row['status'] == 'Dikemas') $badge = 'bg-warning text-dark';
                                            if($row['status'] == 'Dikirim') $badge = 'bg-primary';
                                            if($row['status'] == 'Selesai') $badge = 'bg-success';
                                            if($row['status'] == 'Dibatalkan') $badge = 'bg-danger';
                                        ?>
                                        <span class="badge rounded-pill <?= $badge ?> px-3"><?= $row['status'] ?></span>
                                    </td>

                                    <td>
                                        <form method="POST" class="d-flex gap-2">
                                            <input type="hidden" name="id_pesanan" value="<?= $row['id'] ?>">
                                            
                                            <select name="status_baru" class="form-select form-select-sm" required>
                                                <option value="" disabled selected>Pilih Status</option>
                                                <option value="Diproses">Diproses</option>
                                                <option value="Dikemas">Dikemas</option>
                                                <option value="Dikirim">Dikirim</option>
                                                <option value="Selesai">Selesai</option>
                                                <option value="Dibatalkan">Batalkan Pesanan</option>
                                            </select>
                                            
                                            <button type="submit" name="update_status" class="btn btn-sm btn-success">
                                                <i class="fas fa-save"></i>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                <?php endwhile; else: ?>
                                <tr>
                                    <td colspan="6" class="text-center py-4 text-muted">Belum ada pesanan masuk.</td>
                                </tr>
                                <?php endif; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .bg-brown { background-color: var(--brown); }
</style>

<?php include 'footer.php'; ?>