<?php
include 'header.php';
include 'db.php';

// CEK LOGIN
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Silakan login terlebih dahulu!'); window.location.href='login.php';</script>";
    exit;
}

$user_id = $_SESSION['user_id'];

// AMBIL DATA USER TERBARU
$query = "SELECT * FROM users WHERE id='$user_id'";
$result = $conn->query($query);
$data = $result->fetch_assoc();

// --- LOGIKA HAPUS FOTO (BARU) ---
if (isset($_POST['hapus_foto'])) {
    $foto_lama = $data['foto'];

    // Cek jika foto lama bukan default dan filenya ada, maka hapus fisiknya
    if ($foto_lama != 'default.png' && $foto_lama != '' && file_exists($foto_lama)) {
        unlink($foto_lama); // Hapus file dari folder img
    }

    // Update database jadi default.png
    $update_foto = "UPDATE users SET foto='default.png' WHERE id='$user_id'";
    if ($conn->query($update_foto)) {
        echo "<script>alert('Foto profil berhasil dihapus!'); window.location.href='editprofil.php';</script>";
    } else {
        echo "<script>alert('Gagal menghapus foto di database.');</script>";
    }
}
// --------------------------------

// --- LOGIKA UPDATE PROFIL UTAMA ---
if (isset($_POST['update'])) {
    $nama = $_POST['nama'];
    $email = $_POST['email'];
    $no_telp = $_POST['no_telp'];
    $alamat = $_POST['alamat'];
    $password_baru = $_POST['password'];
    
    // Logika Password
    if (!empty($password_baru)) {
        $password_fix = $password_baru; // Jika diisi, pakai password baru (idealnya di-hash)
    } else {
        $password_fix = $data['password']; // Jika kosong, pakai password lama
    }

    // Logika Upload Foto Baru
    $foto_nama = $data['foto']; // Default pakai path foto lama
    
    if ($_FILES['foto']['name'] != "") {
        $foto = $_FILES['foto']['name'];
        $tmp = $_FILES['foto']['tmp_name'];
        $foto_baru_path = "img/profil_" . time() . "_" . $foto; // Rename biar unik
        
        if (move_uploaded_file($tmp, $foto_baru_path)) {
            // Jika berhasil upload baru, hapus foto lama (kalau bukan default)
            if ($data['foto'] != 'default.png' && file_exists($data['foto'])) {
                unlink($data['foto']);
            }
            $foto_nama = $foto_baru_path; // Update path untuk database
        }
    }

    $update = "UPDATE users SET 
               nama_lengkap='$nama', 
               email='$email', 
               password='$password_fix', 
               no_telp='$no_telp', 
               alamat='$alamat', 
               foto='$foto_nama' 
               WHERE id='$user_id'";

    if ($conn->query($update)) {
        $_SESSION['nama'] = $nama; // Update nama di session
        echo "<script>alert('Profil berhasil diperbarui!'); window.location.href='profil.php';</script>";
    } else {
        echo "<script>alert('Gagal mengupdate: " . $conn->error . "');</script>";
    }
}
// ----------------------------------
?>

<div class="container py-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow rounded-4 border-0 animate-fade-in">
                <div class="card-body p-4">
                    <h3 class="text-center mb-4 text-brown fw-bold">Edit Profil</h3>

                    <form method="POST" enctype="multipart/form-data">
                        
                        <div class="text-center mb-4">
                            <?php 
                                // Cek apakah ada foto di DB dan filenya ada di folder img
                                $foto_profil = !empty($data['foto']) && file_exists($data['foto']) ? $data['foto'] : 'img/default.png';
                            ?>
                            <img id="imgPreview" src="<?= $foto_profil ?>" class="rounded-circle shadow mb-3" style="width: 120px; height: 120px; object-fit: cover; border: 3px solid var(--gold);">
                            
                            <div class="d-flex justify-content-center gap-2">
                                <label class="btn btn-sm btn-warning text-white rounded-pill fw-bold px-3">
                                    <i class="fas fa-camera me-1"></i> Ganti Foto
                                    <input type="file" name="foto" id="fileInput" style="display: none;" onchange="previewImage()">
                                </label>

                                <?php if($data['foto'] != 'default.png' && !empty($data['foto'])): ?>
                                    <button type="submit" name="hapus_foto" class="btn btn-sm btn-outline-danger rounded-pill px-3" onclick="return confirm('Yakin ingin menghapus foto profil?');">
                                        <i class="fas fa-trash me-1"></i> Hapus Foto
                                    </button>
                                <?php endif; ?>
                            </div>
                            <small class="text-muted d-block mt-2">Format: JPG, PNG. Maks 2MB.</small>
                        </div>
                        <div class="row g-3">
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Nama Lengkap</label>
                                <input type="text" name="nama" class="form-control" value="<?= $data['nama_lengkap'] ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Email</label>
                                <input type="email" name="email" class="form-control" value="<?= $data['email'] ?>" required>
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">Password Baru</label>
                                <input type="password" name="password" class="form-control" placeholder="Kosongkan jika tidak ganti">
                            </div>
                            <div class="col-md-6">
                                <label class="form-label fw-bold small">No. Telepon</label>
                                <input type="text" name="no_telp" class="form-control" value="<?= $data['no_telp'] ?>" required>
                            </div>
                            <div class="col-12">
                                <label class="form-label fw-bold small">Alamat Pengiriman</label>
                                <textarea name="alamat" class="form-control" rows="3" required><?= $data['alamat'] ?></textarea>
                            </div>
                        </div>

                        <div class="d-grid gap-2 mt-4">
                            <button type="submit" name="update" class="btn btn-warning btn-lg fw-bold text-white rounded-pill shadow-sm">
                                <i class="fas fa-save me-2"></i>Simpan Perubahan
                            </button>
                            <a href="profil.php" class="btn btn-light btn-lg rounded-pill text-muted">Batal & Kembali</a>
                        </div>
                    </form>

                </div>
            </div>
        </div>
    </div>
</div>

<?php include 'footer.php'; ?>

<script>
    function previewImage() {
        const fileInput = document.getElementById('fileInput');
        const imgPreview = document.getElementById('imgPreview');

        // Cek apakah ada file yang dipilih
        if (fileInput.files && fileInput.files[0]) {
            const reader = new FileReader();

            // Ketika file selesai dibaca
            reader.onload = function(e) {
                // Ubah src gambar menjadi data URL dari file yang baru dipilih
                imgPreview.src = e.target.result;
            }

            // Baca file sebagai Data URL
            reader.readAsDataURL(fileInput.files[0]);
        }
    }
</script>