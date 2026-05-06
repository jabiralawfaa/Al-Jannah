<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('file_organisasi', function (Blueprint $table) {
            $table->id();
            $table->string('nama_file');
            $table->string('file_path');
            $table->enum('status', ['aktif', 'diperiksa', 'arsip', 'dihapus'])->default('aktif');
            $table->foreignId('uploaded_by')->constrained('users')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('file_organisasi');
    }
};
