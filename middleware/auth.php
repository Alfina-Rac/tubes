<?php
function cek_akses_admin() {
    if (!isset($_SESSION['login']) || $_SESSION['login'] !== true) {
        header("Location: ../admin/login.php");
        exit();
    }
}