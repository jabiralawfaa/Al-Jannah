<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class Menu extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'label',
        'parent_id',
        'sort_order',
        'is_active',
        'page_id',
        'media_id',
        'custom_url',
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Menu::class, 'parent_id');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function legacyMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('icons')
            ->singleFile();
    }

    public function getIconUrl(): ?string
    {
        $spatieMedia = $this->getFirstMedia('icons');
        if ($spatieMedia) {
            return route('media.spatie', $spatieMedia->id);
        }
        if ($this->relationLoaded('legacyMedia') && $this->legacyMedia) {
            return route('media.download', $this->legacyMedia);
        }
        return null;
    }
}
