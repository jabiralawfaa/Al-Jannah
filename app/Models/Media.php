<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Media extends Model
{
    protected $fillable = [
        'file_name',
        'file_path',
        'mime_type',
        'file_size',
        'dimensions',
        'alt_text',
    ];

    protected $casts = [
        'file_size' => 'integer',
    ];

    public function posts(): HasMany
    {
        return $this->hasMany(Post::class);
    }

    public function pages(): HasMany
    {
        return $this->hasMany(Page::class);
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }
}
