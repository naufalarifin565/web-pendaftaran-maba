document.addEventListener('DOMContentLoaded', function() {
    const form = document.getElementById('registrationForm');

    form.addEventListener('submit', function(event) {
        // Mencegah form dikirim secara langsung
        event.preventDefault();

        // Mengambil nilai dari setiap input
        const nama = document.getElementById('nama').value.trim();
        const alamat = document.getElementById('alamat').value.trim();
        const jenisKelamin = document.querySelector('input[name="jenis_kelamin"]:checked');
        const agama = document.getElementById('agama').value;
        const asalSekolah = document.getElementById('asal_sekolah').value.trim();
        const email = document.getElementById('email').value.trim();
        const noTelepon = document.getElementById('no_telepon').value.trim();
        
        // Validasi Sederhana
        if (!nama || !alamat || !jenisKelamin || !agama || !asalSekolah || !email || !noTelepon) {
            alert('Semua kolom wajib diisi!');
            return;
        }

        if (!validateEmail(email)) {
            alert('Format email tidak valid!');
            return;
        }

        if (!validatePhone(noTelepon)) {
            alert('Nomor telepon hanya boleh berisi angka!');
            return;
        }

        // Jika semua validasi lolos, kirim form
        alert('Validasi berhasil! Mengirim data...');
        form.submit();
    });

    function validateEmail(email) {
        const re = /^[a-zA-Z0-9._-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,6}$/;
        return re.test(String(email).toLowerCase());
    }

    function validatePhone(phone) {
        const re = /^[0-9]+$/;
        return re.test(phone);
    }
});