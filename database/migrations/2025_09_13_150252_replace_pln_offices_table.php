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
        Schema::dropIfExists('pln_offices');

        Schema::create('pln_offices', function (Blueprint $table) {
            $table->id();
            $table->string('office_id')->unique(); // ID Kantor
            $table->string('office_name'); // Nama Kantor
            $table->text('address'); // Alamat / Lokasi
            $table->string('city'); // Kota
            $table->string('province'); // Provinsi
            $table->enum('office_type', ['Pusat', 'SBU', 'KP']); // Jenis Kantor
            $table->unsignedBigInteger('parent_office')->nullable(); // Parent_Kantor (FK ke kantor lain)
            $table->foreign('parent_office')->references('id')->on('pln_offices')->onDelete('set null');
            $table->decimal('latitude', 10, 8); // Lat
            $table->decimal('longitude', 11, 8); // Long
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pln_offices');
    }
};
