<?php

namespace Matriphe\Format\Tests;

class FormatDateTest extends TestCase
{
    public function testDateRange()
    {
        $this->assertSame('3 Maret 2015', $this->format->dateRange('2015-03-03'));
        $this->assertSame('3 Maret 2015', $this->format->dateRange(null, '2015-03-03'));
        $this->assertSame('3 Mar 15', $this->format->dateRange('2015-03-03', '', false));
        $this->assertSame('3 Mar 15', $this->format->dateRange(null, '2015-03-03', false));
        $this->assertSame('3 Maret 2015', $this->format->dateRange('2015-03-03', '2015-03-03'));
        $this->assertSame('3 Mar 15', $this->format->dateRange('2015-03-03', '2015-03-03', false));
        $this->assertSame('3-5 Maret 2015', $this->format->dateRange('2015-03-03', '2015-03-05'));
        $this->assertSame('3-5 Mar 15', $this->format->dateRange('2015-03-03', '2015-03-05', false));
        $this->assertSame('3-5 Maret 2015', $this->format->dateRange('2015-03-05', '2015-03-03'));
        $this->assertSame('3-5 Mar 15', $this->format->dateRange('2015-03-05', '2015-03-03', false));
        $this->assertSame('3 Maret - 3 April 2015', $this->format->dateRange('2015-03-03', '2015-04-03'));
        $this->assertSame('3 Mar - 3 Apr 15', $this->format->dateRange('2015-03-03', '2015-04-03', false));
        $this->assertSame('3 Maret - 5 April 2015', $this->format->dateRange('2015-03-03', '2015-04-05'));
        $this->assertSame('3 Mar - 5 Apr 15', $this->format->dateRange('2015-03-03', '2015-04-05', false));
        $this->assertSame('3 Maret 2015 - 3 Maret 2016', $this->format->dateRange('2015-03-03', '2016-03-03'));
        $this->assertSame('3 Mar 15 - 3 Mar 16', $this->format->dateRange('2015-03-03', '2016-03-03', false));
        $this->assertSame('3 Maret 2015 - 3 April 2016', $this->format->dateRange('2015-03-03', '2016-04-03'));
        $this->assertSame('3 Mar 15 - 3 Apr 16', $this->format->dateRange('2015-03-03', '2016-04-03', false));
    }

    public function testDateRangeFrance()
    {
        $locale = 'fr';

        $this->assertSame('3 mars 2015', $this->format->dateRange('2015-03-03', null, true, $locale));
        $this->assertSame('3 mars 2015', $this->format->dateRange(null, '2015-03-03', true, $locale));
        $this->assertSame('3 mar 15', $this->format->dateRange('2015-03-03', '', false, $locale));
        $this->assertSame('3 mar 15', $this->format->dateRange(null, '2015-03-03', false, $locale));
        $this->assertSame('3 mars 2015', $this->format->dateRange('2015-03-03', '2015-03-03', true, $locale));
        $this->assertSame('3 mar 15', $this->format->dateRange('2015-03-03', '2015-03-03', false, $locale));
        $this->assertSame('3-5 mars 2015', $this->format->dateRange('2015-03-03', '2015-03-05', true, $locale));
        $this->assertSame('3-5 mar 15', $this->format->dateRange('2015-03-03', '2015-03-05', false, $locale));
        $this->assertSame('3-5 mars 2015', $this->format->dateRange('2015-03-05', '2015-03-03', true, $locale));
        $this->assertSame('3-5 mar 15', $this->format->dateRange('2015-03-05', '2015-03-03', false, $locale));
        $this->assertSame('3 mars - 3 avril 2015', $this->format->dateRange('2015-03-03', '2015-04-03', true, $locale));
        $this->assertSame('3 mar - 3 avr 15', $this->format->dateRange('2015-03-03', '2015-04-03', false, $locale));
        $this->assertSame('3 mars - 5 avril 2015', $this->format->dateRange('2015-03-03', '2015-04-05', true, $locale));
        $this->assertSame('3 mar - 5 avr 15', $this->format->dateRange('2015-03-03', '2015-04-05', false, $locale));
        $this->assertSame('3 mars 2015 - 3 mars 2016', $this->format->dateRange('2015-03-03', '2016-03-03', true, $locale));
        $this->assertSame('3 mar 15 - 3 mar 16', $this->format->dateRange('2015-03-03', '2016-03-03', false, $locale));
        $this->assertSame('3 mars 2015 - 3 avril 2016', $this->format->dateRange('2015-03-03', '2016-04-03', true, $locale));
        $this->assertSame('3 mar 15 - 3 avr 16', $this->format->dateRange('2015-03-03', '2016-04-03', false, $locale));
    }

    public function testDuration()
    {
        $this->assertSame('1 hari', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 11:22:22'));
        $this->assertSame('2 hari', $this->format->duration('2015-05-15 11:22:22', '2015-05-17 11:22:22'));
        $this->assertSame('1 hari, 1 jam', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 12:22:22'));
        $this->assertSame('1 hari, 2 jam', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 13:22:22'));
        $this->assertSame('2 hari, 1 jam', $this->format->duration('2015-05-15 11:22:22', '2015-05-17 12:22:22'));
        $this->assertSame('2 hari, 2 jam', $this->format->duration('2015-05-15 11:22:22', '2015-05-17 13:22:22'));
        $this->assertSame('1 hari, 1 jam, 1 menit', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 12:23:22'));
        $this->assertSame('1 hari, 1 jam, 2 menit', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 12:24:22'));
        $this->assertSame('1 hari, 2 jam, 1 menit', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 13:23:22'));
        $this->assertSame('1 hari, 1 menit', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 11:23:22'));
        $this->assertSame('1 hari, 2 menit', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 11:24:22'));
        $this->assertSame('2 hari, 2 menit', $this->format->duration('2015-05-15 11:22:22', '2015-05-17 11:24:22'));
        $this->assertSame('1 hari, 2 jam, 1 menit, 3 detik', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 13:23:25'));
        $this->assertSame('1 hari, 3 detik', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 11:22:25'));
        $this->assertSame('1 detik', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 11:22:23'));
        $this->assertSame('5 detik', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 11:22:27'));
        $this->assertSame('1 jam', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 12:22:22'));
        $this->assertSame('2 jam', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 13:22:22'));
        $this->assertSame('1 jam, 1 menit', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 12:23:22'));
        $this->assertSame('1 jam, 1 menit, 4 detik', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 12:23:26'));
        $this->assertSame('2 jam, 1 menit, 37 detik', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 13:23:59'));
        $this->assertSame('1 menit', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 11:23:22'));
        $this->assertSame('2 menit', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 11:24:22'));
        $this->assertSame('2 menit, 24 detik', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 11:24:46'));

        $this->assertNull($this->format->duration(null, '2015-05-16 11:22:22'));
        $this->assertNull($this->format->duration('2015-05-15 11:22:22', null));
        $this->assertNull($this->format->duration('', '2015-05-16 11:22:22'));
        $this->assertNull($this->format->duration('2015-05-15 11:22:22', ''));
    }

    public function testDurationFrance()
    {
        $locale = 'fr';

        $this->assertSame('1 jour', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 11:22:22', $locale));
        $this->assertSame('2 jours', $this->format->duration('2015-05-15 11:22:22', '2015-05-17 11:22:22', $locale));
        $this->assertSame('1 jour, 1 heure', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 12:22:22', $locale));
        $this->assertSame('1 jour, 2 heures', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 13:22:22', $locale));
        $this->assertSame('2 jours, 1 heure', $this->format->duration('2015-05-15 11:22:22', '2015-05-17 12:22:22', $locale));
        $this->assertSame('2 jours, 2 heures', $this->format->duration('2015-05-15 11:22:22', '2015-05-17 13:22:22', $locale));
        $this->assertSame('1 jour, 1 heure, 1 minute', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 12:23:22', $locale));
        $this->assertSame('1 jour, 1 heure, 2 minutes', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 12:24:22', $locale));
        $this->assertSame('1 jour, 2 heures, 1 minute', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 13:23:22', $locale));
        $this->assertSame('1 jour, 1 minute', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 11:23:22', $locale));
        $this->assertSame('1 jour, 2 minutes', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 11:24:22', $locale));
        $this->assertSame('2 jours, 2 minutes', $this->format->duration('2015-05-15 11:22:22', '2015-05-17 11:24:22', $locale));
        $this->assertSame('1 jour, 2 heures, 1 minute, 3 secondes', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 13:23:25', $locale));
        $this->assertSame('1 jour, 3 secondes', $this->format->duration('2015-05-15 11:22:22', '2015-05-16 11:22:25', $locale));
        $this->assertSame('1 seconde', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 11:22:23', $locale));
        $this->assertSame('5 secondes', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 11:22:27', $locale));
        $this->assertSame('1 heure', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 12:22:22', $locale));
        $this->assertSame('2 heures', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 13:22:22', $locale));
        $this->assertSame('1 heure, 1 minute', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 12:23:22', $locale));
        $this->assertSame('1 heure, 1 minute, 4 secondes', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 12:23:26', $locale));
        $this->assertSame('2 heures, 1 minute, 37 secondes', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 13:23:59', $locale));
        $this->assertSame('1 minute', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 11:23:22', $locale));
        $this->assertSame('2 minutes', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 11:24:22', $locale));
        $this->assertSame('2 minutes, 24 secondes', $this->format->duration('2015-05-15 11:22:22', '2015-05-15 11:24:46', $locale));
    }
}
