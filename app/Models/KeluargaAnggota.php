<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class KeluargaAnggota extends Model
{
    protected $table = 'keluarga_anggota';

    protected $fillable = [
        'calon_anggota_id',
        'nama',
        'hubungan',
        'jenis_kelamin',
        'tanggal_lahir',
    ];

    public function calonAnggota(): BelongsTo
    {
        return $this->belongsTo(CalonAnggota::class);
    }
}
