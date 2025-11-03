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
        Schema::create('alamat_users', function (Blueprint $table) {
            $table->id('id_alamat_user');
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('province_id')->constrained('provinces','province_id')->onDelete('cascade');
            $table->foreignId('city_id')->constrained('cities','city_id')->onDelete('cascade');
            $table->foreignId('subdistrict_id')->constrained('subdistricts','subdistrict_id')->onDelete('cascade');
            $table->string('alamat_lengkap');
            $table->string('nama_penerima');
            $table->string('no_tlp');
            $table->string('nama_alamat');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('alamat_users');
    }
};
