<?php

use Matriphe\Format\Format;

if (! function_exists('matripheFormat')) {
    function matripheFormat($locale = null, $tz = null)
    {
        return new Format($locale, $tz);
    }
}

if (! function_exists('format_number')) {
    function format_number($value, $decimal = 0, $locale = null)
    {
        return matripheFormat($locale)->number($value, $decimal, $locale);
    }
}

if (! function_exists('format_bytes')) {
    function format_bytes($bytes, $precision = 1)
    {
        return matripheFormat()->bytes($bytes, $precision);
    }
}

if (! function_exists('format_to_bytes')) {
    function format_to_bytes($string)
    {
        return matripheFormat()->toBytes($string);
    }
}

if (! function_exists('format_phone')) {
    function format_phone($phone, $country = null)
    {
        return matripheFormat()->phone($phone, $country);
    }
}

if (! function_exists('format_phone_human')) {
    function format_phone_human($phone, $country = null)
    {
        return matripheFormat()->phoneHuman($phone, $country);
    }
}

if (! function_exists('format_date_range')) {
    function format_date_range($date1, $date2 = null, $long = true, $locale = null)
    {
        return matripheFormat($locale)->dateRange($date1, $date2, $long, $locale);
    }
}

if (! function_exists('format_duration')) {
    function format_duration($date1, $date2, $locale = null)
    {
        return matripheFormat($locale)->duration($date1, $date2, $locale);
    }
}

if (! function_exists('format_slug_hash')) {
    function format_slug_hash(int $id, $timestamp = null, string $alphabet = null, int $length = 6)
    {
        return matripheFormat()->slugHash($id, $timestamp, $alphabet, $length);
    }
}

if (! function_exists('format_remove_new_line')) {
    function format_remove_new_line($string)
    {
        return matripheFormat()->removeNewLine($string);
    }
}

if (! function_exists('format_currency')) {
    function format_currency($number, $locale = null, $accounting = false)
    {
        return matripheFormat()->currency($number, $locale, $accounting);
    }
}
