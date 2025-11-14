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
            $table->foreignId('id_bahan')->constrained('bahans', 'id_bahan')->onDelete('cascade');
            $table->foreignId('id_ukuran')->constrained('ukurans', 'id_ukuran')->onDelete('cascade');
            $table->foreignId('id_sablon')->constrained('sablons', 'id_sablon')->onDelete('cascade');
            $table->foreignId('id_warna')->constrained('warnas', 'id_warna')->onDelete('cascade');
            $table->string('nama')->nullable();
            $table->decimal('harga_jual', 15, 2)->default(0);
            $table->json('meta')->nullable();
            if (Schema::hasColumn('product_kastemisasi', 'total_harga_tambahan')) {
                $table->decimal('total_harga_tambahan', 15, 2)->default(0)->nullable()->change();
            }
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('product_kastemisasi', function (Blueprint $table) {
            $table->decimal('total_harga_tambahan', 15, 2)->nullable(false)->change();
        });
        Schema::dropIfExists('product_kastemisasi');
    }
};
