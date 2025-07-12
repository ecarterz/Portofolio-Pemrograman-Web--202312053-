<?php
include 'koneksi_toko.php';

// Mengambil data dari form
$id_produk = $_POST['id_produk'];
$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

// Query untuk memperbarui data
$sql = "UPDATE produk SET nama_produk='$nama_produk', harga='$harga', stok='$stok' WHERE id_produk=$id_produk";

if ($conn->query($sql) === TRUE) {
    header("Location: index_produk.php");
    exit();
} else {
    echo "Error updating record: " . $conn->error;
}
$conn->close();