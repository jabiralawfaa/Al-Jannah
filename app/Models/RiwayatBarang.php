<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphTo;

class RiwayatBarang extends Model
{
    protected $fillable = [
        'waktu',
        'tipe',
        'tipe_referensi',
        'referensi_id',
        'jumlah',
        'keterangan',
        'user_id',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function referensi(): MorphTo
    {
        return $this->morphTo(__FUNCTION__, 'tipe_referensi', 'referensi_id');
    }
}
