<?php
include 'header.php';
include 'db.php';

// Cek Admin
if (!isset($_SESSION['role']) || $_SESSION['role'] !== 'admin') {
    echo "<script>alert('Akses Ditolak!'); window.location.href='index.php';</script>";
    exit;
}

if (isset($_POST['submit'])) {
    $nama = $_POST['nama'];
    $kategori = $_POST['kategori'];
    $harga = $_POST['harga'];
    $deskripsi = $_POST['deskripsi'];
    
    // Upload Gambar
    $gambar = $_FILES['gambar']['name'];
    $tmp = $_FILES['gambar']['tmp_name'];
    $path = "img/" . $gambar;

    if (move_uploaded_file($tmp, $path)) {
        $sql = "INSERT INTO produk (nama, kategori, harga, deskripsi, gambar) 
                VALUES ('$nama', '$kategori', '$harga', '$deskripsi', '$path')";
        if ($conn->query($sql)) {
            echo "<script>alert('Produk Berhasil Ditambahkan!'); window.location.href='produk.php';</script>";
        } else {
            echo "<script>alert('Gagal database: " . $conn->error . "');</script>";
        }
    } else {
        echo "<script>alert('Gagal upload gambar!');</script>";
    }
}
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4 border-0">
                <div class="card-body p-4">
                    <h3 class="fw-bold text-brown mb-4"><i class="fas fa-plus-circle"></i> Tambah Produk Baru</h3>
                    
                    <form method="POST" enctype="multipart/form-data">
                        <div class="mb-3">
                            <label class="form-label">Nama Produk</label>
                            <input type="text" name="nama" class="form-control" required>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Kategori</label>
                                <select name="kategori" class="form-select">
                                    <option value="kursi">Kursi</option>
                                    <option value="meja">Meja</option>
                                    <option value="lemari">Lemari</option>
                                    <option value="tempat-tidur">Tempat Tidur</option>
                                </select>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label class="form-label">Harga (Rp)</label>
                                <input type="number" name="harga" class="form-control" required>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Deskripsi</label>
                            <textarea name="deskripsi" class="form-control" rows="3" required></textarea>
                        </div>
                        <div class="mb-3">
                            <label class="form-label">Gambar Produk</label>
                            <input type="file" name="gambar" class="form-control" required>
                        </div>
                        <button type="submit" name="submit" class="btn btn-warning w-100 fw-bold text-white rounded-pill">Simpan Produk</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>