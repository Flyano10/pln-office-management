<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRealisasiKontrakTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('realisasi_kontraks', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kontrak_id')->constrained('kontraks')->onDelete('cascade');
            $table->string('no_pihak1');
            $table->string('no_pihak2');
            $table->date('tanggal_realisasi');
            $table->enum('jenis_kompensasi', ['Pemeliharaan', 'Pembangunan']);
            $table->text('deskripsi');
            $table->decimal('nilai_kompensasi', 15, 2);
            $table->enum('lokasi', ['UIW', 'UID', 'UIP', 'UIT']);
            $table->text('alamat');
            $table->string('dokumen')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('realisasi_kontraks');
    }
}
