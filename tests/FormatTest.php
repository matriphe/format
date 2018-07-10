<?php

namespace Matriphe\Format\Tests;

use Carbon\Carbon;
use Jenssegers\Date\Date;
use Locale;
use Matriphe\Format\Format;

class FormatTest extends TestCase
{
    public function testWithoutSettingConstructorParameters()
    {
        Locale::setDefault('en_US_POSIX');
        date_default_timezone_set('Asia/Jakarta');

        $format = new Format();
        $this->assertSame('en', $format->getLocale());
        $this->assertSame('Asia/Jakarta', $format->getTimezone());
        $this->assertSame('ID', $this->format->countryCodeFromTimezone());
        $this->assertSame('ID', $format->getCountry());
    }

    public function testGetLocale()
    {
        $this->assertSame('id', $this->format->getLocale());

        $this->format->setLocale('fr');
        $this->assertSame('fr', $this->format->getLocale());
    }

    public function testGetTimezone()
    {
        $this->assertSame('Asia/Jakarta', $this->format->getTimezone());

        $this->format->setTimezone('Asia/Singapore');
        $this->assertSame('Asia/Singapore', $this->format->getTimezone());
    }

    public function testConvertToDate()
    {
        $datestring = '2018-07-10 08:28:56';

        $date = Date::parse($datestring);
        $this->assertEquals($date, $this->format->convertToDate($datestring));
        $this->assertEquals($date, $this->format->convertToDate(Carbon::parse($datestring)));

        $this->format->setLocale('sg');
        $date = Date::parse($datestring);
        $this->assertEquals($date, $this->format->convertToDate($datestring));
    }

    public function testCountryCodeFromTimezone()
    {
        $this->assertSame('ID', $this->format->countryCodeFromTimezone());
        $this->assertSame('JP', $this->format->countryCodeFromTimezone('Asia/Tokyo'));
        $this->assertSame('SG', $this->format->countryCodeFromTimezone('Asia/Singapore'));

        date_default_timezone_set('Asia/Makassar');
        $this->assertSame('ID', $this->format->countryCodeFromTimezone());

        $this->format->setTimezone('Asia/Bangkok');
        $this->assertSame('TH', $this->format->countryCodeFromTimezone());
    }

    public function testGetCountry()
    {
        $this->assertSame('ID', $this->format->getCountry());

        date_default_timezone_set('Asia/Makassar');
        $this->assertSame('ID', $this->format->getCountry());

        $this->format->setTimezone('Asia/Bangkok');
        $this->assertSame('TH', $this->format->getCountry());

        $this->assertSame('GB', $this->format->getCountry('gb'));
    }
}
