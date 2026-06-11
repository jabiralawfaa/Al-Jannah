<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Anggota extends Model
{
    protected $table = 'anggota';

    protected $fillable = [
        'nomor_anggota',
        'calon_anggota_id',
        'nama',
        'email',
        'telepon',
        'alamat',
        'status',
        'tanggal_aktif_kembali',
        'access_code',
        'created_by',
    ];

    public function calonAnggota(): BelongsTo
    {
        return $this->belongsTo(CalonAnggota::class);
    }

    public function createdBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function iuranTahunan(): HasMany
    {
        return $this->hasMany(IuranTahunan::class);
    }
}
