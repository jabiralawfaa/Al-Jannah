<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('calon_anggota', function (Blueprint $table) {
            $table->id();
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('telepon');
            $table->text('alamat');
            $table->enum('status', ['menunggu_verifikasi', 'disetujui', 'ditolak'])->default('menunggu_verifikasi');
            $table->foreignId('anggota_id')->nullable()->constrained('anggota')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('calon_anggota');
    }
};
