<?php

namespace Matriphe\Format\Tests\Helpers;

class FormatBytesTest extends TestCase
{
    public function testBytes()
    {
        $this->assertSame('10 B', format_bytes(10));
        $this->assertSame('100 B', format_bytes(100));
        $this->assertSame('1 kB', format_bytes(1000));
        $this->assertSame('1 kB', format_bytes(1024));
        $this->assertSame('1 kB', format_bytes(1025));
        $this->assertSame('1 kB', format_bytes(1025, 0));
        $this->assertSame('15 kB', format_bytes(15245, 0));
        $this->assertSame('16 kB', format_bytes(15645, 0));
        $this->assertSame('15,6 kB', format_bytes(15645));
        $this->assertSame('15,9 kB', format_bytes(15945));
        $this->assertSame('15,95 kB', format_bytes(15945, 2));
        $this->assertSame('16 kB', format_bytes(15945, 0));
        $this->assertSame('16 MB', format_bytes(15945987, 0));
        $this->assertSame('15,946 MB', format_bytes(15945987, 4));
        $this->assertSame('15,9 MB', format_bytes(15945987));
        $this->assertSame('2 GB', format_bytes(2000000000, 0));
        $this->assertSame('3 TB', format_bytes(3000000000000, 0));
        $this->assertSame('1 TB', format_bytes(1000000000000, 0));
        $this->assertSame('1 PB', format_bytes(1000000000000000));
        $this->assertSame('1 PB', format_bytes(1000000000000000, 0));
        $this->assertSame('9 PB', format_bytes(9000000000000000, 0));
    }

    public function testToBytes()
    {
        $this->assertEquals(10, format_to_bytes(10));
        $this->assertEquals(10240, format_to_bytes('10k'));
        $this->assertEquals(10240, format_to_bytes('10K'));
        $this->assertEquals(10485760, format_to_bytes('10M'));
        $this->assertEquals(10485760, format_to_bytes('10 M'));
        $this->assertEquals(10737418240, format_to_bytes('10G'));
        $this->assertEquals(10995116277760, format_to_bytes('10T'));
        $this->assertEquals(11258999068426240, format_to_bytes('10P'));
        $this->assertEquals(100, format_to_bytes('100'));
    }
}
