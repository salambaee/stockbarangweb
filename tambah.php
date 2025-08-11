<?php include 'koneksi.php'; ?>

<?php
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $pcs = $_POST['jumlah_pcs'];
    $maxpcs = $_POST['max_pcs_per_caton'];
    $kategori = $_POST['id_kategori'];

    $sql = "INSERT INTO barang (kode_barang, nama_barang, jumlah_pcs, max_pcs_per_caton, id_kategori)
            VALUES ('$kode', '$nama', '$pcs', '$maxpcs', '$kategori')";
    mysqli_query($conn, $sql);
    header("Location: index.php");
}
?>

<h2>Tambah Barang</h2>
<form method="post">
    Kode Barang: <input type="text" name="kode_barang" required><br><br>
    Nama Barang: <input type="text" name="nama_barang" required><br><br>
    Jumlah PCS: <input type="number" name="jumlah_pcs" required><br><br>
    Max PCS/Carton: <input type="number" name="max_pcs_per_caton" required><br><br>
    Kategori: 
    <select name="id_kategori">
        <?php
        $kat = mysqli_query($conn, "SELECT * FROM kategori");
        while ($k = mysqli_fetch_assoc($kat)) {
            echo "<option value='{$k['id_kategori']}'>{$k['nama_kategori']}</option>";
        }
        ?>
    </select><br><br>
    <button type="submit">Simpan</button>
</form>
