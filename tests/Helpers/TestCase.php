<?php

namespace Matriphe\Format\Tests\Helpers;

use Locale;
use Matriphe\Format\Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();

        Locale::setDefault('id_ID');
        date_default_timezone_set($this->tz);

        require_once(__DIR__.'/../../src/functions.php');
    }
}
