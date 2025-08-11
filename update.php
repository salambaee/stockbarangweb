<?php include 'koneksi.php'; ?>

<?php
$id = $_GET['id'];
$barang = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM barang WHERE id_barang='$id'"));

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $kode = $_POST['kode_barang'];
    $nama = $_POST['nama_barang'];
    $pcs = $_POST['jumlah_pcs'];
    $maxpcs = $_POST['max_pcs_per_caton'];
    $kategori = $_POST['id_kategori'];

    $sql = "UPDATE barang SET 
            kode_barang='$kode', 
            nama_barang='$nama', 
            jumlah_pcs='$pcs', 
            max_pcs_per_caton='$maxpcs', 
            id_kategori='$kategori' 
            WHERE id_barang='$id'";
    mysqli_query($conn, $sql);
    header("Location: index.php");
}
?>

<h2>Edit Barang</h2>
<form method="post">
    Kode Barang: <input type="text" name="kode_barang" value="<?= $barang['kode_barang'] ?>" required><br><br>
    Nama Barang: <input type="text" name="nama_barang" value="<?= $barang['nama_barang'] ?>" required><br><br>
    Jumlah PCS: <input type="number" name="jumlah_pcs" value="<?= $barang['jumlah_pcs'] ?>" required><br><br>
    Max PCS/Carton: <input type="number" name="max_pcs_per_caton" value="<?= $barang['max_pcs_per_caton'] ?>" required><br><br>
    Kategori: 
    <select name="id_kategori">
        <?php
        $kat = mysqli_query($conn, "SELECT * FROM kategori");
        while ($k = mysqli_fetch_assoc($kat)) {
            $sel = $k['id_kategori'] == $barang['id_kategori'] ? "selected" : "";
            echo "<option value='{$k['id_kategori']}' $sel>{$k['nama_kategori']}</option>";
        }
        ?>
    </select><br><br>
    <button type="submit">Update</button>
</form>
