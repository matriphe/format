<?php namespace Matriphe\Format;

use Matriphe\Format\Format;

if (! function_exists('format_number')) {
    function format_number($num, $sep = 0, $decimal = ',', $thousand = '.')
    {
        return app('Format')->number($num, $sep, $decimal, $thousand);
    }
}