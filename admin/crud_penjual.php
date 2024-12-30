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

// Proses Tambah Penjual
if (isset($_POST['tambah'])) {
    $nama = validasi_input($_POST['nama']);
    $jenis_dagangan = validasi_input($_POST['jenis_dagangan']);
    $blok_tempat_jualan = validasi_input($_POST['blok_tempat_jualan']); // Ganti nama variabel

    $query = "INSERT INTO penjual (nama, jenis_dagangan, blok_tempat_jualan) VALUES ('$nama', '$jenis_dagangan', '$blok_tempat_jualan')";
    if (!mysqli_query($koneksi, $query)) {
        echo "Error: " . mysqli_error($koneksi);
    }
    header("Location: crud_penjual.php");
    exit();
}

// Proses Hapus Penjual
if (isset($_GET['hapus'])) {
    $id = intval($_GET['hapus']);
    $query = "DELETE FROM penjual WHERE id = $id";
    mysqli_query($koneksi, $query);
    header("Location: crud_penjual.php");
    exit();
}

// Ambil data penjual
$query = "SELECT * FROM penjual";
$result = mysqli_query($koneksi, $query);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Kelola Penjual - Pasar Gatak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
        }
        .form-tambah {
            margin-bottom: 20px;
        }
    </style>
</head>
<body>
    <div class="container">
        <h2>Kelola Penjual</h2>
        
        <!-- Form Tambah Penjual -->
        <form method="POST" class="form-tambah">
            <input type="text" name="nama" placeholder="Nama Penjual" required>
            <select name="jenis_dagangan" required>
                <option value="">Pilih Jenis Dagangan</option>
                <option value="Sayur">Sayur</option>
                <option value="Buah">Buah</option>
                <option value="Ikan">Ikan</option>
                <option value="Daging">Daging</option>
                <option value="Bumbu">Bumbu</option>
                <option value="Lainnya">Lainnya</option>
            </select>
            <input type="text" name="blok_tempat_jualan" placeholder="Blok" required> <!-- Ganti nama variabel -->
            <button type="submit" name="tambah">Tambah Penjual</button>
        </form>

        <!-- Tabel Daftar Penjual -->
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama</th>
                    <th>Jenis Dagangan</th>
                    <th>Blok</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php 
                $no = 1;
                while ($row = mysqli_fetch_assoc($result)): 
                ?>
                <tr>
                    <td><?= $no++ ?></td>
                    <td><?= htmlspecialchars($row['nama']) ?></td>
                    <td><?= htmlspecialchars($row['jenis_dagangan']) ?></td>
                    <td><?= htmlspecialchars($row['blok_tempat_jualan']) ?></td> <!-- Ganti nama variabel -->
                    <td>
                        <a href="edit_penjual.php?id=<?= $row['id'] ?>">Edit</a>
                        <a href="?hapus=<?= $row['id'] ?>" onclick="return confirm('Yakin ingin menghapus?')">Hapus</a>
                    </td>
                </tr>
                <?php endwhile; ?>
            </tbody>
            </table>
    </div>
</body>
</html>
       