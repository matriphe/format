<?php

require_once dirname(__FILE__) . '/../src/functions.php';

class FormatHelperTest extends PHPUnit_Framework_TestCase {

	public function testFormatNumber()
	{
		$this->assertSame('100', format_number(100));
		$this->assertSame('1.000', format_number(1000));
		$this->assertSame('3.000.000', format_number(3000000));
		$this->assertSame('10', format_number(10.3));
		$this->assertSame('10,34', format_number(10.34234,2));
		$this->assertSame('13.340,34', format_number(13340.34234,2));
		$this->assertSame('123.456.789,3456', format_number(123456789.3456,4));
		$this->assertSame('123,456,789.3456', format_number(123456789.3456,4,'.',','));
	}

	public function testFormatBytes()
	{
		$this->assertSame('10 B', format_bytes(10));
		$this->assertSame('100 B', format_bytes(100));
		$this->assertSame('1,0 kB', format_bytes(1000));
		$this->assertSame('1,0 kB', format_bytes(1024));
		$this->assertSame('1,0 kB', format_bytes(1025));
		$this->assertSame('1 kB', format_bytes(1025,0));
		$this->assertSame('15 kB', format_bytes(15245,0));
		$this->assertSame('15 kB', format_bytes(15645,0));
		$this->assertSame('15,3 kB', format_bytes(15645));
		$this->assertSame('15,6 kB', format_bytes(15945));
		$this->assertSame('16 kB', format_bytes(15945,0));
		$this->assertSame('15 MB', format_bytes(15945987,0));
		$this->assertSame('15,2 MB', format_bytes(15945987));
		$this->assertSame('2 GB', format_bytes(2000000000,0));
		$this->assertSame('3 TB', format_bytes(3000000000000,0));
		$this->assertSame('1 TB', format_bytes(1000000000000,0));
		$this->assertSame('1 PB', format_bytes(1000000000000000,0));
		$this->assertSame('8 PB', format_bytes(9000000000000000,0));
	}

	public function testFormatToBytes()
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

	public function testFormatPhone()
	{
		$this->assertSame('+6281802596094', format_phone('081802596094'));
		$this->assertSame('+6281802596094', format_phone('+6281802596094'));
		$this->assertSame('+6281802596094', format_phone('0818 0259 6094'));
		$this->assertSame('+6281802596094', format_phone('0818-025 960-94'));
		$this->assertSame('+62271715877', format_phone('(0271) 715 877'));
		$this->assertSame('+65271715877', format_phone('(0271) 715 877','+65'));
	}

	public function testFormatDateRange()
	{
		$this->assertSame('3 March 2015', format_date_range('2015-03-03'));
		$this->assertSame('3 March 2015', format_date_range(null,'2015-03-03'));
		$this->assertSame('3 Mar 15', format_date_range('2015-03-03','',false));
		$this->assertSame('3 Mar 15', format_date_range(null,'2015-03-03',false));
		$this->assertSame('3 March 2015', format_date_range('2015-03-03','2015-03-03'));
		$this->assertSame('3 Mar 15', format_date_range('2015-03-03','2015-03-03',false));
		$this->assertSame('3-5 March 2015', format_date_range('2015-03-03','2015-03-05'));
		$this->assertSame('3-5 Mar 15', format_date_range('2015-03-03','2015-03-05',false));
		$this->assertSame('3-5 March 2015', format_date_range('2015-03-05','2015-03-03'));
		$this->assertSame('3-5 Mar 15', format_date_range('2015-03-05','2015-03-03',false));
		$this->assertSame('3 March - 3 April 2015', format_date_range('2015-03-03','2015-04-03'));
		$this->assertSame('3 Mar - 3 Apr 15', format_date_range('2015-03-03','2015-04-03',false));
		$this->assertSame('3 March - 5 April 2015', format_date_range('2015-03-03','2015-04-05'));
		$this->assertSame('3 Mar - 5 Apr 15', format_date_range('2015-03-03','2015-04-05',false));
		$this->assertSame('3 March 2015 - 3 March 2016', format_date_range('2015-03-03','2016-03-03'));
		$this->assertSame('3 Mar 15 - 3 Mar 16', format_date_range('2015-03-03','2016-03-03',false));
		$this->assertSame('3 March 2015 - 3 April 2016', format_date_range('2015-03-03','2016-04-03'));
		$this->assertSame('3 Mar 15 - 3 Apr 16', format_date_range('2015-03-03','2016-04-03',false));
	}

	public function testFormatHashSlug()
	{
		date_default_timezone_set("Asia/Jakarta");
		$this->assertSame('6O_IoS', format_slug_hash(1,strtotime('1984-03-22')));
		$this->assertSame('YO_IoS', format_slug_hash(2,strtotime('1984-03-22')));
		$this->assertSame('HO_IoS', format_slug_hash(3,strtotime('1984-03-22')));
		$this->assertSame('4XBzGc', format_slug_hash(1,strtotime('1986-10-03')));
		$this->assertSame('RXBzGc', format_slug_hash(2,strtotime('1986-10-03')));
		$this->assertSame('FXBzGc', format_slug_hash(3,strtotime('1986-10-03')));
	}

	public function testFormatDuration()
	{
		$this->assertSame('1 day', format_duration('2015-05-15 11:22:22', '2015-05-16 11:22:22'));
		$this->assertSame('2 days', format_duration('2015-05-15 11:22:22', '2015-05-17 11:22:22'));
		$this->assertSame('1 day 1 hour', format_duration('2015-05-15 11:22:22', '2015-05-16 12:22:22'));
		$this->assertSame('1 day 2 hours', format_duration('2015-05-15 11:22:22', '2015-05-16 13:22:22'));
		$this->assertSame('2 days 1 hour', format_duration('2015-05-15 11:22:22', '2015-05-17 12:22:22'));
		$this->assertSame('2 days 2 hours', format_duration('2015-05-15 11:22:22', '2015-05-17 13:22:22'));
		$this->assertSame('1 day 1 hour 1 minute', format_duration('2015-05-15 11:22:22', '2015-05-16 12:23:22'));
		$this->assertSame('1 day 1 hour 2 minutes', format_duration('2015-05-15 11:22:22', '2015-05-16 12:24:22'));
		$this->assertSame('1 day 2 hours 1 minute', format_duration('2015-05-15 11:22:22', '2015-05-16 13:23:22'));
		$this->assertSame('1 day 1 minute', format_duration('2015-05-15 11:22:22', '2015-05-16 11:23:22'));
		$this->assertSame('1 day 2 minutes', format_duration('2015-05-15 11:22:22', '2015-05-16 11:24:22'));
		$this->assertSame('2 days 2 minutes', format_duration('2015-05-15 11:22:22', '2015-05-17 11:24:22'));
		$this->assertSame('1 day 2 hours 1 minute', format_duration('2015-05-15 11:22:22', '2015-05-16 13:23:25'));
		$this->assertSame('1 day', format_duration('2015-05-15 11:22:22', '2015-05-16 11:22:25'));
		$this->assertSame('1 second', format_duration('2015-05-15 11:22:22', '2015-05-15 11:22:23'));
		$this->assertSame('5 seconds', format_duration('2015-05-15 11:22:22', '2015-05-15 11:22:27'));
		$this->assertSame('1 hour', format_duration('2015-05-15 11:22:22', '2015-05-15 12:22:22'));
		$this->assertSame('2 hours', format_duration('2015-05-15 11:22:22', '2015-05-15 13:22:22'));
		$this->assertSame('1 hour 1 minute', format_duration('2015-05-15 11:22:22', '2015-05-15 12:23:22'));
		$this->assertSame('1 hour 1 minute', format_duration('2015-05-15 11:22:22', '2015-05-15 12:23:26'));
		$this->assertSame('2 hours 1 minute', format_duration('2015-05-15 11:22:22', '2015-05-15 13:23:59'));
		$this->assertSame('1 minute', format_duration('2015-05-15 11:22:22', '2015-05-15 11:23:22'));
		$this->assertSame('2 minutes', format_duration('2015-05-15 11:22:22', '2015-05-15 11:24:22'));
		$this->assertSame('2 minutes', format_duration('2015-05-15 11:22:22', '2015-05-15 11:24:46'));
		$this->assertSame('2 minutes 24 seconds', format_duration('2015-05-15 11:22:22', '2015-05-15 11:24:46', true));
		$this->assertSame('1 minute', format_duration('2015-05-15 11:22:22', '2015-05-15 11:23:22', true));
		$this->assertSame('1 second', format_duration('2015-05-15 11:22:22', '2015-05-15 11:22:23', true));
		$this->assertSame('5 seconds', format_duration('2015-05-15 11:22:22', '2015-05-15 11:22:27', true));
		$this->assertSame('1 day 2 hours 1 minute 3 seconds', format_duration('2015-05-15 11:22:22', '2015-05-16 13:23:25', true));
		$this->assertSame('1 day 3 seconds', format_duration('2015-05-15 11:22:22', '2015-05-16 11:22:25', true));
	}

    public function testFormatRemoveNewLine()
    {
        $this->assertSame('Hello World', format_remove_new_line("Hello
        World"));
        $this->assertSame('Hello World', format_remove_new_line("Hello


        World


        "));
        $this->assertSame('Hello World', format_remove_new_line("Hello        World


        "));
    }
}