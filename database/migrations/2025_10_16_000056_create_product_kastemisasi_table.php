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
        Schema::create('product_kastemisasi', function (Blueprint $table) {
            $table->id('id_kastemisasi');
            $table->foreignId('id_produk')->constrained('products', 'id_produk')->onDelete('cascade');
            $table->foreignId('id_bahan')->constrained('bahans','id_bahan')->onDelete('cascade');
            $table->foreignId('id_ukuran')->constrained('ukurans','id_ukuran')->onDelete('cascade');
            $table->foreignId('id_sablon')->constrained('sablons','id_sablon')->onDelete('cascade');
            $table->foreignId('id_warna')->constrained('warnas','id_warna')->onDelete('cascade');
            $table->double('total_harga_tambahan');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_kastemisasi');
    }
};
