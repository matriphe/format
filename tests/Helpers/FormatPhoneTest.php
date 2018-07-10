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
}
