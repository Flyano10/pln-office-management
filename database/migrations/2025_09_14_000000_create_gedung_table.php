<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGedungTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('gedung', function (Blueprint $table) {
            $table->id();
            $table->foreignId('kantor_id')->constrained('pln_offices')->onDelete('cascade');
            $table->decimal('luas_bangunan', 10, 2);
            $table->integer('jumlah_lantai');
            $table->integer('jumlah_ruangan');
            $table->text('fasilitas_utama')->nullable();
            $table->enum('status_gedung', ['Milik', 'Sewa', 'Hibah']);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('gedung');
    }
}
