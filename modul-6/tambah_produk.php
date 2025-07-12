<!DOCTYPE html>
<html>
<head>
    <title>Tambah Produk</title>
    <link rel="stylesheet" href="style_produk.css">
</head>
<body>
    <div class="form-container">
        <h2>Form Tambah Produk Baru</h2>
        <form action="proses_tambah_produk.php" method="post">
            <label for="nama_produk">Nama Produk:</label><br>
            <input type="text" id="nama_produk" name="nama_produk" required><br><br>
            <label for="harga">Harga:</label><br>
            <input type="number" id="harga" name="harga" required><br><br>
            <label for="stok">Stok:</label><br>
            <input type="number" id="stok" name="stok" required><br><br>
            <input type="submit" value="Simpan" class="btn btn-add">
        </form>
    </div>
</body>
</html>