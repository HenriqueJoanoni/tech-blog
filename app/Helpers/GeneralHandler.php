<?php


namespace App\Helpers;

use DateTime;

class GeneralHandler
{
    /**
     * ##################
     * ###    UTIL    ###
     * ##################
     */

    /**
     * @param $str
     * @return string|string[]|null
     */
    public static function onlyNumbers($str): array|string|null
    {
        return preg_replace("/\D+/", "", $str);
    }

    /**
     * @param $str
     * @return array|string|null
     */
    public static function formatDecimalField($str): array|string|null
    {
        $sanitized = static::onlyNumbers($str);
        return number_format($sanitized, 2, '.', '');
    }

    /**
     * @param string $str
     * @return array|string|string[]|null
     */
    public static function clearStr(string $str): array|string|null
    {
        return preg_replace("/[^a-zA-Z0-9\d\sàâãáçéèêëìîíïôòóùûüÂÃÊÎÔúÛÄËÏÖÜÀÆæÇÉÈŒœÙñý'’,]/", "", $str);
    }

    /**
     * @param string $date
     * @param string $format
     * @return string
     * @throws \DateMalformedStringException
     */
    public static function dateFmt(string $date = "now", string $format = "d/m/Y H\hi"): string
    {
        return (new DateTime($date))->format($format);
    }
}
