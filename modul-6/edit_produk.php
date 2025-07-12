<?php
include 'koneksi_toko.php';
$id = $_GET['id'];
$sql = "SELECT * FROM produk WHERE id_produk=$id";
$result = $conn->query($sql);
$row = $result->fetch_assoc();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Produk</title>
    <link rel="stylesheet" href="style_produk.css">
</head>
<body>
    <div class="form-container">
        <h2>Form Edit Data Produk</h2>
        <form action="proses_edit_produk.php" method="post">
            <input type="hidden" name="id_produk" value="<?php echo $row['id_produk']; ?>">
            <label for="nama_produk">Nama Produk:</label><br>
            <input type="text" id="nama_produk" name="nama_produk" value="<?php echo htmlspecialchars($row['nama_produk']); ?>" required><br><br>
            <label for="harga">Harga:</label><br>
            <input type="number" id="harga" name="harga" value="<?php echo htmlspecialchars($row['harga']); ?>" required><br><br>
            <label for="stok">Stok:</label><br>
            <input type="number" id="stok" name="stok" value="<?php echo htmlspecialchars($row['stok']); ?>" required><br><br>
            <input type="submit" value="Update" class="btn btn-edit">
        </form>
    </div>
</body>
</html>