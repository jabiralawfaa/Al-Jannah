<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Pemasukan extends Model
{
    protected $table = 'pemasukan';

    protected $fillable = [
        'tanggal',
        'kategori_pemasukan_id',
        'jumlah',
        'keterangan',
        'file_bukti',
        'created_by',
    ];

    public function kategoriPemasukan(): BelongsTo
    {
        return $this->belongsTo(KategoriPemasukan::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function iuranTahunan(): HasMany
    {
        return $this->hasMany(IuranTahunan::class);
    }

    public function pembayaran(): HasMany
    {
        return $this->hasMany(Pembayaran::class);
    }
}
