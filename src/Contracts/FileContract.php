<?php

namespace JetBox\Repositories\Contracts;

use Illuminate\Database\Eloquent\Model;

interface FileContract
{
    /**
     * @param string $path
     * @param object $file
     * @param string|null $fileName
     * @param string $disk
     * @param array $options
     * @return mixed
     */
    public function save(string $path, object $file, string $fileName = null, string $disk = 'public', array $options = []): string;

    /**
     * @param Model $model
     * @param string $field
     * @param string $path
     * @param string $disk
     * @return bool|null
     */
    public function delete(Model $model, string $field, string $path, string $disk = 'public'): ?bool;

    /**
     * @param int $sizeInBytes
     * @return string
     */
    public function numberFormatSizeUnits(int $sizeInBytes): string;
}
