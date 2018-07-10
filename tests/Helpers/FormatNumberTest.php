<?php

namespace Matriphe\Format\Tests\Helpers;

class FormatNumberTest extends TestCase
{
    public function testNumber()
    {
        $this->assertSame('100', format_number(100));
        $this->assertSame('1.000', format_number(1000));
        $this->assertSame('3.000.000', format_number(3000000));
        $this->assertSame('10', format_number(10.3));
        $this->assertSame('10,3', format_number(10.3, 1));
        $this->assertSame('10,34', format_number(10.34234, 2));
        $this->assertSame('13.340,34', format_number(13340.34234, 2));
        $this->assertSame('123.456.789,3445', format_number(123456789.3445, 4));
        $this->assertSame('123.456.789,3445', format_number(123456789.3445, 10));
        $this->assertSame('3,1415926536', format_number(M_PI, 10));
    }

    public function testNumberEnglish()
    {
        $locale = 'en';

        $this->assertSame('100', format_number(100, 0, $locale));
        $this->assertSame('1,000', format_number(1000, 0, $locale));
        $this->assertSame('3,000,000', format_number(3000000, 0, $locale));
        $this->assertSame('10', format_number(10.3, 0, $locale));
        $this->assertSame('10.3', format_number(10.3, 1, $locale));
        $this->assertSame('10.34', format_number(10.34234, 2, $locale));
        $this->assertSame('13,340.34', format_number(13340.34234, 2, $locale));
        $this->assertSame('123,456,789.3445', format_number(123456789.3445, 4, $locale));
        $this->assertSame('123,456,789.3445', format_number(123456789.3445, 10, $locale));
        $this->assertSame('3.1415926536', format_number(M_PI, 10, $locale));
    }
}
