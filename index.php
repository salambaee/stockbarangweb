<?php include 'koneksi.php'; ?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <title>Manajemen Stocker Gudang</title>
    <style>
        table { border-collapse: collapse; width: 80%; margin: 20px auto; }
        th, td { border: 1px solid #ccc; padding: 8px; text-align: center; }
        th { background: #f4f4f4; }
        a { text-decoration: none; margin: 0 5px; }
    </style>
</head>
<body>
<h2 style="text-align:center;">📦 Manajemen Stocker Gudang</h2>
<div style="text-align:center;">
    <a href="tambah.php">➕ Tambah Barang</a> | 
    <a href="kategori.php">📂 Kelola Kategori</a>
    <a href="export.php">Export ke Excel</a>
</div>

<table>
    <tr>
        <th>Kode</th>
        <th>Nama Barang</th>
        <th>Kategori</th>
        <th>Jumlah PCS</th>
        <th>Max PCS/Carton</th>
        <th>Jumlah Carton</th>
        <th>Sisa PCS</th>
        <th>Aksi</th>
    </tr>
    <?php
    $sql = "SELECT b.*, k.nama_kategori 
            FROM barang b 
            LEFT JOIN kategori k ON b.id_kategori = k.id_kategori";
    $result = mysqli_query($conn, $sql);

    while ($row = mysqli_fetch_assoc($result)) {
        $carton = floor($row['jumlah_pcs'] / $row['max_pcs_per_caton']);
        $sisa = $row['jumlah_pcs'] % $row['max_pcs_per_caton'];

        echo "<tr>
            <td>{$row['kode_barang']}</td>
            <td>{$row['nama_barang']}</td>
            <td>{$row['nama_kategori']}</td>
            <td>{$row['jumlah_pcs']}</td>
            <td>{$row['max_pcs_per_caton']}</td>
            <td>{$carton}</td>
            <td>{$sisa}</td>
            <td>
                <a href='update.php?id={$row['id_barang']}'>✏ Edit</a>
                <a href='hapus.php?id={$row['id_barang']}' onclick=\"return confirm('Hapus barang ini?');\">🗑 Hapus</a>
            </td>
        </tr>";
    }
    ?>
</table>
</body>
</html>
