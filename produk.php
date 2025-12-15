<?php 
include 'header.php'; 
include 'db.php';
?>

<section class="hero-section" style="height: 40vh; background-image: url('img/banner.png');">
    <div class="hero-content container">
        <h1 class="display-4 fw-bold mb-3">Koleksi Produk</h1>
        <p class="lead">Temukan keindahan ukiran jati asli</p>
    </div>
</section>

<main class="container py-5">
    <div class="row mb-5">
        <div class="col-12 text-center">
            <a href="produk.php" class="btn btn-outline-brown rounded-pill m-1 <?= !isset($_GET['kategori']) ? 'active bg-warning text-white border-0' : '' ?>">Semua</a>
            <a href="produk.php?kategori=kursi" class="btn btn-outline-brown rounded-pill m-1 <?= (isset($_GET['kategori']) && $_GET['kategori']=='kursi') ? 'active bg-warning text-white border-0' : '' ?>">Kursi</a>
            <a href="produk.php?kategori=meja" class="btn btn-outline-brown rounded-pill m-1 <?= (isset($_GET['kategori']) && $_GET['kategori']=='meja') ? 'active bg-warning text-white border-0' : '' ?>">Meja</a>
            <a href="produk.php?kategori=lemari" class="btn btn-outline-brown rounded-pill m-1 <?= (isset($_GET['kategori']) && $_GET['kategori']=='lemari') ? 'active bg-warning text-white border-0' : '' ?>">Lemari</a>
            <a href="produk.php?kategori=tempat-tidur" class="btn btn-outline-brown rounded-pill m-1 <?= (isset($_GET['kategori']) && $_GET['kategori']=='tempat-tidur') ? 'active bg-warning text-white border-0' : '' ?>">Tempat Tidur</a>
        </div>
    </div>

    <div class="row g-4">
        <?php
        $where = "";
        if (isset($_GET['kategori'])) {
            $kat = $_GET['kategori'];
            $where = "WHERE kategori = '$kat'";
        }
        
        $query = "SELECT * FROM produk $where ORDER BY id DESC";
        $result = $conn->query($query);

        if ($result->num_rows > 0):
            while($row = $result->fetch_assoc()):
        ?>
            <div class="col-md-6 col-lg-3 animate-fade-in">
                <div class="product-card text-center h-100 position-relative">
                    <div class="image-placeholder p-0">
                        <img src="<?= $row['gambar'] ?>" alt="<?= $row['nama'] ?>" style="width:100%; height:100%; object-fit:cover;">
                    </div>
                    <h5 class="mt-3"><?= $row['nama'] ?></h5>
                    <p class="text-muted small"><?= substr($row['deskripsi'], 0, 50) ?>...</p>
                    <h6 class="fw-bold text-brown">Rp <?= number_format($row['harga'], 0, ',', '.') ?></h6>
                    
                    <div class="mt-3">
                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] === 'admin'): ?>
                            <a href="edit_produk.php?id=<?= $row['id'] ?>" class="btn btn-sm btn-primary rounded-pill px-4">
                                <i class="fas fa-edit"></i> Edit Produk
                            </a>
                        <?php else: ?>
                            <button class="btn btn-sm btn-outline-secondary rounded-pill" 
                                onclick="openModal('<?= $row['id'] ?>', '<?= $row['nama'] ?>', '<?= $row['harga'] ?>', '<?= $row['gambar'] ?>', `<?= $row['deskripsi'] ?>`)">
                                <i class="fas fa-eye"></i> Detail & Beli
                            </button>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
        <?php 
            endwhile; 
        else:
            echo "<div class='col-12 text-center'><p>Belum ada produk.</p></div>";
        endif;
        ?>
    </div>
</main>

<div class="modal fade" id="pilihanModal" tabindex="-1">
   <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalNamaProduk">Nama Produk</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal"></button>
      </div>
      <div class="modal-body text-center">
          <img id="modalGambarProduk" src="" style="width: 200px; border-radius: 10px; margin-bottom: 15px;">
          <h4 id="modalHargaProduk" class="fw-bold text-brown"></h4>
          <p id="modalDeskripsi" class="text-muted small"></p>
      </div>
      <div class="modal-footer">
        <form action="tambah_keranjang.php" method="POST" class="d-flex w-100 gap-2">
            <input type="hidden" name="id" id="inputId">
            <input type="hidden" name="nama" id="inputNama">
            <input type="hidden" name="harga" id="inputHarga">
            <input type="hidden" name="gambar" id="inputGambar">
            <input type="number" name="qty" value="1" min="1" class="form-control" style="width: 70px;">
            
            <button type="submit" name="add_to_cart" class="btn btn-warning text-white flex-grow-1">
                <i class="fas fa-shopping-cart"></i> + Keranjang
            </button>
            <button type="submit" name="buy_now" class="btn btn-success flex-grow-1">
                Beli Langsung
            </button>
        </form>
      </div>
    </div>
  </div>
</div>

<?php include 'footer.php'; ?>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
<script>
    function openModal(id, nama, harga, gambar, deskripsi) {
        document.getElementById("modalNamaProduk").innerText = nama;
        document.getElementById("modalHargaProduk").innerText = "Rp " + new Intl.NumberFormat('id-ID').format(harga);
        document.getElementById("modalGambarProduk").src = gambar;
        document.getElementById("modalDeskripsi").innerText = deskripsi;

        // Set value form hidden
        document.getElementById("inputId").value = id;
        document.getElementById("inputNama").value = nama;
        document.getElementById("inputHarga").value = harga;
        document.getElementById("inputGambar").value = gambar;

        let modal = new bootstrap.Modal(document.getElementById('pilihanModal'));
        modal.show();
    }
</script>
