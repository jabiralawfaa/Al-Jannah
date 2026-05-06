<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class StokBarang extends Model
{
    protected $fillable = [
        'kode_barang',
        'nama_barang',
        'stok',
        'stok_minimum',
        'satuan',
        'kategori_barang_id',
        'status',
    ];

    public function kategoriBarang(): BelongsTo
    {
        return $this->belongsTo(KategoriBarang::class);
    }

    public function riwayatBarang(): HasMany
    {
        return $this->hasMany(RiwayatBarang::class, 'referensi_id')
            ->where('tipe_referensi', 'stok_barang');
    }
}
