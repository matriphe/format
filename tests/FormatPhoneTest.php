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
}
