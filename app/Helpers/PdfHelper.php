<?php

namespace App\Helpers;

class PdfHelper
{
    public static function sanitizeFileName($fileName)
    {
        return str_replace(' ', '_', $fileName);
    }
}
