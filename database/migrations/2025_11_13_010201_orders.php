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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('status')->default('pending');
            $table->timestamp('delivered_at')->nullable()->after('status');
            $table->decimal('subtotal', 16, 2)->default(0);
            $table->decimal('shipping', 16, 2)->default(0);
            $table->decimal('total', 16, 2)->default(0);
            $table->string('payment_method')->nullable();
            $table->text('shipping_address')->nullable();
            $table->string('snap_token')->nullable();
            $table->string('invoice_number')->unique()->after('shipping_address');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('orders', function (Blueprint $table) {
            $table->dropColumn('invoice_number');
            $table->dropColumn('delivered_at');
        });
    }
};
