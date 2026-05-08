<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PermintaanIzin extends Model
{
    protected $table = 'permintaan_izin';

    protected $fillable = [
        'user_id',
        'approved_by',
        'target_table',
        'target_id',
        'field_name',
        'old_value',
        'new_value',
        'alasan',
        'status',
        'approved_at',
    ];

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function approvedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by');
    }
}
