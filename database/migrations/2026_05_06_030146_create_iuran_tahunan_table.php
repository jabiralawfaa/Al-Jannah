<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('iuran_tahunan', function (Blueprint $table) {
            $table->id();
            $table->year('tahun');
            $table->foreignId('anggota_id')->constrained('anggota')->onDelete('cascade');
            $table->integer('bulan');
            $table->decimal('nominal', 15, 2);
            $table->enum('status', ['lunas', 'belum_lunas'])->default('belum_lunas');
            $table->date('tanggal_bayar')->nullable();
            $table->string('file_bukti')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('pemasukan_id')->nullable()->constrained('pemasukan')->onDelete('set null');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('iuran_tahunan');
    }
};
