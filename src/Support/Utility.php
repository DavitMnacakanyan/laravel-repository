<?php

namespace JetBox\Repositories\Support;


class Utility
{
    /**
     * @param string $str
     * @param false $returnData
     * @return bool|mixed
     */
    public static function is_json(string $str, bool $returnData = false)
    {
        $data = json_decode($str);

        if (
            ($data)
            && (is_object($data))
            && (json_last_error() === JSON_ERROR_NONE)
        )
            if ($returnData)
                return $data;
            else
                return true;

        return false;
    }

    /**
     * @return string
     */
    public static function getWebsiteName(): string
    {
        return config('app.name');
    }

    /**
     * @return string
     */
    public static function getWebsiteUrl(): string
    {
        return config('app.url');
    }
}
