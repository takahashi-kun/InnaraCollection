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
        Schema::create('sablons', function (Blueprint $table) {
            $table->id('id_sablon');
            $table->string('nama_sablon');
            $table->enum('ukuran_sablon',['kecil','sedang','besar']);
            $table->string('gambar_sablon');
            $table->double('harga_sablon');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sablons');
    }
};
