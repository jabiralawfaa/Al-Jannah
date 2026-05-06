<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('anggota', function (Blueprint $table) {
            $table->id();
            $table->string('nomor_anggota')->unique();
            $table->foreignId('calon_anggota_id')->nullable()->constrained('calon_anggota')->onDelete('set null');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('telepon');
            $table->text('alamat');
            $table->enum('status', ['aktif', 'non_aktif'])->default('aktif');
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('anggota');
    }
};
