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

// Ambil data penjual yang akan diedit
$id = intval($_GET['id']);
$query = "SELECT * FROM penjual WHERE id = $id";
$result = mysqli_query($koneksi, $query);
$penjual = mysqli_fetch_assoc($result);

// Proses update penjual
if (isset($_POST['update'])) {
    $nama = validasi_input($_POST['nama']);
    $jenis_dagangan = validasi_input($_POST['jenis_dagangan']);
    $blok_tempat_jualan = validasi_input($_POST['blok_tempat_jualan']); // Ganti nama variabel

    $update_query = "UPDATE penjual 
                     SET nama = '$nama', 
                         jenis_dagangan = '$jenis_dagangan', 
                         blok_tempat_jualan = '$blok_tempat_jualan' 
                     WHERE id = $id";
    mysqli_query($koneksi, $update_query);
    
    header("Location: crud_penjual.php");
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Edit Penjual - Pasar Gatak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .form-container {
            background-color: white;
            padding: 30px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
            width: 300px;
        }
        .form-container input,
        .form-container select {
            width: 100%;
            padding: 10px;
            margin-bottom: 15px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        .form-container button {
            width: 100%;
            padding: 10px;
            background-color: #4CAF50;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <div class="form-container">
        <h2>Edit Penjual</h2>
        <form method="POST">
            <input 
                type="text" 
                name="nama" 
                value="<?= htmlspecialchars($penjual['nama']) ?>" 
                required
            >
            <select name="jenis_dagangan" required>
                <option value="Sayur" 
                    <?= $penjual['jenis_dagangan'] == 'Sayur' ? 'selected' : '' ?>>
                    Sayur
                </option>
                <option value="Buah" 
                    <?= $penjual['jenis_dagangan'] == 'Buah' ? 'selected' : '' ?>>
                    Buah
                </option>
                <option value="Ikan" 
                    <?= $penjual['jenis_dagangan'] == 'Ikan' ? 'selected' : '' ?>>
                    Ikan
                </option>
                <option value="Daging" 
                    <?= $penjual['jenis_dagangan'] == 'Daging' ? 'selected' : '' ?>>
                    Daging
                </option>
                <option value="Bumbu" 
                    <?= $penjual['jenis_dagangan'] == 'Bumbu' ? 'selected' : '' ?>>
                    Bumbu
                </option>
                <option value="Lainnya" 
                    <?= $penjual['jenis_dagangan'] == 'Lainnya' ? 'selected' : '' ?>>
                    Lainnya
                </option>
            </select>
            <input 
                type="text" 
                name="blok_tempat_jualan" 
                value="<?= htmlspecialchars($penjual['blok_tempat_jualan']) ?>" 
                required
            >
            <button type="submit" name="update">Update Penjual</button>
        </form>
    </div>
</body>
</html>