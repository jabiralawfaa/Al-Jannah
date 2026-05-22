<?php

namespace App\Services;

class FileRenamer
{
    public static function rename(string $originalName): string
    {
        $salt = env('FILE_SALT', 'al-jannah-default-salt');
        $extension = strtolower(pathinfo($originalName, PATHINFO_EXTENSION));
        $basename = pathinfo($originalName, PATHINFO_FILENAME);
        $hash = substr(hash('sha256', $salt . $basename . microtime(true) . random_bytes(16)), 0, 16);

        return $hash . '.' . $extension;
    }
}
