<?php

namespace Matriphe\Format\Tests;

class FormatBytesTest extends TestCase
{
    public function testBytes()
    {
        $this->assertSame('10 B', $this->format->bytes(10));
        $this->assertSame('100 B', $this->format->bytes(100));
        $this->assertSame('1 kB', $this->format->bytes(1000));
        $this->assertSame('1 kB', $this->format->bytes(1024));
        $this->assertSame('1 kB', $this->format->bytes(1025));
        $this->assertSame('1 kB', $this->format->bytes(1025, 0));
        $this->assertSame('15 kB', $this->format->bytes(15245, 0));
        $this->assertSame('16 kB', $this->format->bytes(15645, 0));
        $this->assertSame('15,6 kB', $this->format->bytes(15645));
        $this->assertSame('15,9 kB', $this->format->bytes(15945));
        $this->assertSame('15,95 kB', $this->format->bytes(15945, 2));
        $this->assertSame('16 kB', $this->format->bytes(15945, 0));
        $this->assertSame('16 MB', $this->format->bytes(15945987, 0));
        $this->assertSame('15,946 MB', $this->format->bytes(15945987, 4));
        $this->assertSame('15,9 MB', $this->format->bytes(15945987));
        $this->assertSame('2 GB', $this->format->bytes(2000000000, 0));
        $this->assertSame('3 TB', $this->format->bytes(3000000000000, 0));
        $this->assertSame('1 TB', $this->format->bytes(1000000000000, 0));
        $this->assertSame('1 PB', $this->format->bytes(1000000000000000));
        $this->assertSame('1 PB', $this->format->bytes(1000000000000000, 0));
        $this->assertSame('9 PB', $this->format->bytes(9000000000000000, 0));
    }

    public function testToBytes()
    {
        $this->assertEquals(10, $this->format->toBytes(10));
        $this->assertEquals(10240, $this->format->toBytes('10k'));
        $this->assertEquals(10240, $this->format->toBytes('10K'));
        $this->assertEquals(10485760, $this->format->toBytes('10M'));
        $this->assertEquals(10485760, $this->format->toBytes('10 M'));
        $this->assertEquals(10737418240, $this->format->toBytes('10G'));
        $this->assertEquals(10995116277760, $this->format->toBytes('10T'));
        $this->assertEquals(11258999068426240, $this->format->toBytes('10P'));
        $this->assertEquals(100, $this->format->toBytes('100'));
    }
}
