<?php

use Matriphe\Format\FormatFacade as Format;

if (! function_exists('format_number')) {
    function format_number($value, $decimal = 0, $locale = null)
    {
        return app('matriphe.format')->number($value, $decimal, $locale);
    }
}

if (! function_exists('format_bytes')) {
    function format_bytes($bytes, $precision = 1)
    {
        return app('matriphe.format')->bytes($bytes, $precision);
    }
}

if (! function_exists('format_to_bytes')) {
    function format_to_bytes($string)
    {
        return app('matriphe.format')->toBytes($string);
    }
}

if (! function_exists('format_phone')) {
    function format_phone($phone, $country = null)
    {
        return app('matriphe.format')->phone($phone, $country);
    }
}

if (! function_exists('format_phone_human')) {
    function format_phone_human($phone, $country = null)
    {
        return app('matriphe.format')->phoneHuman($phone, $country);
    }
}

if (! function_exists('format_date_range')) {
    function format_date_range($date1, $date2 = null, $long = true, $locale = null)
    {
        return app('matriphe.format')->dateRange($date1, $date2, $long, $locale);
    }
}

if (! function_exists('format_duration')) {
    function format_duration($date1, $date2, $locale = null)
    {
        return app('matriphe.format')->duration($date1, $date2, $locale);
    }
}

if (! function_exists('format_slug_hash')) {
    function format_slug_hash(int $id, $timestamp = null, string $alphabet = null, int $length = 6)
    {
        return app('matriphe.format')->slugHash($id, $timestamp, $alphabet, $length);
    }
}

if (! function_exists('format_remove_new_line')) {
    function format_remove_new_line($string)
    {
        return app('matriphe.format')->removeNewLine($string);
    }
}
