<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Pengeluaran extends Model
{
    protected $fillable = [
        'tanggal',
        'kategori_pengeluaran_id',
        'jumlah',
        'keterangan',
        'file_bukti',
        'created_by',
    ];

    public function kategoriPengeluaran(): BelongsTo
    {
        return $this->belongsTo(KategoriPengeluaran::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
