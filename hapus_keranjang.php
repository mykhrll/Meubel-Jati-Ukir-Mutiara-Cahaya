<?php
session_start();
include 'db.php';

if (isset($_GET['id']) && isset($_SESSION['user_id'])) {
    $id = $_GET['id'];
    $user_id = $_SESSION['user_id'];
    
    // Hapus dari tabel keranjang, pastikan milik user yang sedang login
    $conn->query("DELETE FROM keranjang WHERE id='$id' AND user_id='$user_id'");
}

echo "<script>alert('Produk dihapus dari keranjang.'); window.location.href='keranjang.php';</script>";
?>