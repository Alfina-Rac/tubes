<?php
include '../config/config.php';
include '../middleware/auth.php';
error_reporting(E_ALL);
ini_set('display_errors', 1);
cek_akses_admin();
session_start();

// Cek apakah sudah login
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit();
}

// Ambil jumlah penjual
$query_penjual = "SELECT COUNT(*) as total_penjual FROM penjual";
$result_penjual = mysqli_query($koneksi, $query_penjual);
$total_penjual = mysqli_fetch_assoc($result_penjual)['total_penjual'];
?>

<!DOCTYPE html>
<html>
<head>
    <title>Dashboard Admin - Pasar Gatak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .navbar {
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .dashboard-container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        .dashboard-menu {
            display: flex;
            justify-content: space-around;
            margin-top: 20px;
        }
        .dashboard-menu a {
            text-decoration: none;
            background-color: #4CAF50;
            color: white;
            padding: 15px;
            border-radius: 5px;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Dashboard Admin</h1>
        <div>
            <span>Selamat datang, <?= $_SESSION['username'] ?></span>
            <a href="../index.php" style="color: white; margin-left: 15px;">Beranda</a>
            <a href="logout.php" style="color: white; margin-left: 15px;">Logout</a>
        </div>
    </nav>

    <div class="dashboard-container">
        <h2>Statistik Pasar Gatak</h2>
        <div>
            <p>Jumlah Penjual: <?= $total_penjual ?></p>
        </div>

        <div class="dashboard-menu">
            <a href="crud_penjual.php">Kelola Penjual</a>
        </div>
    </div>
</body>
</html>