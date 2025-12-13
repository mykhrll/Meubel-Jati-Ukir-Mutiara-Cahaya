<?php
include 'header.php';
include 'db.php';

// Cek Admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses Ditolak!'); window.location.href='index.php';</script>";
    exit;
}

// Ambil ID Produk
$id = $_GET['id'];
$query = "SELECT * FROM produk WHERE id = '$id'";
$result = $conn->query($query);
$data = $result->fetch_assoc();

// LOGIKA UPDATE
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    $gambar_lama = $_POST['gambar_lama'];
    
    if ($_FILES['gambar']['name'] != "") {
        $gambar = $_FILES['gambar']['name'];
        $tmp = $_FILES['gambar']['tmp_name'];
        $path = "img/" . $gambar;
        move_uploaded_file($tmp, $path);
    } else {
        $path = $gambar_lama;
    }

    $sql = "UPDATE produk SET nama='$nama', kategori='$kategori', harga='$harga', deskripsi='$deskripsi', gambar='$path' WHERE id='$id'";

    if ($conn->query($sql)) {
        echo "<script>alert('Produk Berhasil Diupdate!'); window.location.href='produk.php';</script>";
    } else {
        echo "<script>alert('Gagal update!');</script>";
    }
}

// LOGIKA HAPUS (BARU)
if (isset($_POST['hapus'])) {
    // Hapus gambar fisik dari folder jika ada
    if (file_exists($data['gambar'])) {
        unlink($data['gambar']);
    }

    $sql_hapus = "DELETE FROM produk WHERE id='$id'";
    if ($conn->query($sql_hapus)) {
        echo "<script>alert('Produk Berhasil Dihapus!'); window.location.href='produk.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus!');</script>";
    }
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4 border-0">
                <div class="card-body p-4">
                    <h3 class="fw-bold text-brown mb-4">Edit / Hapus Produk</h3>
                    
                    <form method="POST" enctype="multipart/form-data">
                        <input type="hidden" name="gambar_lama" value="<?= $data['gambar'] ?>">
                        
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama" class="form-control" value="<?= $data['nama'] ?>" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="kategori" class="form-select">
                                    <option value="kursi" <?= ($data['kategori'] == 'kursi') ? 'selected' : '' ?>>Kursi</option>
                                    <option value="meja" <?= ($data['kategori'] == 'meja') ? 'selected' : '' ?>>Meja</option>
                                    <option value="lemari" <?= ($data['kategori'] == 'lemari') ? 'selected' : '' ?>>Lemari</option>
                                    <option value="tempat-tidur" <?= ($data['kategori'] == 'tempat-tidur') ? 'selected' : '' ?>>Tempat Tidur</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" name="harga" class="form-control" value="<?= $data['harga'] ?>" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required><?= $data['deskripsi'] ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar Saat Ini</label><br>
                            <img src="<?= $data['gambar'] ?>" width="100" class="mb-2 rounded shadow-sm">
                            <input type="file" name="gambar" class="form-control mt-2">
                            <small class="text-muted">Biarkan kosong jika tidak ingin mengganti gambar.</small>
                        </div>
                        
                        <div class="d-flex gap-2">
                            <button type="submit" name="update" class="btn btn-primary flex-grow-1 rounded-pill fw-bold">
                                <i class="fas fa-save me-1"></i> Simpan Perubahan
                            </button>
                            
                            <button type="submit" name="hapus" class="btn btn-danger flex-grow-1 rounded-pill fw-bold" onclick="return confirm('Yakin ingin menghapus produk ini selamanya?');">
                                <i class="fas fa-trash me-1"></i> Hapus Produk
                            </button>
                        </div>
                        
                        <div class="mt-3 text-center">
                            <a href="produk.php" class="text-muted text-decoration-none">Batal & Kembali</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>