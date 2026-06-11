<?php

namespace App\Console\Commands;

use App\Models\Anggota;
use Illuminate\Console\Command;

class ClearExpiredAccessCodes extends Command
{
    protected $signature = 'anggota:clear-expired-codes';
    protected $description = 'Clear access codes that are older than 1 day';

    public function handle()
    {
        $count = Anggota::whereNotNull('access_code')
            ->where('access_code_generated_at', '<', now()->subDay())
            ->update([
                'access_code' => null,
                'access_code_generated_at' => null,
            ]);

        $this->info("Cleared {$count} expired access codes.");
    }
}
