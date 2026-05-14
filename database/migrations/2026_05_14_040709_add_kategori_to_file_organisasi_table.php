<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('file_organisasi', function (Blueprint $table) {
            $table->enum('kategori', ['diterima', 'mencurigakan', 'ditolak'])
                ->default('diterima')
                ->after('status');
        });
    }

    public function down(): void
    {
        Schema::table('file_organisasi', function (Blueprint $table) {
            $table->dropColumn('kategori');
        });
    }
};
