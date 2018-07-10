<?php

namespace Matriphe\Format\Tests\Helpers;

class FormatDateTest extends TestCase
{
    public function testDateRange()
    {
        $this->assertSame('3 Maret 2015', format_date_range('2015-03-03'));
        $this->assertSame('3 Maret 2015', format_date_range(null, '2015-03-03'));
        $this->assertSame('3 Mar 15', format_date_range('2015-03-03', '', false));
        $this->assertSame('3 Mar 15', format_date_range(null, '2015-03-03', false));
        $this->assertSame('3 Maret 2015', format_date_range('2015-03-03', '2015-03-03'));
        $this->assertSame('3 Mar 15', format_date_range('2015-03-03', '2015-03-03', false));
        $this->assertSame('3-5 Maret 2015', format_date_range('2015-03-03', '2015-03-05'));
        $this->assertSame('3-5 Mar 15', format_date_range('2015-03-03', '2015-03-05', false));
        $this->assertSame('3-5 Maret 2015', format_date_range('2015-03-05', '2015-03-03'));
        $this->assertSame('3-5 Mar 15', format_date_range('2015-03-05', '2015-03-03', false));
        $this->assertSame('3 Maret - 3 April 2015', format_date_range('2015-03-03', '2015-04-03'));
        $this->assertSame('3 Mar - 3 Apr 15', format_date_range('2015-03-03', '2015-04-03', false));
        $this->assertSame('3 Maret - 5 April 2015', format_date_range('2015-03-03', '2015-04-05'));
        $this->assertSame('3 Mar - 5 Apr 15', format_date_range('2015-03-03', '2015-04-05', false));
        $this->assertSame('3 Maret 2015 - 3 Maret 2016', format_date_range('2015-03-03', '2016-03-03'));
        $this->assertSame('3 Mar 15 - 3 Mar 16', format_date_range('2015-03-03', '2016-03-03', false));
        $this->assertSame('3 Maret 2015 - 3 April 2016', format_date_range('2015-03-03', '2016-04-03'));
        $this->assertSame('3 Mar 15 - 3 Apr 16', format_date_range('2015-03-03', '2016-04-03', false));
    }

    public function testDateRangeFrance()
    {
        $locale = 'fr';

        $this->assertSame('3 mars 2015', format_date_range('2015-03-03', null, true, $locale));
        $this->assertSame('3 mars 2015', format_date_range(null, '2015-03-03', true, $locale));
        $this->assertSame('3 mar 15', format_date_range('2015-03-03', '', false, $locale));
        $this->assertSame('3 mar 15', format_date_range(null, '2015-03-03', false, $locale));
        $this->assertSame('3 mars 2015', format_date_range('2015-03-03', '2015-03-03', true, $locale));
        $this->assertSame('3 mar 15', format_date_range('2015-03-03', '2015-03-03', false, $locale));
        $this->assertSame('3-5 mars 2015', format_date_range('2015-03-03', '2015-03-05', true, $locale));
        $this->assertSame('3-5 mar 15', format_date_range('2015-03-03', '2015-03-05', false, $locale));
        $this->assertSame('3-5 mars 2015', format_date_range('2015-03-05', '2015-03-03', true, $locale));
        $this->assertSame('3-5 mar 15', format_date_range('2015-03-05', '2015-03-03', false, $locale));
        $this->assertSame('3 mars - 3 avril 2015', format_date_range('2015-03-03', '2015-04-03', true, $locale));
        $this->assertSame('3 mar - 3 avr 15', format_date_range('2015-03-03', '2015-04-03', false, $locale));
        $this->assertSame('3 mars - 5 avril 2015', format_date_range('2015-03-03', '2015-04-05', true, $locale));
        $this->assertSame('3 mar - 5 avr 15', format_date_range('2015-03-03', '2015-04-05', false, $locale));
        $this->assertSame('3 mars 2015 - 3 mars 2016', format_date_range('2015-03-03', '2016-03-03', true, $locale));
        $this->assertSame('3 mar 15 - 3 mar 16', format_date_range('2015-03-03', '2016-03-03', false, $locale));
        $this->assertSame('3 mars 2015 - 3 avril 2016', format_date_range('2015-03-03', '2016-04-03', true, $locale));
        $this->assertSame('3 mar 15 - 3 avr 16', format_date_range('2015-03-03', '2016-04-03', false, $locale));
    }

    public function testDuration()
    {
        $this->assertSame('1 hari', format_duration('2015-05-15 11:22:22', '2015-05-16 11:22:22'));
        $this->assertSame('2 hari', format_duration('2015-05-15 11:22:22', '2015-05-17 11:22:22'));
        $this->assertSame('1 hari, 1 jam', format_duration('2015-05-15 11:22:22', '2015-05-16 12:22:22'));
        $this->assertSame('1 hari, 2 jam', format_duration('2015-05-15 11:22:22', '2015-05-16 13:22:22'));
        $this->assertSame('2 hari, 1 jam', format_duration('2015-05-15 11:22:22', '2015-05-17 12:22:22'));
        $this->assertSame('2 hari, 2 jam', format_duration('2015-05-15 11:22:22', '2015-05-17 13:22:22'));
        $this->assertSame('1 hari, 1 jam, 1 menit', format_duration('2015-05-15 11:22:22', '2015-05-16 12:23:22'));
        $this->assertSame('1 hari, 1 jam, 2 menit', format_duration('2015-05-15 11:22:22', '2015-05-16 12:24:22'));
        $this->assertSame('1 hari, 2 jam, 1 menit', format_duration('2015-05-15 11:22:22', '2015-05-16 13:23:22'));
        $this->assertSame('1 hari, 1 menit', format_duration('2015-05-15 11:22:22', '2015-05-16 11:23:22'));
        $this->assertSame('1 hari, 2 menit', format_duration('2015-05-15 11:22:22', '2015-05-16 11:24:22'));
        $this->assertSame('2 hari, 2 menit', format_duration('2015-05-15 11:22:22', '2015-05-17 11:24:22'));
        $this->assertSame('1 hari, 2 jam, 1 menit, 3 detik', format_duration('2015-05-15 11:22:22', '2015-05-16 13:23:25'));
        $this->assertSame('1 hari, 3 detik', format_duration('2015-05-15 11:22:22', '2015-05-16 11:22:25'));
        $this->assertSame('1 detik', format_duration('2015-05-15 11:22:22', '2015-05-15 11:22:23'));
        $this->assertSame('5 detik', format_duration('2015-05-15 11:22:22', '2015-05-15 11:22:27'));
        $this->assertSame('1 jam', format_duration('2015-05-15 11:22:22', '2015-05-15 12:22:22'));
        $this->assertSame('2 jam', format_duration('2015-05-15 11:22:22', '2015-05-15 13:22:22'));
        $this->assertSame('1 jam, 1 menit', format_duration('2015-05-15 11:22:22', '2015-05-15 12:23:22'));
        $this->assertSame('1 jam, 1 menit, 4 detik', format_duration('2015-05-15 11:22:22', '2015-05-15 12:23:26'));
        $this->assertSame('2 jam, 1 menit, 37 detik', format_duration('2015-05-15 11:22:22', '2015-05-15 13:23:59'));
        $this->assertSame('1 menit', format_duration('2015-05-15 11:22:22', '2015-05-15 11:23:22'));
        $this->assertSame('2 menit', format_duration('2015-05-15 11:22:22', '2015-05-15 11:24:22'));
        $this->assertSame('2 menit, 24 detik', format_duration('2015-05-15 11:22:22', '2015-05-15 11:24:46'));

        $this->assertNull(format_duration(null, '2015-05-16 11:22:22'));
        $this->assertNull(format_duration('2015-05-15 11:22:22', null));
        $this->assertNull(format_duration('', '2015-05-16 11:22:22'));
        $this->assertNull(format_duration('2015-05-15 11:22:22', ''));
    }

    public function testDurationFrance()
    {
        $locale = 'fr';

        $this->assertSame('1 jour', format_duration('2015-05-15 11:22:22', '2015-05-16 11:22:22', $locale));
        $this->assertSame('2 jours', format_duration('2015-05-15 11:22:22', '2015-05-17 11:22:22', $locale));
        $this->assertSame('1 jour, 1 heure', format_duration('2015-05-15 11:22:22', '2015-05-16 12:22:22', $locale));
        $this->assertSame('1 jour, 2 heures', format_duration('2015-05-15 11:22:22', '2015-05-16 13:22:22', $locale));
        $this->assertSame('2 jours, 1 heure', format_duration('2015-05-15 11:22:22', '2015-05-17 12:22:22', $locale));
        $this->assertSame('2 jours, 2 heures', format_duration('2015-05-15 11:22:22', '2015-05-17 13:22:22', $locale));
        $this->assertSame('1 jour, 1 heure, 1 minute', format_duration('2015-05-15 11:22:22', '2015-05-16 12:23:22', $locale));
        $this->assertSame('1 jour, 1 heure, 2 minutes', format_duration('2015-05-15 11:22:22', '2015-05-16 12:24:22', $locale));
        $this->assertSame('1 jour, 2 heures, 1 minute', format_duration('2015-05-15 11:22:22', '2015-05-16 13:23:22', $locale));
        $this->assertSame('1 jour, 1 minute', format_duration('2015-05-15 11:22:22', '2015-05-16 11:23:22', $locale));
        $this->assertSame('1 jour, 2 minutes', format_duration('2015-05-15 11:22:22', '2015-05-16 11:24:22', $locale));
        $this->assertSame('2 jours, 2 minutes', format_duration('2015-05-15 11:22:22', '2015-05-17 11:24:22', $locale));
        $this->assertSame('1 jour, 2 heures, 1 minute, 3 secondes', format_duration('2015-05-15 11:22:22', '2015-05-16 13:23:25', $locale));
        $this->assertSame('1 jour, 3 secondes', format_duration('2015-05-15 11:22:22', '2015-05-16 11:22:25', $locale));
        $this->assertSame('1 seconde', format_duration('2015-05-15 11:22:22', '2015-05-15 11:22:23', $locale));
        $this->assertSame('5 secondes', format_duration('2015-05-15 11:22:22', '2015-05-15 11:22:27', $locale));
        $this->assertSame('1 heure', format_duration('2015-05-15 11:22:22', '2015-05-15 12:22:22', $locale));
        $this->assertSame('2 heures', format_duration('2015-05-15 11:22:22', '2015-05-15 13:22:22', $locale));
        $this->assertSame('1 heure, 1 minute', format_duration('2015-05-15 11:22:22', '2015-05-15 12:23:22', $locale));
        $this->assertSame('1 heure, 1 minute, 4 secondes', format_duration('2015-05-15 11:22:22', '2015-05-15 12:23:26', $locale));
        $this->assertSame('2 heures, 1 minute, 37 secondes', format_duration('2015-05-15 11:22:22', '2015-05-15 13:23:59', $locale));
        $this->assertSame('1 minute', format_duration('2015-05-15 11:22:22', '2015-05-15 11:23:22', $locale));
        $this->assertSame('2 minutes', format_duration('2015-05-15 11:22:22', '2015-05-15 11:24:22', $locale));
        $this->assertSame('2 minutes, 24 secondes', format_duration('2015-05-15 11:22:22', '2015-05-15 11:24:46', $locale));
    }
}
