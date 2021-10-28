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
     * @param $n
     * @param int $precision
     * @return string
     *
     * @example 3560 -> "3.56K"
     */
    public static function numberFormatShort($n, int $precision = 2): string
    {
        if ($n < 900)
            $format = number_format($n, $precision); // 0 - 900
        elseif ($n < 900000)
            $format = number_format($n / 1000, $precision) . 'K'; // 0.9k-850k
        elseif ($n < 900000000)
            $format = number_format($n / 1000000, $precision) . 'M'; // 0.9m-850m
        elseif ($n < 900000000000)
            $format = number_format($n / 1000000000, $precision) . 'B'; // 0.9b-850b
        else
            $format = number_format($n / 1000000000000, $precision) . 'T'; // 0.9t+

        if ($precision > 0)
            $dotZero = '.' . str_repeat('0', $precision);

        return str_replace($dotZero, '', $format);
    }
}
