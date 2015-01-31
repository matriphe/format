<?php

use Matriphe\Format\Format;

class FormatTest extends PHPUnit_Framework_TestCase {

	public function __construct()
	{
		$this->format = new Format();
	}

	public function testNumber()
	{
		$this->assertSame('100',$this->format->number(100));
		$this->assertSame('1.000',$this->format->number(1000));
		$this->assertSame('3.000.000',$this->format->number(3000000));
		$this->assertSame('10',$this->format->number(10.3));
		$this->assertSame('10,34',$this->format->number(10.34234,2));
		$this->assertSame('13.340,34',$this->format->number(13340.34234,2));
		$this->assertSame('123.456.789,3456',$this->format->number(123456789.3456,4));
		$this->assertSame('123,456,789.3456',$this->format->number(123456789.3456,4,'.',','));
	}

	public function testBytes()
	{
		$this->assertSame('10 B',$this->format->bytes(10));
		$this->assertSame('100 B',$this->format->bytes(100));
		$this->assertSame('1,0 kB',$this->format->bytes(1000));
		$this->assertSame('1,0 kB',$this->format->bytes(1024));
		$this->assertSame('1,0 kB',$this->format->bytes(1025));
		$this->assertSame('1 kB',$this->format->bytes(1025,0));
		$this->assertSame('15 kB',$this->format->bytes(15245,0));
		$this->assertSame('15 kB',$this->format->bytes(15645,0));
		$this->assertSame('15,3 kB',$this->format->bytes(15645));
		$this->assertSame('15,6 kB',$this->format->bytes(15945));
		$this->assertSame('16 kB',$this->format->bytes(15945,0));
		$this->assertSame('15 MB',$this->format->bytes(15945987,0));
		$this->assertSame('15,2 MB',$this->format->bytes(15945987));
		$this->assertSame('2 GB',$this->format->bytes(2000000000,0));
		$this->assertSame('3 TB',$this->format->bytes(3000000000000,0));
		$this->assertSame('1 TB',$this->format->bytes(1000000000000,0));
		$this->assertSame('1 PB',$this->format->bytes(1000000000000000,0));
		$this->assertSame('8 PB',$this->format->bytes(9000000000000000,0));
	}

	public function testToBytes()
	{
		$this->assertEquals(10,$this->format->toBytes(10));
		$this->assertEquals(10240,$this->format->toBytes('10k'));
		$this->assertEquals(10240,$this->format->toBytes('10K'));
		$this->assertEquals(10485760,$this->format->toBytes('10M'));
		$this->assertEquals(10485760,$this->format->toBytes('10 M'));
		$this->assertEquals(10737418240,$this->format->toBytes('10G'));
		$this->assertEquals(10995116277760,$this->format->toBytes('10T'));
		$this->assertEquals(11258999068426240,$this->format->toBytes('10P'));
		$this->assertEquals(100,$this->format->toBytes('100'));
	}

	public function testPhone()
	{
		$this->assertSame('+6281802596094',$this->format->phone('081802596094'));
		$this->assertSame('+6281802596094',$this->format->phone('+6281802596094'));
		$this->assertSame('+6281802596094',$this->format->phone('0818 0259 6094'));
		$this->assertSame('+6281802596094',$this->format->phone('0818-025 960-94'));
		$this->assertSame('+62271715877',$this->format->phone('(0271) 715 877'));
		$this->assertSame('+65271715877',$this->format->phone('(0271) 715 877','+65'));
	}
	
}