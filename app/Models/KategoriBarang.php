<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class KategoriBarang extends Model
{
    protected $fillable = [
        'nama',
        'deskripsi',
    ];

    public function stokBarang(): HasMany
    {
        return $this->hasMany(StokBarang::class);
    }
}
