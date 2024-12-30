<?php
include '../config/config.php';

// Query untuk mengambil 10 penjual
$query = "SELECT * FROM penjual";
$result = mysqli_query($koneksi, $query);
?>
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Daftar Penjual - Pasar Gatak</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f4f4f4;
        }
        .navbar {
            background-color: #87CEEB;
            color: white;
            padding: 15px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .navbar a {
            border: 1px solid white;
            padding: 5px 10px;
            margin: 0 5px;
            border-radius: 4px;
            text-decoration: none;
            color: white;
            transition: background-color 0.3s ease;
            }

        .navbar a:hover {
            background-color: rgba(255,255,255,0.2);
        }
        .container {
            max-width: 1000px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            box-shadow: 0 0 10px rgba(0,0,0,0.1);
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        table, th, td {
            border: 1px solid #ddd;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #87CEEB;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar">
        <h1>Pasar Gatak</h1>
        <div>
            <a href="../index.php">Beranda</a>
            <a href="penjual.php">Daftar Penjual</a>
        </div>
    </nav>

    <div class="container">
        <h2>Daftar Penjual Pasar Gatak</h2>
        <table>
            <thead>
                <tr>
                    <th>No</th>
                    <th>Nama Penjual</th>
                    <th>Jenis Dagangan</th>
                    <th>Blok</th>
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
                    <td><?= htmlspecialchars($row['blok_tempat_jualan']) ?></td>
                </tr>
                <?php endwhile; ?>
            </tbody>
        </table>
    </div>
                </body>
</html>