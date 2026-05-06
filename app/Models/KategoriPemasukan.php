<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriPemasukan extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function pemasukan(): HasMany
    {
        return $this->hasMany(Pemasukan::class);
    }
}
