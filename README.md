# Sistem Informasi Manajemen Kantor PLN

Aplikasi web ini dikembangkan untuk memfasilitasi pengelolaan data kantor, aset, dan properti PLN secara terintegrasi. Sistem ini mendukung monitoring, visualisasi peta, dashboard analitik, dan pelaporan untuk meningkatkan efisiensi operasional dan pengambilan keputusan strategis.

## Fitur Utama

- Manajemen data kantor PLN dengan informasi lengkap dan terstruktur.
- Visualisasi geografis lokasi kantor menggunakan peta interaktif.
- Dashboard statistik dan analitik untuk monitoring kinerja.
- Modul laporan untuk export dan reporting data.
- Sistem pencarian canggih untuk memudahkan akses data.
- Dukungan pengguna dengan fitur bantuan dan kontak support.

## Teknologi

- Backend: Laravel Framework
- Frontend: Blade Templates, Bootstrap 5, FontAwesome
- Database: MySQL (dengan migrasi dan seeder)
- Peta: Integrasi peta interaktif untuk visualisasi lokasi

## Instalasi

1. Clone repository ini
2. Jalankan `composer install` untuk menginstal dependensi PHP
3. Salin file `.env.example` menjadi `.env` dan sesuaikan konfigurasi database
4. Jalankan migrasi dan seeder dengan perintah:
   ```
   php artisan migrate --seed
   ```
5. Jalankan server development:
   ```
   php artisan serve
   ```
6. Akses aplikasi di `http://localhost:8000`

## Kontribusi

Kontribusi sangat diterima. Silakan buat pull request untuk fitur baru atau perbaikan bug.

## Lisensi

MIT License

---

Dikembangkan oleh Rafly Juliano
