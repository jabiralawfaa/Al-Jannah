<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class IuranTahunan extends Model
{
    protected $table = 'iuran_tahunan';

    protected $fillable = [
        'tahun',
        'anggota_id',
        'bulan',
        'nominal',
        'status',
        'tanggal_bayar',
        'file_bukti',
        'verified_by',
        'pemasukan_id',
    ];

    public function anggota(): BelongsTo
    {
        return $this->belongsTo(Anggota::class);
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
