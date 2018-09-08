<?php

namespace Matriphe\Format\Tests;

class FormatPhoneTest extends TestCase
{
    public function testPhone()
    {
        $this->assertSame('+6281802596094', $this->format->phone('081802596094'));
        $this->assertSame('+6281802596094', $this->format->phone('+6281802596094'));
        $this->assertSame('+6281802596094', $this->format->phone('0818 0259 6094'));
        $this->assertSame('+6281802596094', $this->format->phone('0818-025 960-94'));
        $this->assertSame('+62271715877', $this->format->phone('(0271) 715 877'));
        $this->assertSame('+622742924745', $this->format->phone('+62 274 2924745'));
        $this->assertSame('+622742924745', $this->format->phone('0274-2924745'));

        $this->assertSame('+6566533858', $this->format->phone('(65) 6653 3858', 'sg'));
    }

    public function testPhoneHuman()
    {
        $this->assertSame('0818-0259-6094', $this->format->phoneHuman('081802596094'));
        $this->assertSame('0818-0259-6094', $this->format->phoneHuman('+6281802596094'));
        $this->assertSame('0818-0259-6094', $this->format->phoneHuman('0818 0259 6094'));
        $this->assertSame('0818-0259-6094', $this->format->phoneHuman('0818-025 960-94'));
        $this->assertSame('(0271) 715877', $this->format->phoneHuman('(0271) 715 877'));
        $this->assertSame('(0274) 2924745', $this->format->phoneHuman('+62 274 2924745'));
        $this->assertSame('(0274) 2924745', $this->format->phoneHuman('0274-2924745'));

        $this->assertSame('6653 3858', $this->format->phoneHuman('(65) 6653 3858', 'sg'));
    }

    public function testCarrier()
    {
        $this->assertSame('Telkomsel', $this->format->carrier('081102596094'));
        $this->assertSame('Telkomsel', $this->format->carrier('081202596094'));
        $this->assertSame('Telkomsel', $this->format->carrier('081302596094'));
        $this->assertSame('Telkomsel', $this->format->carrier('082102596094'));
        $this->assertSame('Telkomsel', $this->format->carrier('082202596094'));
        $this->assertSame('Telkomsel', $this->format->carrier('082302596094'));
        $this->assertSame('Telkomsel', $this->format->carrier('085202596094'));
        $this->assertSame('Telkomsel', $this->format->carrier('085302596094'));

        $this->assertSame('IM3', $this->format->carrier('081402596094'));
        $this->assertSame('IM3', $this->format->carrier('081502596094'));
        $this->assertSame('IM3', $this->format->carrier('081602596094'));
        $this->assertSame('IM3', $this->format->carrier('085502596094'));
        $this->assertSame('IM3', $this->format->carrier('085602596094'));
        $this->assertSame('IM3', $this->format->carrier('085702596094'));
        $this->assertSame('IM3', $this->format->carrier('085802596094'));

        $this->assertSame('XL', $this->format->carrier('081702596094'));
        $this->assertSame('XL', $this->format->carrier('081802596094'));
        $this->assertSame('XL', $this->format->carrier('081902596094'));
        $this->assertSame('XL', $this->format->carrier('085902596094'));
        $this->assertSame('XL', $this->format->carrier('087702596094'));
        $this->assertSame('XL', $this->format->carrier('087802596094'));

        $this->assertSame('AXIS', $this->format->carrier('083102596094'));
        $this->assertSame('AXIS', $this->format->carrier('083202596094'));
        $this->assertSame('AXIS', $this->format->carrier('083802596094'));

        $this->assertSame('Smartfren', $this->format->carrier('088102596094'));
        $this->assertSame('Smartfren', $this->format->carrier('088202596094'));
        $this->assertSame('Smartfren', $this->format->carrier('088702596094'));

        $this->assertSame('3', $this->format->carrier('089602596094'));
        $this->assertSame('3', $this->format->carrier('089702596094'));
        $this->assertSame('3', $this->format->carrier('089802596094'));
    }
}
