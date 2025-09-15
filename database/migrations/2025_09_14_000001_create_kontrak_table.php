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
        Schema::create('kontraks', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('gedung_id');
            $table->enum('jenis_kontrak', ['Sewa', 'Milik', 'Hibah', 'Layanan']);
            $table->date('periode_mulai');
            $table->date('periode_selesai')->nullable();
            $table->timestamps();

            $table->foreign('gedung_id')->references('id')->on('gedung')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('kontraks');
    }
};
