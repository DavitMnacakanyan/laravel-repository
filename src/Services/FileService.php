<?php

namespace JetBox\Repositories\Services;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use JetBox\Repositories\Contracts\FileContract;

class FileService implements FileContract
{
    /**
     * @return false|string
     */
    public function save(string $path, object $file, string $fileName = null, string $disk = 'public', array $options = []): string
    {
        $name = $fileName ?: $this->hashName($file);
        return Storage::disk($disk)->putFileAs($path, $file, $name, $options);
    }

    /**
     * @param object $file
     * @return string
     */
    private function hashName(object $file): string
    {
        $str = Str::random(40);

        $extension = '.' . $file->guessExtension();

        return $str . $extension;
    }

    /**
     * @param Model $model
     * @param string $field
     * @param string $path
     * @param string $disk
     * @return bool|null
     */
    public function delete(Model $model, string $field, string $path, string $disk = 'public'): ?bool
    {
        if (is_null($model->{$field})) return null;

        $mediaPath = "$path/{$model->{$field}}";
        $mediaExists = Storage::disk($disk)->exists($mediaPath);

        if ($mediaExists) return Storage::disk($disk)->delete($mediaPath);

        return false;
    }

    /**
     * @param int $sizeInBytes
     * @return string
     */
    public function numberFormatSizeUnits(int $sizeInBytes): string
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];

        if ($sizeInBytes == 0) {
            return '0 '.$units[1];
        }

        for ($i = 0; $sizeInBytes > 1024; $i++) {
            $sizeInBytes /= 1024;
        }

        return round($sizeInBytes, 2).' '.$units[$i];
    }
}
