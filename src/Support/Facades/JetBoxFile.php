<?php

namespace JetBox\Repositories\Support\Facades;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Facade;
use JetBox\Repositories\Contracts\FileContract;
use JetBox\Repositories\Services\FileService;

/**
 * @method static false|string save(string $path, object $file, string $fileName = null, array $options = [])
 * @method static bool|null delete(Model $model, string $field, string $path)
 * @method static string numberFormatSizeUnits(int $sizeInBytes)
 *
 * @see FileService
 */
class JetBoxFile extends Facade
{
    /**
     * @return string
     */
    protected static function getFacadeAccessor(): string
    {
        return FileContract::class;
    }
}
