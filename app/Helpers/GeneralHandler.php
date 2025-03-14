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

    /**
     * ##################
     * ###   STRING   ###
     * ##################
     */

    /**
     * @param string $string
     * @param int $limit
     * @param string $pointer
     * @return string
     */
    public static function str_limit_words(string $string, int $limit, string $pointer = "..."): string
    {
        $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
        $arrWords = explode(" ", $string);
        $numWords = count($arrWords);

        if ($numWords < $limit) {
            return $string;
        }

        $words = implode(" ", array_slice($arrWords, 0, $limit));
        return "{$words}{$pointer}";
    }

    /**
     * @param string $string
     * @param int $limit
     * @param string|string $pointer
     * @return string
     */
    public static function str_limit_chars(string $string, int $limit, string $pointer = "..."): string
    {
        $string = trim(filter_var($string, FILTER_SANITIZE_SPECIAL_CHARS));
        if (mb_strlen($string) <= $limit) {
            return $string;
        }

        $chars = mb_substr($string, 0, mb_strrpos(mb_substr($string, 0, $limit), " "));
        return "{$chars}{$pointer}";
    }

    /**
     * @param string $html
     * @param int $limitWords
     * @return string
     */
    public static function getBioPreview(string $html, int $limitWords = 4): string
    {
        $clean = html_entity_decode(strip_tags($html));
        return self::str_limit_words($clean, $limitWords);
    }
}
