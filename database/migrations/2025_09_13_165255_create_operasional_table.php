<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('operasional', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('kantor_id');
            $table->integer('jumlah_pegawai');
            $table->string('divisi_departemen');
            $table->string('pic_nama');
            $table->string('nomor_kontak');
            $table->string('jam_operasional');
            $table->json('keamanan');
            $table->text('catatan_tambahan')->nullable();
            $table->timestamps();

            $table->foreign('kantor_id')->references('id')->on('pln_offices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('operasional');
    }
};
