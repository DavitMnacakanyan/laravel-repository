<?php

use JetBox\Repositories\Support\Utility;
use Illuminate\Contracts\Auth\Authenticatable;

if (! function_exists('currentUser')) {
    /**
     * Auth User
     *
     * @return Authenticatable|null
     */
    function currentUser(): ?Authenticatable
    {
        return auth()->user();
    }
}

if (! function_exists('is_json')) {
    /**
     * is json
     *
     * @param string $str
     * @param bool $returnData
     * @return bool|mixed
     */
    function is_json(string $str, bool $returnData = false)
    {
        return Utility::is_json($str, $returnData);
    }
}

if (! function_exists('lLog')) {
    /**
     * 'emergency', 'alert', 'critical', 'error', 'warning', 'notice', 'info', 'debug'
     *
     * @param string $message
     * @param string $log
     * @param array $context
     * @param string|null $disk
     * @return void
     */
    function lLog(string $message, string $log = 'info', array $context = [], string $disk = null): void
    {
        logger()->driver($disk)->{$log}($message, $context);
    }
}

if (! function_exists('numberFormatShort')) {
    /**
     * 3560 -> "3.56K"
     *
     * @param $n
     * @param int $precision
     * @return void
     */
    function numberFormatShort($n, int $precision = 2): string
    {
        return Utility::numberFormatShort($n, $precision);
    }
}
