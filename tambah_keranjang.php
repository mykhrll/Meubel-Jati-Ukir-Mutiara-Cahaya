<?php
session_start();
include 'db.php';

// Pastikan user sudah login
if (!isset($_SESSION['user_id'])) {
    echo "<script>alert('Silakan login terlebih dahulu untuk berbelanja!'); window.location.href='login.php';</script>";
    exit;
}

if (isset($_POST['add_to_cart']) || isset($_POST['buy_now'])) {
    $user_id = $_SESSION['user_id'];
    $produk_id = $_POST['id'];
    $qty = $_POST['qty'];

    // 1. Cek apakah produk sudah ada di keranjang database user ini?
    $cek = $conn->query("SELECT * FROM keranjang WHERE user_id='$user_id' AND produk_id='$produk_id'");
    
    if ($cek->num_rows > 0) {
        // Jika ada, update jumlahnya (tambah)
        $conn->query("UPDATE keranjang SET qty = qty + $qty WHERE user_id='$user_id' AND produk_id='$produk_id'");
    } else {
        // Jika belum ada, masukkan baru
        $conn->query("INSERT INTO keranjang (user_id, produk_id, qty) VALUES ('$user_id', '$produk_id', '$qty')");
    }

    // REDIRECT
    if (isset($_POST['buy_now'])) {
        header("Location: checkout.php");
    } else {
        echo "<script>alert('Produk berhasil masuk keranjang database!'); window.history.back();</script>";
    }
}
?>