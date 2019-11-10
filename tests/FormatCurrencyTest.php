<?php

namespace Matriphe\Format\Tests;

class FormatCurrencyTest extends TestCase
{
    public function testCurrency()
    {
        $this->assertSame('Rp1.000.000,00', $this->format->currency(1000000));
        $this->assertSame('Rp123.456,76', $this->format->currency(123456.76));
        $this->assertSame('Rp1.000.000,00', $this->format->currency(1000000, 'id'));
        $this->assertSame('Rp1.000.000,00', $this->format->currency(1000000, 'en'));

        $this->assertSame('US$1.000.000,00', $this->format->currency(1000000, 'us'));
        $this->assertSame('US$123.456,76', $this->format->currency(123456.76, 'us'));
        $this->assertSame('AU$1.000.000,00', $this->format->currency(1000000, 'au'));
        $this->assertSame('CA$1.000.000,00', $this->format->currency(1000000, 'ca'));
        $this->assertSame('฿1.000.000,00', $this->format->currency(1000000, 'th'));
        $this->assertSame('SGD1.000.000,00', $this->format->currency(1000000, 'sg'));
    }

    public function testCurrencyMinus()
    {
        $this->assertSame('-Rp1.000.000,00', $this->format->currency(-1000000));
        $this->assertSame('-Rp100.000,00', $this->format->currency(-100000));
        $this->assertSame('-Rp1.000.000,00', $this->format->currency(-1000000, 'id'));
        $this->assertSame('-Rp100.000,00', $this->format->currency(-100000, 'ID'));
        $this->assertSame('-Rp1.000.000,00', $this->format->currency(-1000000, 'en'));

        $this->assertSame('-US$1.000.000,00', $this->format->currency(-1000000, 'us'));
        $this->assertSame('-AU$1.000.000,00', $this->format->currency(-1000000, 'au'));
        $this->assertSame('-CA$1.000.000,00', $this->format->currency(-1000000, 'ca'));
        $this->assertSame('-฿1.000.000,00', $this->format->currency(-1000000, 'th'));
        $this->assertSame('-SGD1.000.000,00', $this->format->currency(-1000000, 'sg'));
    }

    public function testCurrencyAccounting()
    {
        $this->assertSame('Rp1.000.000,00', $this->format->currency(1000000, null, true));
        $this->assertSame('Rp100.000,00', $this->format->currency(100000, null, true));
        $this->assertSame('Rp1.000.000,00', $this->format->currency(1000000, 'id', true));
        $this->assertSame('Rp100.000,00', $this->format->currency(100000, 'ID', true));
        $this->assertSame('Rp1.000.000,00', $this->format->currency(1000000, 'en', true));

        $this->assertSame('US$1.000.000,00', $this->format->currency(1000000, 'us', true));
        $this->assertSame('AU$1.000.000,00', $this->format->currency(1000000, 'au', true));
        $this->assertSame('CA$1.000.000,00', $this->format->currency(1000000, 'ca', true));
        $this->assertSame('฿1.000.000,00', $this->format->currency(1000000, 'th', true));
        $this->assertSame('SGD1.000.000,00', $this->format->currency(1000000, 'sg', true));
    }

    public function testCurrencyAccountingMinus()
    {
        $this->assertSame('-Rp1.000.000,00', $this->format->currency(-1000000, null, true));
        $this->assertSame('-Rp100.000,00', $this->format->currency(-100000, null, true));
        $this->assertSame('-Rp1.000.000,00', $this->format->currency(-1000000, 'id', true));
        $this->assertSame('-Rp100.000,00', $this->format->currency(-100000, 'ID', true));
        $this->assertSame('-Rp1.000.000,00', $this->format->currency(-1000000, 'en', true));

        $this->assertSame('-US$1.000.000,00', $this->format->currency(-1000000, 'us', true));
        $this->assertSame('-AU$1.000.000,00', $this->format->currency(-1000000, 'au', true));
        $this->assertSame('-CA$1.000.000,00', $this->format->currency(-1000000, 'ca', true));
        $this->assertSame('-฿1.000.000,00', $this->format->currency(-1000000, 'th', true));
        $this->assertSame('-SGD1.000.000,00', $this->format->currency(-1000000, 'sg', true));
    }
}
