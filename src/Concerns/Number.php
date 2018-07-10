<?php

namespace Matriphe\Format\Concerns;

trait Number
{
    public function number($value, $decimal = 0, $locale = null)
    {
        $options = [
            'maximum_fraction_digits' => $decimal,
        ];

        if (empty($locale)) {
            return $this->number->format($value, $options);
        }

        return $this->number->usingLocale($locale, function ($number) use ($value, $options) {
            return $number->format($value, $options);
        });
    }
}
