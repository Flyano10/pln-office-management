
<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlnOfficesTable extends Migration
{
    public function up()
    {
        Schema::create('pln_offices', function (Blueprint $table) {
            $table->id();
            $table->string('office_id')->unique(); // ID Kantor
            $table->string('office_name'); // Nama Kantor
            $table->text('address'); // Alamat Lokasi
            $table->string('city'); // Kota
            $table->string('province'); // Provinsi
            $table->enum('office_type', [
                'kantor_pusat',
                'sbu_sumatera_utara',
                'sbu_sumatera_tengah',
                'sbu_sumatera_selatan',
                'sbu_jakarta_banteng',
                'perwakilan_banda_aceh'
            ]); // Jenis Kantor
            $table->string('parent_office')->nullable(); // Parent Kantor
            $table->decimal('building_area', 10, 2); // Luas Bangunan (m²)
            $table->integer('floor_count'); // Jumlah Lantai
            $table->integer('room_count'); // Jumlah Ruangan
            $table->integer('employee_count'); // Jumlah Pegawai
            $table->string('division_department'); // Divisi/Departemen
            $table->json('main_facilities'); // Fasilitas Utama (Listrik, Internet, Parkir, dll)
            $table->enum('building_status', ['owned', 'rented', 'shared']); // Status Gedung
            $table->date('contract_start')->nullable(); // Periode Kontrak Mulai
            $table->date('contract_end')->nullable(); // Periode Kontrak Berakhir
            $table->string('pic_name'); // PIC/Penanggung Jawab
            $table->string('contact_number'); // Nomor Kontak
            $table->string('operating_hours'); // Jam Operasional
            $table->json('security_features'); // Keamanan (CCTV, Security, Akses)
            $table->text('additional_notes')->nullable(); // Catatan Tambahan
            $table->string('photo_path')->nullable(); // Foto
            $table->decimal('latitude', 10, 8); // Latitude
            $table->decimal('longitude', 11, 8); // Longitude
            $table->decimal('rating', 2, 1)->default(0); // Rating (0-5)
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pln_offices');
    }
}
