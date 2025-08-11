<?php include 'koneksi.php'; ?>

<h2>Kelola Kategori</h2>
<form method="post">
    <input type="text" name="nama_kategori" placeholder="Nama kategori" required>
    <button type="submit" name="tambah">Tambah</button>
</form>

<?php
if (isset($_POST['tambah'])) {
    $nama = $_POST['nama_kategori'];
    mysqli_query($conn, "INSERT INTO kategori (nama_kategori) VALUES ('$nama')");
}

if (isset($_GET['hapus'])) {
    $id = $_GET['hapus'];
    mysqli_query($conn, "DELETE FROM kategori WHERE id_kategori='$id'");
}

$kat = mysqli_query($conn, "SELECT * FROM kategori");
echo "<ul>";
while ($k = mysqli_fetch_assoc($kat)) {
    echo "<li>{$k['nama_kategori']} <a href='?hapus={$k['id_kategori']}'>Hapus</a></li>";
}
echo "</ul>";

echo "<a href='index.php'>⬅ Kembali</a>";
?>
