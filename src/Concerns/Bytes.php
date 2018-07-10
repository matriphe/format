<?php

namespace Matriphe\Format\Concerns;

use ByteUnits\Binary;

trait Bytes
{
    protected $bytePattern = '/(\d+\.*\d*)([A-Za-z]+)/i';

    public function bytes($bytes, $precision = 1, $locale = null)
    {
        $formatted = Binary::bytes($bytes)->asMetric()->format($precision);

        if (! preg_match($this->bytePattern, $formatted, $matched)) {
            return $this->number($bytes, $precision).' B';
        }

        return implode(' ', [
            $this->number($matched[1], $precision, $locale),
            str_replace('i', '', $matched[2]),
        ]);
    }

    public function toBytes($string)
    {
        $string = trim($string);
        $string = str_replace(' ', '', $string);

        if (! preg_match($this->bytePattern, $string)) {
            return \ByteUnits\bytes($string)->numberOfBytes();
        }

        $string = str_replace('B', '', $string);
        $string .= 'iB';

        return Binary::parse($string)->numberOfBytes();
    }
}
