<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FileOrganisasi extends Model
{
    protected $table = 'file_organisasi';

    protected $fillable = [
        'nama_file',
        'file_path',
        'status',
        'uploaded_by',
    ];

    public function uploadedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
