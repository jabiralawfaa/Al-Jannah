<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('aset_kendaraan', function (Blueprint $table) {
            $table->id();
            $table->string('kode_aset')->unique();
            $table->string('nama_aset');
            $table->string('nomor_plat_seri')->nullable();
            $table->foreignId('kategori_aset_id')->constrained('kategori_aset')->onDelete('cascade');
            $table->enum('status', ['tersedia', 'dipinjam', 'rusak', 'dihapus'])->default('tersedia');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('aset_kendaraan');
    }
};
