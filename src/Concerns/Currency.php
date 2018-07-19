<?php

namespace Matriphe\Format\Concerns;

trait Currency
{
    public function currency($number, $locale = null, $accounting = false)
    {
        $symbol = $this->getCurrencySymbol($locale);

        $currency = $this->currency->get($symbol);

        if ($accounting) {
            return $this->currency->formatAccounting($number, $symbol);
        }

        return $this->currency->format($number, $symbol);
    }

    protected function getCurrencySymbol($locale = null)
    {
        $locale = $this->switchLocale($locale);

        return $this->currencyRepo->getLocalCurrencySymbol($locale);
    }
}
