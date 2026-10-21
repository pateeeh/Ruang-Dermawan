# Ruang Dermawan — versi modular awal

Versi ini menggunakan PHP native, HTML, dan CSS biasa. Tidak memakai Tailwind, Bootstrap, atau framework CSS.

## Struktur
- `index.php`: merangkai halaman utama.
- `includes/header.php`: navigasi atas.
- `includes/page-header.php`: header kontekstual dan banner judul untuk halaman layanan serta pembayaran.
- `includes/footer.php`: footer.
- `pages/zakat.php`: pilihan jenis zakat dan kalkulator zakat.
- `pages/fidyah.php`: kalkulator fidyah, informasi umum tentang pihak yang dapat wajib membayar fidyah, contoh niat, dan form data diri.
- `pages/payment.php`: validasi server dan simulasi alur pembayaran berbasis session.
- `includes/transaction.php`: session CSRF dan helper transaksi.
- `sections/`: tiap bagian halaman utama dipisah agar mudah diedit.
- `assets/css/base.css`: fondasi, tokens, header, dan komponen bersama.
- `assets/css/home.css`: slider, section beranda, campaign, dan footer.
- `assets/css/giving.css`: halaman zakat/fidyah, kalkulator, dan informasi fidyah.
- `assets/css/payment.css`: ringkasan serta instruksi pembayaran demo.
- `assets/css/admin.css`: halaman login admin.
- `assets/css/responsive.css`: aturan tablet, ponsel, dan preferensi reduced motion.

## Cara menjalankan
1. Salin folder `ruang-dermawan` ke folder proyek kuliah kamu.
2. Pastikan PHP/Laragon aktif.
3. Buka URL yang sesuai dengan konfigurasi server kamu. Jika folder ini berada di Document Root Laragon, biasanya `http://localhost/ruang-dermawan/`.
4. Jika kamu menyimpan proyek di luar Document Root, jalankan dari terminal di folder proyek:
   `php -S localhost:8000`
   lalu buka `http://localhost:8000`.

## Catatan
- Nilai statistik dan isi campaign masih data contoh, belum terhubung ke database.
- Kalkulator pada `pages/zakat.php` menghitung perkiraan di browser setelah pengguna menekan tombol Hitung. Zakat maal dihitung 2,5% dari jumlah harta yang dimasukkan dikurangi hutang/cicilan; zakat penghasilan dihitung 2,5% dari pendapatan ditambah bonus. Server menghitung ulang nominal sebelum membuat transaksi dan tidak memeriksa nisab atau haul; pengguna perlu mengikuti acuan lembaga zakat.
- Kalkulator pada `pages/fidyah.php` menghitung perkiraan dari jumlah hari dikali tarif per hari yang dimasukkan pengguna. Halaman juga memuat informasi umum kewajiban fidyah dan contoh niat (bukan lafaz wajib); kondisi fikih khusus sebaiknya dikonsultasikan kepada ulama atau lembaga zakat.
- Saat ini form zakat/fidyah menjalankan **mode demo**: server memvalidasi data dan membuat record sementara dalam session dengan bentuk field yang disiapkan agar mudah dipetakan ke tabel `transactions`. Status awal `pending`; tombol “Simulasikan Pembayaran” mengubah status demo ke `success`. Data hanya ada selama session dan tidak tersimpan di database.
- Instruksi Bank Demo dan placeholder QRIS hanya contoh antarmuka. Jangan melakukan transfer atau memindai QR dari mode demo. Untuk mengaktifkan pembayaran sungguhan, ganti penyimpanan session dengan insert PDO pada tabel `transactions`, lalu integrasikan payment gateway atau verifikasi admin sebelum mengubah status menjadi `success`.
- Beberapa link mengarah ke halaman yang belum dibuat (`campaign/index.php` dan `donasi/index.php`). Halaman `pages/login.php` sudah memiliki tampilan form, tetapi autentikasi admin belum dikonfigurasi.
- Gambar memakai URL gambar yang ada pada kode Stitch; koneksi internet dibutuhkan untuk memuat gambar dan Google Fonts/Material Symbols.
- Klaim lembaga/angka legalitas pada desain asli tidak dimasukkan sebagai klaim nyata. Teks demo dibuat lebih netral.
