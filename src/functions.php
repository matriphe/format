<?php

if (! function_exists('format_number')) {
    function format_number($num, $sep = 0, $decimal = ',', $thousand = '.')
    {
        return $num;//app('Format')->number($num, $sep, $decimal, $thousand);
    }
}