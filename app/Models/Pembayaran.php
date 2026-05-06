<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pembayaran extends Model
{
    protected $fillable = [
        'tanggal_daftar',
        'calon_anggota_id',
        'nominal_pembayaran',
        'status',
        'file_bukti',
        'verified_by',
        'pemasukan_id',
        'catatan',
    ];

    public function calonAnggota(): BelongsTo
    {
        return $this->belongsTo(CalonAnggota::class);
    }

    public function verifiedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'verified_by');
    }

    public function pemasukan(): BelongsTo
    {
        return $this->belongsTo(Pemasukan::class);
    }
}
