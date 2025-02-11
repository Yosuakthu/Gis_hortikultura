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
            $table->string('fid_garisp')->nullable();
            $table->string('fid_zona_l')->nullable();
            $table->integer('objectid')->nullable();
            $table->string('jenis_zona')->nullable();
            $table->string('shape_leng')->nullable();
            $table->string('shape_area')->nullable();
            $table->string('pstddev')->nullable();
            $table->string('stddev')->nullable();
            $table->string('mean')->nullable();
            $table->integer('count')->nullable();
            $table->integer('min')->nullable();
            $table->integer('max')->nullable();
            $table->string('nozone')->nullable();
            $table->string('rpbulat')->nullable();
            $table->string('sum_nilai')->nullable();
            $table->string('range_nila')->nullable();
            $table->string('rpbulat_1')->nullable();
            $table->string('sum_nilai1')->nullable();
            $table->string('range_ni_1')->nullable();
            $table->string('rp_1')->nullable();
            $table->string('rp_2')->nullable();
            $table->text('geometry')->nullable();
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
