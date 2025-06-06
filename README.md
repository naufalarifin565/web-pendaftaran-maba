# Formulir Pendaftaran Mahasiswa Baru

Sebuah proyek aplikasi web sederhana untuk pendaftaran mahasiswa baru yang dibuat menggunakan HTML, CSS, JavaScript, dan PHP. Proyek ini dirancang sebagai sarana belajar dasar-dasar pengembangan web full-stack, mulai dari antarmuka pengguna (frontend) hingga pemrosesan di sisi server (backend) dan penyimpanan data.

-----

## Daftar Isi

1.  [Fitur](https://www.google.com/search?q=%23fitur)
2.  [Teknologi yang Digunakan](https://www.google.com/search?q=%23teknologi-yang-digunakan)
3.  [Struktur Folder](https://www.google.com/search?q=%23struktur-folder)
4.  [Instalasi dan Konfigurasi](https://www.google.com/search?q=%23instalasi-dan-konfigurasi)
5.  [Cara Menjalankan Proyek](https://www.google.com/search?q=%23cara-menjalankan-proyek)
6.  [Pilihan Metode Penyimpanan](https://www.google.com/search?q=%23pilihan-metode-penyimpanan)

-----

## Fitur

  - **Formulir Responsif**: Tampilan formulir yang bersih dan dapat menyesuaikan diri dengan berbagai ukuran layar (desktop maupun mobile).
  - **Validasi Klien**: Validasi input di sisi browser menggunakan JavaScript untuk memastikan data yang dikirim tidak kosong dan sesuai format (misal: email).
  - **Pemrosesan Server**: Data formulir diterima dan diproses dengan aman menggunakan PHP.
  - **Dua Pilihan Penyimpanan**: Proyek ini menyediakan dua opsi untuk menyimpan data pendaftar:
    1.  Ke dalam **file teks (`.txt`)** dengan format CSV.
    2.  Ke dalam **database MySQL**.

-----

## Teknologi yang Digunakan

  - **Frontend**:
      - HTML5
      - CSS3
      - JavaScript
  - **Backend**:
      - PHP
  - **Lingkungan Pengembangan**:
      - [XAMPP](https://www.apachefriends.org/index.html) (Apache Web Server + PHP + MySQL/MariaDB)

-----

## Struktur Folder

```
📁 pendaftaran-maba/
├── 📄 index.html         (Struktur formulir utama)
├── 📄 style.css          (Styling untuk tampilan)
├── 📄 script.js          (Logika validasi di sisi klien)
├── 📄 proses_pendaftaran.php (Logika pemrosesan di sisi server)
├── 📄 data_pendaftar.txt (Dibuat otomatis saat menggunakan metode file teks)
└── 📄 README.md          (Dokumentasi proyek ini)
```

-----

## Instalasi dan Konfigurasi

### 1\. Prasyarat

Pastikan Anda sudah menginstal **XAMPP** di komputer Anda.

### 2\. Dapatkan Kode Proyek

  - Unduh atau clone repositori ini ke komputer Anda.

### 3\. Tempatkan Folder Proyek

  - Pindahkan folder `pendaftaran-maba` ke dalam direktori `htdocs` di dalam folder instalasi XAMPP Anda.
  - Lokasi default di Windows: `C:\xampp\htdocs\`
  - Lokasi default di macOS: `/Applications/XAMPP/htdocs/`

### 4\. Konfigurasi Database (Opsional)

Langkah ini **hanya diperlukan jika Anda ingin menggunakan metode penyimpanan database MySQL**.

1.  Jalankan modul **Apache** dan **MySQL** dari XAMPP Control Panel.
2.  Buka browser dan akses `http://localhost/phpmyadmin/`.
3.  Buat database baru dengan nama `db_kampus`.
4.  Pilih database `db_kampus`, buka tab **SQL**, dan jalankan query berikut untuk membuat tabel:
    ```sql
    CREATE TABLE pendaftar (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        nama VARCHAR(100) NOT NULL,
        alamat TEXT NOT NULL,
        jenis_kelamin VARCHAR(20) NOT NULL,
        agama VARCHAR(50) NOT NULL,
        asal_sekolah VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        no_telepon VARCHAR(15) NOT NULL,
        tanggal_pendaftaran TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    ```

-----

## Cara Menjalankan Proyek

1.  Buka **XAMPP Control Panel**. Jika di Windows, disarankan untuk **"Run as administrator"**.
2.  **Start** modul **Apache**. (Start juga modul **MySQL** jika Anda menggunakan metode database).
3.  Buka browser web (Chrome, Firefox, dll).
4.  **PENTING**: Akses proyek dengan mengetik URL berikut di address bar:
    ```
    http://localhost/pendaftaran-maba/
    ```
5.  Formulir pendaftaran siap digunakan.

> **Catatan Kritis**: Jangan membuka file `index.html` secara langsung dengan klik ganda atau menggunakan ekstensi "Live Server" dari VS Code (yang beralamat di `port:5500`). Hal tersebut tidak akan menjalankan skrip PHP, sehingga data tidak akan pernah tersimpan. Proyek ini harus dijalankan melalui server Apache yang disediakan XAMPP.

-----

## Pilihan Metode Penyimpanan

Anda bisa memilih cara data disimpan dengan mengubah isi file `proses_pendaftaran.php`.

### 1\. Menyimpan ke File Teks (Metode Default Saat Ini)

  - **Cara Kerja**: Kode di `proses_pendaftaran.php` saat ini akan menyimpan setiap pendaftar sebagai baris baru di dalam file `data_pendaftar.txt` dengan format CSV.
  - **Kelebihan**: Sangat sederhana, tidak perlu setup database.

\<details\>
\<summary\>Klik untuk melihat kode penyimpanan ke File Teks\</summary\>

```php
<?php
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $file = 'data_pendaftar.txt';
    // ... (logika pengambilan data form) ...
    $dataString = "\"$nama\",\"$alamat\",\"$jenis_kelamin\"...\n";
    $fileHandle = @fopen($file, 'a');
    if ($fileHandle) {
        fwrite($fileHandle, $dataString);
        fclose($fileHandle);
        echo "<h1 class='success'>✅ Pendaftaran Berhasil Disimpan!</h1>";
    } else {
        echo "<h1 class='error'>❌ Terjadi Kesalahan!</h1>";
    }
}
// ...
?>
```

\</details\>

### 2\. Menyimpan ke Database MySQL

  - **Cara Kerja**: Ganti isi `proses_pendaftaran.php` dengan kode yang terhubung ke database dan melakukan `INSERT` query.
  - **Kelebihan**: Lebih terstruktur, aman, dan mudah dikelola untuk data dalam jumlah besar.

\<details\>
\<summary\>Klik untuk melihat kode penyimpanan ke Database\</summary\>

```php
<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "db_kampus";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("<h1 class='error'>Koneksi Gagal</h1><p>Error: " . $conn->connect_error . "</p>");
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // ... (logika pengambilan data form) ...
    $stmt = $conn->prepare("INSERT INTO pendaftar (nama, alamat, ...) VALUES (?, ?, ...)");
    $stmt->bind_param("sssssss", $nama, $alamat, ...);
    
    if ($stmt->execute()) {
        echo "<h1 class='success'>✅ Pendaftaran Berhasil Disimpan!</h1>";
    } else {
        echo "<h1 class='error'>❌ Terjadi Kesalahan!</h1>";
    }
    $stmt->close();
}
$conn->close();
// ...
?>
```

\</details\>
