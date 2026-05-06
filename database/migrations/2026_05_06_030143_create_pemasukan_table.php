<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pemasukan', function (Blueprint $table) {
            $table->id();
            $table->date('tanggal');
            $table->foreignId('kategori_pemasukan_id')->constrained('kategori_pemasukan')->onDelete('cascade');
            $table->decimal('jumlah', 15, 2);
            $table->string('keterangan')->nullable();
            $table->string('file_bukti')->nullable();
            $table->foreignId('created_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pemasukan');
    }
};
