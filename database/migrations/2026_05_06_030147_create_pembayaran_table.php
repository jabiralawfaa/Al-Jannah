<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pembayaran', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal_daftar');
            $table->foreignId('calon_anggota_id')->constrained('calon_anggota')->onDelete('cascade');
            $table->decimal('nominal_pembayaran', 15, 2);
            $table->enum('status', ['belum_lunas', 'sudah_dibayar'])->default('belum_lunas');
            $table->string('file_bukti')->nullable();
            $table->foreignId('verified_by')->nullable()->constrained('users')->onDelete('set null');
            $table->foreignId('pemasukan_id')->nullable()->constrained('pemasukan')->onDelete('set null');
            $table->text('catatan')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pembayaran');
    }
};
