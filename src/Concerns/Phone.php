<?php

namespace Matriphe\Format\Concerns;

use Propaganistas\LaravelPhone\PhoneNumber;

trait Phone
{
    public function phone($phone, $country = null)
    {
        return PhoneNumber::make($phone, $this->getCountry($country))
            ->formatE164();
    }

    public function phoneHuman($phone, $country = null)
    {
        return PhoneNumber::make($phone, $this->getCountry($country))
            ->formatNational();
    }
}
