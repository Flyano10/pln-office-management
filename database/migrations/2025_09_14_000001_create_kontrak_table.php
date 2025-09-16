<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKontrakTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('kontraks', function (Blueprint $table) {
            $table->id();
            $table->string('nama_perjanjian');
            $table->string('no_perjanjian_pihak1');
            $table->string('no_perjanjian_pihak2');
            $table->date('tanggal_mulai');
            $table->date('tanggal_selesai');
            $table->string('sbu');
            $table->string('ruang_lingkup');
            $table->string('asset_owner');
            $table->enum('peruntukan', ['Kantor SBU', 'Kantor KP', 'Gudang']);
            $table->text('alamat');
            $table->enum('status', ['baru', 'berjalan', 'selesai', 'amandemen']);
            $table->foreignId('gedung_id')->constrained('gedungs')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontraks');
    }
}
