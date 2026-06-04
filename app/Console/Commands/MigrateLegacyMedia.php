<?php

namespace App\Console\Commands;

use App\Models\FileOrganisasi;
use App\Models\Menu;
use App\Models\Page;
use App\Models\Post;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

class MigrateLegacyMedia extends Command
{
    protected $signature = 'media:migrate-legacy';
    protected $description = 'Migrate legacy media records (media_legacy table) to Spatie MediaLibrary';

    public function handle(): int
    {
        $this->info('Migrating legacy Post thumbnails...');
        $this->migratePosts();

        $this->info('Migrating legacy Page images...');
        $this->migratePages();

        $this->info('Migrating legacy Menu icons...');
        $this->migrateMenus();

        $this->info('Migrating legacy FileOrganisasi files...');
        $this->migrateFileOrganisasi();

        $this->newLine();
        $this->info('All legacy media migrated successfully.');
        $this->warn('Run "php artisan media:cleanup-legacy" after verifying everything works.');

        return Command::SUCCESS;
    }

    private function migratePosts(): void
    {
        $disk = Storage::disk('local');
        $migrated = 0;
        $skipped = 0;

        Post::with('legacyMedia')->chunk(50, function ($posts) use ($disk, &$migrated, &$skipped) {
            foreach ($posts as $post) {
                if ($post->getFirstMedia('thumbnails')) {
                    $skipped++;
                    continue;
                }
                if (!$post->legacyMedia) {
                    continue;
                }
                $legacy = $post->legacyMedia;
                if (!$disk->exists($legacy->file_path)) {
                    $this->warn("  File not found: {$legacy->file_path}");
                    continue;
                }
                $fullPath = $disk->path($legacy->file_path);
                $post->addMedia($fullPath)
                    ->usingFileName($legacy->file_name)
                    ->preservingOriginal()
                    ->toMediaCollection('thumbnails');
                $migrated++;
            }
        });

        $this->line("  Posts: {$migrated} migrated, {$skipped} already have Spatie media.");
    }

    private function migratePages(): void
    {
        $disk = Storage::disk('local');
        $migrated = 0;
        $skipped = 0;

        Page::with('legacyMedia')->chunk(50, function ($pages) use ($disk, &$migrated, &$skipped) {
            foreach ($pages as $page) {
                if ($page->getFirstMedia('images')) {
                    $skipped++;
                    continue;
                }
                if (!$page->legacyMedia) {
                    continue;
                }
                $legacy = $page->legacyMedia;
                if (!$disk->exists($legacy->file_path)) {
                    $this->warn("  File not found: {$legacy->file_path}");
                    continue;
                }
                $fullPath = $disk->path($legacy->file_path);
                $page->addMedia($fullPath)
                    ->usingFileName($legacy->file_name)
                    ->preservingOriginal()
                    ->toMediaCollection('images');
                $migrated++;
            }
        });

        $this->line("  Pages: {$migrated} migrated, {$skipped} already have Spatie media.");
    }

    private function migrateMenus(): void
    {
        $disk = Storage::disk('local');
        $migrated = 0;
        $skipped = 0;

        Menu::with('legacyMedia')->chunk(50, function ($menus) use ($disk, &$migrated, &$skipped) {
            foreach ($menus as $menu) {
                if ($menu->getFirstMedia('icons')) {
                    $skipped++;
                    continue;
                }
                if (!$menu->legacyMedia) {
                    continue;
                }
                $legacy = $menu->legacyMedia;
                if (!$disk->exists($legacy->file_path)) {
                    $this->warn("  File not found: {$legacy->file_path}");
                    continue;
                }
                $fullPath = $disk->path($legacy->file_path);
                $menu->addMedia($fullPath)
                    ->usingFileName($legacy->file_name)
                    ->preservingOriginal()
                    ->toMediaCollection('icons');
                $migrated++;
            }
        });

        $this->line("  Menus: {$migrated} migrated, {$skipped} already have Spatie media.");
    }

    private function migrateFileOrganisasi(): void
    {
        $disks = [
            'diterima' => 'file_diterima',
            'mencurigakan' => 'file_mencurigakan',
            'ditolak' => 'file_ditolak',
        ];
        $migrated = 0;
        $skipped = 0;

        FileOrganisasi::chunk(50, function ($files) use ($disks, &$migrated, &$skipped) {
            foreach ($files as $file) {
                if ($file->getFirstMedia('uploads')) {
                    $skipped++;
                    continue;
                }
                if (blank($file->file_path)) {
                    continue;
                }
                $diskName = $disks[$file->kategori] ?? 'file_diterima';
                $disk = Storage::disk($diskName);
                if (!$disk->exists($file->file_path)) {
                    $this->warn("  File not found: {$diskName}/{$file->file_path}");
                    continue;
                }
                $fullPath = $disk->path($file->file_path);
                $file->addMedia($fullPath)
                    ->usingFileName($file->nama_file)
                    ->preservingOriginal()
                    ->toMediaCollection('uploads');
                $migrated++;
            }
        });

        $this->line("  FileOrganisasi: {$migrated} migrated, {$skipped} already have Spatie media.");
    }
}
