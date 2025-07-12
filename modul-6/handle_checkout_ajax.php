<?php
ob_start(); // Pastikan ini baris PERTAMA di file ini
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

if (session_status() === PHP_SESSION_NONE) {
 session_start();

}

// Logika Session Timeout (Opsional, tapi konsisten dengan index.php)
$timeout = 900; // 15 menit
if (isset($_SESSION['last_activity']) && (time() - $_SESSION['last_activity']) > $timeout) {
ob_clean();
 header('Content-Type: application/json');
 echo json_encode(['success' => false, 'message' => 'Sesi Anda telah berakhir. Silakan login kembali.']);
exit;
}

$_SESSION['last_activity'] = time(); // Update waktu aktivitas terakhir
require_once "function.php"; // Pastikan path ini benar dan function.php tidak mencetak apapun
error_log("DEBUG: Checkout POST request detected in handle_checkout_ajax.php.");
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
ob_clean();
header('Content-Type: application/json');



$pelanggan = htmlspecialchars($_POST["pelanggan"] ?? '');
$jenis_pesanan = htmlspecialchars($_POST["jenis_pesanan"] ?? '');

 $nomor_meja = null;
$nomor_antrian = null;
 $nomor_info_for_js = null;

 if (empty($pelanggan)) {
 echo json_encode(['success' => false, 'message' => 'Nama pelanggan tidak boleh kosong.']);
 exit;

 }



 if (!isset($_SESSION['cart']) || empty($_SESSION['cart'])) {
 echo json_encode(['success' => false, 'message' => 'Keranjang belanja kosong, tidak bisa checkout.']);
 exit;

 }



 if ($jenis_pesanan === 'Dine-in') {
 $nomor_meja = htmlspecialchars($_POST["nomor_meja"] ?? '');
 $id_meja_terpilih = get_id_meja_by_nomor($nomor_meja);
 if (!$id_meja_terpilih) {
 echo json_encode(['success' => false, 'message' => 'Nomor meja tidak valid atau tidak tersedia!']);
 exit;
 }

 $nomor_info_for_js = $nomor_meja;

 } else { // Asumsi 'Takeaway'

 try {
 $nomor_antrian = generate_nomor_antrean($pdo);

 if (!$nomor_antrian) {

echo json_encode(['success' => false, 'message' => 'Gagal membuat nomor antrean.']);

exit;
}

} catch (PDOException $e) {

error_log("Error generating queue number: " . $e->getMessage());

echo json_encode(['success' => false, 'message' => 'Terjadi kesalahan internal saat membuat nomor antrean.']);

 exit;

 }

 $nomor_info_for_js = $nomor_antrian;

 }



error_log("DEBUG: S_SESSION['cart'] before tambah_data_pesanan: " . print_r($_SESSION['cart'] ?? 'Cart is not set', true));



    // Pastikan Anda memanggil fungsi tambah_data_pesanan dengan id_meja_terpilih sebagai parameter terakhir

$result = tambah_data_pesanan($pelanggan, $nomor_meja, $nomor_antrian, $jenis_pesanan, $id_meja_terpilih);



 if ($result['status'] > 0) {

 if ($jenis_pesanan === 'Dine-in' && $id_meja_terpilih) {

 update_status_meja($id_meja_terpilih, 'terisi');

 }



 unset($_SESSION['cart']);

 error_log("DEBUG: S_SESSION['cart'] AFTER successful checkout (should be empty): " . print_r($_SESSION['cart'] ?? 'Cart is not set', true));



 echo json_encode([

 'success' => true,

 'message' => 'Pesanan Berhasil Dikirim!',

 'kode_pesanan' => $result['kode_pesanan'],

 'jenis_pesanan' => $jenis_pesanan,

'nomor_info' => $nomor_info_for_js

 ]);

 exit;

} else {

echo json_encode(['success' => false, 'message' => $result['message'] ?: 'Pesanan Gagal Dikirim!']);

 exit;

 }

} else {

 ob_clean();

 header('Content-Type: application/json');

echo json_encode(['success' => false, 'message' => 'Metode permintaan tidak valid.']);

 exit;

}

?>