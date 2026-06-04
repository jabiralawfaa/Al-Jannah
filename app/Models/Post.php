<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media as SpatieMedia;

class Post extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $fillable = [
        'title',
        'slug',
        'content',
        'media_id',
        'status',
        'published_at',
        'category_id',
    ];

    protected $casts = [
        'published_at' => 'datetime',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(Category::class);
    }

    public function legacyMedia(): BelongsTo
    {
        return $this->belongsTo(Media::class);
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('thumbnails')
            ->singleFile();
    }

    public function getThumbnailUrl(): ?string
    {
        $spatieMedia = $this->getFirstMedia('thumbnails');
        if ($spatieMedia) {
            return route('media.spatie', $spatieMedia->id);
        }
        if ($this->relationLoaded('legacyMedia') && $this->legacyMedia) {
            return route('media.download', $this->legacyMedia);
        }
        return null;
    }
}
