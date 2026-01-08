<?php

namespace App\Traits;

use Illuminate\Http\UploadedFile;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\File;

trait FileUploadTrait
{
    public function uploadFile(UploadedFile $file, ?string $oldPath = null, ?string $path = 'uploads'): ?string
    {
        if (!$file->isValid()) {
            return null;
        }

        $ignorePath = ['/default/avatar.png', '/defaults/banner.png', '/defaults/shop.png'];

        if ($oldPath && File::exists(public_path($oldPath)) && !in_array($oldPath, $ignorePath)) {
            File::delete(public_path($oldPath));
        }

        // $folderPath = public_path($path);

        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $file->storeAs($path, $filename, 'public');

        $filepath = $path . '/' . $filename;

        return $filepath;
    }

    public function uploadPrivateFile(UploadedFile $file, ?string $oldPath = null, ?string $path = 'uploads'): ?string
    {
        if (!$file->isValid()) {
            return null;
        }

        // $ignorePath = ['/default/avatar.png'];

        // if ($oldPath && File::exists(public_path($oldPath)) && !in_array($oldPath, $ignorePath)) {
        //     File::delete(public_path($oldPath));
        // }

        $filename = Str::uuid() . '.' . $file->getClientOriginalExtension();

        $path = $file->storeAs($path, $filename, 'local');

        return $path;
    }


    function deleteFile(string $path): bool
    {
        if (File::exists(public_path($path))) {
            File::delete(public_path($path));

            return true;
        }

        return false;
    }
}
