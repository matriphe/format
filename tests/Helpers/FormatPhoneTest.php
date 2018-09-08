<?php

namespace Matriphe\Format\Tests\Helpers;

class FormatPhoneTest extends TestCase
{
    public function testPhone()
    {
        $this->assertSame('+6281802596094', format_phone('081802596094'));
        $this->assertSame('+6281802596094', format_phone('+6281802596094'));
        $this->assertSame('+6281802596094', format_phone('0818 0259 6094'));
        $this->assertSame('+6281802596094', format_phone('0818-025 960-94'));
        $this->assertSame('+62271715877', format_phone('(0271) 715 877'));
        $this->assertSame('+622742924745', format_phone('+62 274 2924745'));
        $this->assertSame('+622742924745', format_phone('0274-2924745'));

        $this->assertSame('+6566533858', format_phone('(65) 6653 3858', 'sg'));
    }

    public function testPhoneHuman()
    {
        $this->assertSame('0818-0259-6094', format_phone_human('081802596094'));
        $this->assertSame('0818-0259-6094', format_phone_human('+6281802596094'));
        $this->assertSame('0818-0259-6094', format_phone_human('0818 0259 6094'));
        $this->assertSame('0818-0259-6094', format_phone_human('0818-025 960-94'));
        $this->assertSame('(0271) 715877', format_phone_human('(0271) 715 877'));
        $this->assertSame('(0274) 2924745', format_phone_human('+62 274 2924745'));
        $this->assertSame('(0274) 2924745', format_phone_human('0274-2924745'));

        $this->assertSame('6653 3858', format_phone_human('(65) 6653 3858', 'sg'));
    }

    public function testCarrier()
    {
        $this->assertSame('Telkomsel', format_carrier('081102596094'));
        $this->assertSame('Telkomsel', format_carrier('081202596094'));
        $this->assertSame('Telkomsel', format_carrier('081302596094'));
        $this->assertSame('Telkomsel', format_carrier('082102596094'));
        $this->assertSame('Telkomsel', format_carrier('082202596094'));
        $this->assertSame('Telkomsel', format_carrier('082302596094'));
        $this->assertSame('Telkomsel', format_carrier('085202596094'));
        $this->assertSame('Telkomsel', format_carrier('085302596094'));

        $this->assertSame('IM3', format_carrier('081402596094'));
        $this->assertSame('IM3', format_carrier('081502596094'));
        $this->assertSame('IM3', format_carrier('081602596094'));
        $this->assertSame('IM3', format_carrier('085502596094'));
        $this->assertSame('IM3', format_carrier('085602596094'));
        $this->assertSame('IM3', format_carrier('085702596094'));
        $this->assertSame('IM3', format_carrier('085802596094'));

        $this->assertSame('XL', format_carrier('081702596094'));
        $this->assertSame('XL', format_carrier('081802596094'));
        $this->assertSame('XL', format_carrier('081902596094'));
        $this->assertSame('XL', format_carrier('085902596094'));
        $this->assertSame('XL', format_carrier('087702596094'));
        $this->assertSame('XL', format_carrier('087802596094'));

        $this->assertSame('AXIS', format_carrier('083102596094'));
        $this->assertSame('AXIS', format_carrier('083202596094'));
        $this->assertSame('AXIS', format_carrier('083802596094'));

        $this->assertSame('Smartfren', format_carrier('088102596094'));
        $this->assertSame('Smartfren', format_carrier('088202596094'));
        $this->assertSame('Smartfren', format_carrier('088702596094'));

        $this->assertSame('3', format_carrier('089602596094'));
        $this->assertSame('3', format_carrier('089702596094'));
        $this->assertSame('3', format_carrier('089802596094'));
    }
}
