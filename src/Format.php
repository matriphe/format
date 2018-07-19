<?php

namespace Matriphe\Format;

use Carbon\Carbon;
use DateTimeZone;
use Jenssegers\Date\Date as IntlDate;
use Locale;
use Matriphe\Format\Concerns\Bytes;
use Matriphe\Format\Concerns\Currency;
use Matriphe\Format\Concerns\Date;
use Matriphe\Format\Concerns\NewLine;
use Matriphe\Format\Concerns\Number;
use Matriphe\Format\Concerns\Phone;
use Matriphe\Format\Concerns\SlugHash;
use Matriphe\Format\Repositories\CurrencyRepository;
use Propaganistas\LaravelIntl\Currency as IntlCurrency;
use Propaganistas\LaravelIntl\Number as IntlNumber;

class Format
{
    use Bytes, Currency, Date, NewLine, Number, Phone, SlugHash;

    protected $tz;
    protected $locale;

    protected $currencyRepo;
    protected $currency;

    protected $number;

    public function __construct($locale = null, $tz = null)
    {
        if (empty($locale)) {
            $locale = $this->getSystemLocale();
        }

        if (empty($tz)) {
            $tz = $this->getSystemTimezone();
        }

        $this->setLocale($locale);
        $this->setTimezone($tz);
    }

    public function setLocale($locale)
    {
        if (empty($locale)) {
            return $this;
        }

        $this->locale = strtolower($locale);
        IntlDate::setLocale($this->locale);

        $this->setCurrencyLocale();
        $this->setNumberLocale();

        return $this;
    }

    public function setTimezone($timezone)
    {
        $this->tz = $timezone;

        return $this;
    }

    public function getTimezone()
    {
        return $this->tz;
    }

    public function getLocale()
    {
        return $this->locale;
    }

    public function convertToDate($date)
    {
        if (empty($date)) {
            return null;
        }

        if ($date instanceof Carbon) {
            $date = $date->toDateTimeString();
        }

        return IntlDate::parse($date);
    }

    public function countryCodeFromTimezone($timezone = null)
    {
        if (empty($timezone)) {
            $timezone = $this->tz;
        }

        return trim((new DateTimeZone($timezone))->getLocation()['country_code']);
    }

    public function getCountry($country = null)
    {
        if (empty($country)) {
            $country = $this->countryCodeFromTimezone($this->tz);
        }

        return strtoupper($country);
    }

    protected function setCurrencyLocale()
    {
        $this->currencyRepo = (new CurrencyRepository($this->locale));
        $this->currency = (new IntlCurrency())
            ->setLocale($this->locale)
            ->setFallbackLocale($this->locale);

        return $this;
    }

    protected function setNumberLocale()
    {
        $this->number = (new IntlNumber())
            ->setLocale($this->locale)
            ->setFallbackLocale($this->locale);

        return $this;
    }

    protected function getSystemTimezone()
    {
        return date_default_timezone_get();
    }

    protected function getSystemLocale()
    {
        if ($locale = Locale::getPrimaryLanguage(Locale::getDefault())) {
            return $locale;
        }

        return 'en';
    }

    protected function getSystemCountry()
    {
        if ($locale = Locale::getPrimaryLanguage(Locale::getDefault())) {
            return $locale;
        }

        return strtoupper('us');
    }

    protected function switchLocale($locale = null)
    {
        if (empty($locale)) {
            return $this->locale;
        }

        return $locale;
    }
}
