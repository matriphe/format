<?php

namespace Matriphe\Format\Tests\Helpers;

use Matriphe\Format\Tests\TestCase as BaseTestCase;

abstract class TestCase extends BaseTestCase
{
    public function setUp()
    {
        parent::setUp();

        $this->setAppLocale();

        require_once(__DIR__.'/../../src/functions.php');
    }
}
