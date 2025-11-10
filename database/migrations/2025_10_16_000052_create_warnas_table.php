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
        Schema::create('warnas', function (Blueprint $table) {
            $table->id('id_warna');
            $table->foreignId('id_ukuran')->constrained('ukurans','id_ukuran')->onDelete('cascade');
            $table->string('nama_warna');
            $table->string('kode_hex');
            $table->double('harga_warna');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('warnas');
    }
};
