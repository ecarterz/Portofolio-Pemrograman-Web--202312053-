<!DOCTYPE html>
 <html>

 <head>
 <title>Latihan Kondisi PHP</title>
 </head>

 <body>
 <h1>Cek Nilai</h1>
 <?php
 $nilai = 85;
 echo "<p>Nilai Anda: $nilai</p>";

 if ($nilai > 90) {
 echo "<p style='color:blue;'>Predikat: Sangat Baik</p>";
 } elseif ($nilai > 80) {
 echo "<p style='color:green;'>Predikat: Baik</p>";
 } elseif ($nilai > 70) {
 echo "<p style='color:orange;'>Predikat: Cukup</p>";
 } else {
 echo "<p style='color:red;'>Predikat: Kurang, Anda perlu belajar lagi.</p>";
 }
 ?>
 </body>

 </html>