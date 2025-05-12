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
        Schema::create('geo_data', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('tanaman');
            $table->string('lokasi');
            $table->decimal('luas', 10, 2)->nullable();
            $table->integer('elevasi')->nullable();
            $table->string('no_hp')->nullable();
            $table->string('kelompok')->nullable();
            $table->string('leader')->nullable();
            $table->string('no_leader')->nullable();
            $table->string('al_leader')->nullable();
            $table->string('komoditi');
            $table->string('varietas');
            $table->integer('jumb_bibit')->nullable();
            $table->string('geojson_path');
            // Tambahkan kolom lain sesuai kebutuhan
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('geo_data');
    }
};
