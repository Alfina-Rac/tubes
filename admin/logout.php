<?php
include '../config/config.php';
include '../middleware/auth.php';
cek_akses_admin();

// Hapus semua session
$_SESSION = [];
session_unset();
session_destroy();

// Redirect ke halaman login
header("Location: login.php");
exit();
?>