<?php

namespace Matriphe\Format\Concerns;

trait NewLine
{
    public function removeNewLine($string)
    {
        return trim(preg_replace('/\s+/', ' ', $string));
    }
}
