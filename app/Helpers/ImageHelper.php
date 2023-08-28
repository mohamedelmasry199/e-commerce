<?php

namespace App\Helpers;

class ImageHelper
{
    public static function transformImagePath($path)
    {
        // Remove the "public" segment if found
        $path = str_replace('public/', '', $path);

        // Replace backslashes with forward slashes
        $path = str_replace('\\', '/', $path);

        return $path;
    }
}

