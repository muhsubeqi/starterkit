<?php

namespace App\Helper;

use Illuminate\Support\Facades\Storage;

class FileStorage
{
    public static function upload($file, $path)
    {
        $image = $file;
        $ext = $file->extension();
        $filename = 'File' . date('YmdHis') . uniqid() . '.' . $ext;
        $image->storeAs($path, $filename);
        return $filename;
    }

    public static function delete($file, $path)
    {
        return Storage::delete($path . $file);
    }
}