<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class AsetKendaraan extends Model
{
    protected $table = 'aset_kendaraan';

    protected $fillable = [
        'kode_aset',
        'nama_aset',
        'nomor_plat_seri',
        'kategori_aset_id',
        'status',
        'kondisi',
    ];

    public function kategoriAset(): BelongsTo
    {
        return $this->belongsTo(KategoriAset::class);
    }

    public function riwayatBarang(): HasMany
    {
        return $this->hasMany(RiwayatBarang::class, 'referensi_id')
            ->where('tipe_referensi', 'aset_kendaraan');
    }
}
