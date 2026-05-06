<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('riwayat_barang', function (Blueprint $table) {
            $table->id();
            $table->dateTime('waktu');
            $table->enum('tipe', ['masuk', 'keluar', 'dipinjam', 'dikembalikan']);
            $table->enum('tipe_referensi', ['stok_barang', 'aset_kendaraan']);
            $table->unsignedBigInteger('referensi_id');
            $table->integer('jumlah')->nullable();
            $table->string('keterangan')->nullable();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('riwayat_barang');
    }
};
