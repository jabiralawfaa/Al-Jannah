<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriAset extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function asetKendaraan(): HasMany
    {
        return $this->hasMany(AsetKendaraan::class);
    }
}
