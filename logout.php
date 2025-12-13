<?php
session_start();
session_unset();   // menghapus semua session
session_destroy(); // menghancurkan session

header("Location: login.php"); // kembali ke halaman login
exit();
?>