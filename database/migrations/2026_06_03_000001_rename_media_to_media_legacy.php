<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['media_id']);
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeign(['media_id']);
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign(['media_id']);
        });

        Schema::rename('media', 'media_legacy');

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('media_id')->references('id')->on('media_legacy')->onDelete('set null');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->foreign('media_id')->references('id')->on('media_legacy')->onDelete('set null');
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->foreign('media_id')->references('id')->on('media_legacy')->onDelete('set null');
        });
    }

    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['media_id']);
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropForeign(['media_id']);
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->dropForeign(['media_id']);
        });

        Schema::rename('media_legacy', 'media');

        Schema::table('posts', function (Blueprint $table) {
            $table->foreign('media_id')->references('id')->on('media')->onDelete('set null');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->foreign('media_id')->references('id')->on('media')->onDelete('set null');
        });

        Schema::table('menus', function (Blueprint $table) {
            $table->foreign('media_id')->references('id')->on('media')->onDelete('set null');
        });
    }
};
