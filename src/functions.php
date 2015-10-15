<?php

use Matriphe\Format\Format;

if (! function_exists('format_number')) {
    function format_number($num, $sep = 0, $decimal = ',', $thousand = '.')
    {
        $format = new Format();
        return $format->number($num, $sep, $decimal, $thousand);
    }
}

if (! function_exists('format_bytes')) {
    function format_bytes($num, $precision = 1)
    {
        $format = new Format();
        return $format->bytes($num, $precision);
    }
}

if (! function_exists('format_to_bytes')) {
    function format_to_bytes($sSize)
    {
        $format = new Format();
        return $format->toBytes($sSize);
    }
}

if (! function_exists('format_phone')) {
    function format_phone($phone, $countrycode='+62')
    {
        $format = new Format();
        return $format->phone($phone, $countrycode);
    }
}

if (! function_exists('format_date_range')) {
    function format_date_range($date1, $date2 = null, $long = true)
    {
        $format = new Format();
        return $format->dateRange($date1, $date2, $long);
    }
}

if (! function_exists('format_slug_hash')) {
    function format_slug_hash($id, $timestamp = null)
    {
        $format = new Format();
        return $format->slugHash($id, $timestamp);
    }
}

if (! function_exists('format_duration')) {
    function format_duration($date1, $date2, $showsecond = false)
    {
        $format = new Format();
        return $format->duration($date1, $date2, $showsecond);
    }
}

if (! function_exists('format_remove_new_line')) {
    function format_remove_new_line($string)
    {
        $format = new Format();
        return $format->removeNewLine($string);
    }
}
