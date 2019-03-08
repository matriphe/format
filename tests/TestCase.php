<?php

namespace Matriphe\Format\Tests;

use Locale;
use Matriphe\Format\Format;
use Matriphe\Format\FormatServiceProvider;
use Orchestra\Testbench\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    protected $locale = 'id';
    protected $tz = 'Asia/Jakarta';

    protected $format;

    public function setUp() : void
    {
        parent::setUp();

        $this->setAppLocale();

        $this->format = new Format($this->locale, $this->tz);
    }

    protected function getPackageProviders($application)
    {
        return [FormatServiceProvider::class];
    }

    protected function setAppLocale()
    {
        Locale::setDefault('id_ID');
        date_default_timezone_set($this->tz);
    }
}
