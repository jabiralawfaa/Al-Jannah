<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Schema;

class CleanupLegacyMedia extends Command
{
    protected $signature = 'media:cleanup-legacy';
    protected $description = 'Remove legacy media_legacy table and cleanup stale references';

    public function handle(): int
    {
        if (!$this->confirm('This will DROP the media_legacy table. Are you sure?')) {
            return Command::FAILURE;
        }

        Schema::table('posts', function ($table) {
            $table->dropForeign(['media_id']);
            $table->dropColumn('media_id');
        });

        Schema::table('pages', function ($table) {
            $table->dropForeign(['media_id']);
            $table->dropColumn('media_id');
        });

        Schema::table('menus', function ($table) {
            $table->dropForeign(['media_id']);
            $table->dropColumn('media_id');
        });

        Schema::dropIfExists('media_legacy');

        $this->info('Legacy media_legacy table dropped.');
        $this->warn('Remove App\Models\Media manually if no longer needed.');

        return Command::SUCCESS;
    }
}
