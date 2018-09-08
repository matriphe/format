<?php

namespace Matriphe\Format\Concerns;

use Exception;
use libphonenumber\PhoneNumberToCarrierMapper;
use libphonenumber\PhoneNumberUtil;
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

    public function carrier($phone, $country = null)
    {
        $phoneUtil = PhoneNumberUtil::getInstance();
        $country = $this->getCountry($country);

        try {
            $phoneInstance = $phoneUtil->parse($phone, $country);
            $carrierMapper = PhoneNumberToCarrierMapper::getInstance();

            return $carrierMapper->getNameForNumber($phoneInstance, $country);
        } catch (Exception $e) {
            return null;
        }
    }
}
