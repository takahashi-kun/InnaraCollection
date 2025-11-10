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
            $table->json('details_json')->comment('Menyimpan detail kustomisasi kaos');

            $table->string('invoice_number')->nullable(); // Invoice number dibuat saat checkout
            $table->decimal('total_harga', 10, 2); // Harga per item (harga kustomisasi kaos)
            $table->integer('qty');
            $table->enum('status', [
                'pending',
                'diproses',
                'dalam_produksi',
                'dikirim',
                'selesai',
                'dibatalkan'
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
