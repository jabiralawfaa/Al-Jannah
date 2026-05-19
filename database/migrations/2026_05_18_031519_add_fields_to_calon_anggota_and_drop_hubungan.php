<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('calon_anggota', function (Blueprint $table) {
            $table->date('tanggal_lahir')->nullable()->after('email');
            $table->string('jenis_kelamin')->nullable()->after('tanggal_lahir');
            $table->string('rt_rw')->nullable()->after('alamat');
            $table->string('kelurahan')->nullable()->after('rt_rw');
        });

        Schema::table('keluarga_anggota', function (Blueprint $table) {
            $table->dropColumn('hubungan');
        });
    }

    public function down(): void
    {
        Schema::table('calon_anggota', function (Blueprint $table) {
            $table->dropColumn(['tanggal_lahir', 'jenis_kelamin', 'rt_rw', 'kelurahan']);
        });

        Schema::table('keluarga_anggota', function (Blueprint $table) {
            $table->enum('hubungan', ['suami', 'istri', 'anak', 'orang_tua', 'lainnya'])->nullable();
        });
    }
};
