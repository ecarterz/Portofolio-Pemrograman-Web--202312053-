<?php
include 'koneksi_toko.php';

// Mengambil data dari form
$nama_produk = $_POST['nama_produk'];
$harga = $_POST['harga'];
$stok = $_POST['stok'];

// Query untuk menyisipkan data
$sql = "INSERT INTO produk (nama_produk, harga, stok) VALUES ('$nama_produk', '$harga', '$stok')";

if ($conn->query($sql) === TRUE) {
    header("Location: index_produk.php"); // Arahkan kembali ke halaman utama jika berhasil
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}
$conn->close();