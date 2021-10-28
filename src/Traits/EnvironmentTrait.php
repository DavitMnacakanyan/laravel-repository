<?php

namespace JetBox\Repositories\Traits;

use Illuminate\Support\Str;

trait EnvironmentTrait
{
    /**
     * @param string $key
     * @param $value
     */
    public function changeEnvironmentVariable(string $key, $value): void
    {
        $path = base_path('.env');
        $getContents = file_get_contents($path);

        [$oldValue, $newValue] = $this->environmentVariableModified($key, $value);

        $contents = str_replace($oldValue, $newValue, $getContents);
        file_put_contents($path, $contents);
    }

    /**
     * @param string $key
     * @param $value
     * @return string[]
     */
    private function environmentVariableModified(string $key, $value): array
    {
        $key = Str::upper($key);
        $old = env($key);

        $oldValue = "$key=$old";
        $newValue = "$key=$value";

        return [$oldValue, $newValue];
    }

    /**
     * @param array $data
     */
    public function environmentVariableAllUpdate(array $data): void
    {
        $path = base_path('.env');
        file_put_contents($path, $data);
    }
}
