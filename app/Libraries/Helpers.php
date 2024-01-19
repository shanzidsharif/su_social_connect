<?php

use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

if (!function_exists('image_uploader')) {
    function image_uploader(string $dir, string $format, $image = null, $old_image = null, $width = 300, $height = 300)
    {
        if ($image == null) return $old_image ?? 'def.png';

        if (isset($old_image)) Storage::disk('public')->delete($dir . $old_image);

        $imageName = \Carbon\Carbon::now()->toDateString() . "-" . uniqid() . "." . $format;
        if (!Storage::disk('public')->exists($dir)) {
            Storage::disk('public')->makeDirectory($dir);
        }
        $image_processed = Image::make($image)->fit($width, $height)->stream();
        Storage::disk('public')->put($dir . $imageName, $image_processed);

        return $imageName;
    }
}

if (!function_exists('file_remover')) {
    function file_remover(string $dir, $file): bool
    {
        if (!isset($file)) return true;

        if (Storage::disk('public')->exists($dir . $file)) Storage::disk('public')->delete($dir . $file);

        return true;
    }
}

if (!function_exists('storage_file_path')) {
    function storage_file_path($dir): string
    {
        return asset('storage/app/public') . $dir;
    }
}

if (!function_exists('error_handler_admin')) {
    function error_handler($validator)
    {
        $errors = [];
        foreach ($validator->errors()->getMessages() as $index => $error) {
            $errors[] = ['error_code' => $index, 'message' => trans_admin($error[0])];
        }
        return $errors;
    }
}

if (!function_exists('response_structure')) {
    function response_structure($constant, $collections = null, $errors = []): array
    {
        $constant = (array)$constant;
        $constant['collections'] = $collections;
        $constant['errors'] = $errors;
        return $constant;
    }
}
