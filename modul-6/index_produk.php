<!DOCTYPE html>
<html>
<head>
    <title>Data Produk</title>
    <link rel="stylesheet" href="style_produk.css">
</head>
<body>
    <h2>Daftar Produk Toko Online</h2>
    <a href="tambah_produk.php" class="btn btn-add">Tambah Produk Baru</a>
    <br><br>
    <table>
        <thead>
            <tr>
                <th>ID Produk</th>
                <th>Nama Produk</th>
                <th>Harga</th>
                <th>Stok</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php
            include 'koneksi_toko.php'; // Menyertakan file koneksi baru
            $sql = "SELECT id_produk, nama_produk, harga, stok FROM produk";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Loop untuk menampilkan setiap baris data
                while ($row = $result->fetch_assoc()) {
                    echo "<tr>";
                    echo "<td>" . $row["id_produk"] . "</td>";
                    echo "<td>" . $row["nama_produk"] . "</td>";
                    echo "<td>Rp " . number_format($row["harga"], 0, ',', '.') . "</td>";
                    echo "<td>" . $row["stok"] . "</td>";
                    echo "<td><a href='edit_produk.php?id=" . $row["id_produk"] . "' class='btn btn-edit'>Edit</a> <a href='hapus_produk.php?id=" . $row["id_produk"] . "' class='btn btn-delete' onclick='return confirm(\"Apakah Anda yakin ingin menghapus produk ini?\")'>Hapus</a></td>";
                    echo "</tr>";
                }
            } else {
                echo "<tr><td colspan='5'>Tidak ada data produk</td></tr>";
            }
            $conn->close();
            ?>
        </tbody>
    </table>
</body>
</html>