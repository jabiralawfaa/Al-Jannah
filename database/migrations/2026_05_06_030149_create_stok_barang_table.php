<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('stok_barang', function (Blueprint $table) {
            $table->id();
            $table->string('kode_barang')->unique();
            $table->string('nama_barang');
            $table->integer('stok');
            $table->integer('stok_minimum');
            $table->string('satuan');
            $table->foreignId('kategori_barang_id')->constrained('kategori_barang')->onDelete('cascade');
            $table->enum('status', ['tersedia', 'habis'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('stok_barang');
    }
};
