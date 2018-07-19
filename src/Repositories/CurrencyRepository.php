<?php

namespace Matriphe\Format\Repositories;

use CommerceGuys\Intl\Currency\CurrencyRepository as Repository;
use Sokil\IsoCodes\IsoCodesFactory;

class CurrencyRepository extends Repository
{
    public function getLocalCurrencySymbol($locale)
    {
        $countryCode = $this->getCountryCode($locale);
        $codes = collect($this->getAll($locale))->filter(function ($c) use ($countryCode) {
            return $c->getNumericCode() == $countryCode;
        });

        if (empty($codes)) {
            return 'USD';
        }

        return $codes->first()->getCurrencyCode();
    }

    protected function getCountryCode($locale)
    {
        $factory = new IsoCodesFactory();
        $locale = strtoupper($locale);

        $country = $factory->getCountries()->getByAlpha2($locale);

        if (empty($country)) {
            $country = $factory->getCountries()->getByAlpha2(strtoupper($this->defaultLocale));
        }

        return $country->getNumericCode();
    }
}
