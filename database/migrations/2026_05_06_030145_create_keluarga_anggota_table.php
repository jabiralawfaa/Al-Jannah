<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('keluarga_anggota', function (Blueprint $table) {
            $table->id();
            $table->foreignId('calon_anggota_id')->constrained('calon_anggota')->onDelete('cascade');
            $table->string('nama');
            $table->enum('hubungan', ['suami', 'istri', 'anak', 'orang_tua', 'lainnya']);
            $table->enum('jenis_kelamin', ['laki-laki', 'perempuan']);
            $table->date('tanggal_lahir');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('keluarga_anggota');
    }
};
