<?php
// config.php
// Start session untuk menyimpan state login dan keranjang
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>