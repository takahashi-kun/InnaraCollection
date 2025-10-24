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
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('id_produk')->constrained('products','id_produk')->onDelete('cascade');
            $table->string('invoice_number')->unique();
            $table->decimal('total_harga', 10, 2);
            $table->integer('qty');
            $table->enum('status', [
                'pending', 'diproses', 'dalam_produksi', 'dikirim', 'selesai', 'dibatalkan'
            ])->default('pending');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};
