Rencana Pengembangan Modul Kontrak & Realisasi PLN Office Management

1. Pendahuluan

Modul Kontrak bertujuan untuk mengelola data perjanjian sewa aset/properti PLN. Modul ini akan menyediakan CRUD (Create, Read, Update, Delete), validasi data, integrasi dengan modul Gedung/Kantor, serta fitur pencarian, filter, dan pelaporan.
Selain itu, akan ditambahkan modul Realisasi untuk mencatat kompensasi dalam bentuk pemeliharaan/pembangunan sesuai isi kontrak.

2. Ruang Lingkup Modul

Kontrak

Input, update, dan hapus data kontrak

Status kontrak: baru, berjalan, selesai, amandemen

Relasi dengan Master Data Kantor/Gedung

Pencarian & filter kontrak berdasarkan status, tanggal, pihak, dll

Realisasi

Input realisasi kompensasi (pemeliharaan/pembangunan)

Upload dokumen/berita acara

Relasi dengan kontrak

Laporan

Daftar kontrak aktif dan nonaktif

Daftar realisasi per kontrak

Export data ke PDF/Excel

3. Struktur Database
🔹 Tabel kontrak

| Kolom                     | Tipe Data   | Keterangan                         |
| ------------------------- | ----------- | ---------------------------------- |
| id                        | bigint (PK) | Primary key                        |
| nama\_perjanjian          | string      | Nama kontrak/perjanjian            |
| no\_perjanjian\_pihak1    | string      | Nomor perjanjian pihak I           |
| no\_perjanjian\_pihak2    | string      | Nomor perjanjian pihak II          |
| tanggal\_mulai            | date        | Tanggal mulai kontrak              |
| tanggal\_selesai          | date        | Tanggal akhir kontrak              |
| sbu                       | string      | Unit/SBU terkait                   |
| ruang\_lingkup            | string      | Ruang lingkup kontrak              |
| asset\_owner              | string      | Pemilik aset (PLN ICON Plus/dll)   |
| peruntukan                | enum        | Kantor SBU, Kantor KP, Gudang      |
| alamat                    | text        | Alamat lokasi aset                 |
| status                    | enum        | baru, berjalan, selesai, amandemen |
| gedung\_id                | bigint (FK) | Relasi ke tabel `gedung/kantor`    |
| created\_at / updated\_at | timestamps  | Otomatis dari Laravel              |


Tabel realisasi_kontrak

| Kolom                     | Tipe Data     | Keterangan                         |
| ------------------------- | ------------- | ---------------------------------- |
| id                        | bigint (PK)   | Primary key                        |
| kontrak\_id               | bigint (FK)   | Relasi ke tabel `kontrak`          |
| no\_pihak1                | string        | Nomor pihak 1                      |
| no\_pihak2                | string        | Nomor pihak 2                      |
| tanggal\_realisasi        | date          | Tanggal realisasi kompensasi       |
| jenis\_kompensasi         | enum          | Pemeliharaan, Pembangunan          |
| deskripsi                 | text          | Deskripsi kegiatan realisasi       |
| nilai\_kompensasi         | decimal       | Nilai (Rp) kompensasi              |
| lokasi                    | string        | Lokasi kantor (UIW, UID, UIP, UIT) |
| alamat                    | text          | Alamat lokasi realisasi            |
| dokumen                   | string (file) | Upload dokumen/berita acara        |
| created\_at / updated\_at | timestamps    | Otomatis dari Laravel              |


4. Model

Kontrak.php

Relasi belongsTo ke Gedung

Relasi hasMany ke RealisasiKontrak

RealisasiKontrak.php

Relasi belongsTo ke Kontrak

5. Controller

KontrakController

index() → daftar kontrak

create() → form tambah

store() → simpan kontrak

show($id) → detail kontrak

edit($id) → edit kontrak

update($id) → update kontrak

destroy($id) → hapus kontrak

RealisasiController

index($kontrak_id) → daftar realisasi per kontrak

create($kontrak_id) → form tambah realisasi

store() → simpan realisasi

edit($id) → edit realisasi

update($id) → update realisasi

destroy($id) → hapus realisasi

Views

Folder resources/views/admin/kontrak/

index.blade.php (daftar kontrak)

create.blade.php (form tambah)

edit.blade.php (form edit)

show.blade.php (detail kontrak)

Folder resources/views/admin/realisasi/

index.blade.php (daftar realisasi per kontrak)

create.blade.php (form tambah realisasi)

edit.blade.php (form edit realisasi)