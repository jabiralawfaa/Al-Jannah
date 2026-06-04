<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class Page extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'media_id',
        'status',
        'published_at',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function legacyMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function menus(): HasMany
    {
        return $this->hasMany(Menu::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('images');
    }

    public function getFirstImageUrl(): ?string
    {
        $spatieMedia = $this->getFirstMedia('images');
        if ($spatieMedia) {
            return route('media.spatie', $spatieMedia->id);
        }
        if ($this->relationLoaded('legacyMedia') && $this->legacyMedia) {
            return route('media.download', $this->legacyMedia);
        }
        return null;
    }
}
