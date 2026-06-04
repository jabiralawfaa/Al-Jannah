<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class FileOrganisasi extends Model implements HasMedia
{
    use InteractsWithMedia;

    protected $table = 'file_organisasi';

    protected $fillable = [
        'nama_file',
        'file_path',
        'kategori',
        'status',
        'uploaded_by',
    ];

    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }

    public function registerMediaCollections(): void
    {
        $this->addMediaCollection('uploads')
            ->singleFile();
    }

    public function getDownloadUrl(): ?string
    {
        $spatieMedia = $this->getFirstMedia('uploads');
        if ($spatieMedia) {
            return route('media.download', $spatieMedia->id);
        }
        if ($this->file_path) {
            return route('file.download', $this);
        }
        return null;
    }
}
