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

	public function testDateRange()
	{
		$this->assertSame('3 March 2015',$this->format->dateRange('2015-03-03'));
		$this->assertSame('3 March 2015',$this->format->dateRange(null,'2015-03-03'));
		$this->assertSame('3 Mar 15',$this->format->dateRange('2015-03-03','',false));
		$this->assertSame('3 Mar 15',$this->format->dateRange(null,'2015-03-03',false));
		$this->assertSame('3 March 2015',$this->format->dateRange('2015-03-03','2015-03-03'));
		$this->assertSame('3 Mar 15',$this->format->dateRange('2015-03-03','2015-03-03',false));
		$this->assertSame('3-5 March 2015',$this->format->dateRange('2015-03-03','2015-03-05'));
		$this->assertSame('3-5 Mar 15',$this->format->dateRange('2015-03-03','2015-03-05',false));
		$this->assertSame('3-5 March 2015',$this->format->dateRange('2015-03-05','2015-03-03'));
		$this->assertSame('3-5 Mar 15',$this->format->dateRange('2015-03-05','2015-03-03',false));
		$this->assertSame('3 March - 3 April 2015',$this->format->dateRange('2015-03-03','2015-04-03'));
		$this->assertSame('3 Mar - 3 Apr 15',$this->format->dateRange('2015-03-03','2015-04-03',false));
		$this->assertSame('3 March - 5 April 2015',$this->format->dateRange('2015-03-03','2015-04-05'));
		$this->assertSame('3 Mar - 5 Apr 15',$this->format->dateRange('2015-03-03','2015-04-05',false));
		$this->assertSame('3 March 2015 - 3 March 2016',$this->format->dateRange('2015-03-03','2016-03-03'));
		$this->assertSame('3 Mar 15 - 3 Mar 16',$this->format->dateRange('2015-03-03','2016-03-03',false));
		$this->assertSame('3 March 2015 - 3 April 2016',$this->format->dateRange('2015-03-03','2016-04-03'));
		$this->assertSame('3 Mar 15 - 3 Apr 16',$this->format->dateRange('2015-03-03','2016-04-03',false));
	}
	
	public function testHashSlug()
	{
		$this->assertSame('6O_IoS',$this->format->slugHash(1,strtotime('1984-03-22')));
		$this->assertSame('YO_IoS',$this->format->slugHash(2,strtotime('1984-03-22')));
		$this->assertSame('HO_IoS',$this->format->slugHash(3,strtotime('1984-03-22')));
		$this->assertSame('4XBzGc',$this->format->slugHash(1,strtotime('1986-10-03')));
		$this->assertSame('RXBzGc',$this->format->slugHash(2,strtotime('1986-10-03')));
		$this->assertSame('FXBzGc',$this->format->slugHash(3,strtotime('1986-10-03')));
	}

}