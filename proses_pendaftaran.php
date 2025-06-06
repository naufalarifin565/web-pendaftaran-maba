<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Status Pendaftaran</title>
    <link rel="stylesheet" href="style.css">
    <style>
        /* Style ini sama seperti sebelumnya untuk menjaga konsistensi tampilan */
        .status-container {
            max-width: 700px;
            width: 100%;
            background-color: #fff;
            padding: 30px 40px;
            border-radius: 15px;
            box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
            text-align: center;
        }
        .status-container h1.success { color: #27ae60; }
        .status-container h1.error { color: #e74c3c; }
    </style>
</head>
<body>

<div class="status-container">
<?php
// Cek apakah data dikirim melalui metode POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // 1. Tentukan nama file untuk menyimpan data
    $file = 'data_pendaftar.txt';

    // 2. Ambil data dari form (sama seperti sebelumnya)
    $nama = trim($_POST['nama']);
    $alamat = trim($_POST['alamat']);
    $jenis_kelamin = isset($_POST['jenis_kelamin']) ? trim($_POST['jenis_kelamin']) : 'Tidak diisi';
    $agama = trim($_POST['agama']);
    $asal_sekolah = trim($_POST['asal_sekolah']);
    $email = trim($_POST['email']);
    $no_telepon = trim($_POST['no_telepon']);
    $tanggal_pendaftaran = date("Y-m-d H:i:s"); // Tambahkan tanggal dan waktu saat ini

    // 3. Buat baris data dengan format CSV.
    // Setiap data akan diapit oleh tanda kutip (") dan dipisahkan oleh koma (,)
    $dataString = "\"$nama\",\"$alamat\",\"$jenis_kelamin\",\"$agama\",\"$asal_sekolah\",\"$email\",\"$no_telepon\",\"$tanggal_pendaftaran\"\n";

    // 4. Buka file dalam mode 'append' (a).
    // Mode 'a' akan menambahkan data baru di akhir file.
    // Jika file belum ada, PHP akan mencoba membuatnya.
    // @fopen digunakan untuk menekan warning jika file tidak bisa dibuka.
    $fileHandle = @fopen($file, 'a');

    // 5. Tulis data ke file dan berikan pesan
    if ($fileHandle) {
        fwrite($fileHandle, $dataString);
        fclose($fileHandle); // Selalu tutup file setelah selesai

        echo "<h1 class='success'>✅ Pendaftaran Berhasil Disimpan!</h1>";
        echo "<p>Terima kasih, <strong>" . htmlspecialchars($nama) . "</strong>. Data Anda telah berhasil disimpan ke dalam file.</p>";
    } else {
        echo "<h1 class='error'>❌ Terjadi Kesalahan!</h1>";
        echo "<p>Data Anda gagal disimpan. Tidak dapat membuka file untuk penulisan.</p>";
        echo "<p>Pastikan folder proyek Anda memiliki izin (permission) untuk menulis file.</p>";
    }

} else {
    // Jika file diakses langsung, redirect ke formulir
    header("Location: index.html");
    exit();
}
?>
</div>

</body>
</html>