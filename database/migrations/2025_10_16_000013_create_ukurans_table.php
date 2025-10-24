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
        Schema::create('ukurans', function (Blueprint $table) {
            $table->id('id_ukuran');
            $table->enum('ukuran', ['S', 'M', 'L', 'XL', 'XXL','XXXL']);
            $table->double('harga_ukuran');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('ukurans');
    }
};
