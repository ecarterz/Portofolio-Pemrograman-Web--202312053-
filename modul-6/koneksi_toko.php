<?php
$servername = "localhost"; // Server database (biasanya localhost)
$username = "root"; // Username database
$password = ""; // Password database (kosongkan jika tidak ada)
$dbname = "db_toko"; // Nama database yang baru dibuat

// Membuat koneksi
$conn = new mysqli($servername, $username, password: $password, database: $dbname);

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi gagal: " . $conn->connect_error);
}
?>