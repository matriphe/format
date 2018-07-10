<?php

namespace Matriphe\Format\Tests\Helpers;

use Jenssegers\Date\Date;
use Locale;

class FormatSlugHashTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Locale::setDefault('id_ID');
        date_default_timezone_set($this->tz);

        Date::setTestNow(Date::parse('2018-07-09 14:02:15'));

        require_once(__DIR__.'/../../src/functions.php');
    }

    public function tearDown()
    {
        Date::setTestNow(null);

        parent::tearDown();
    }

    public function testHashSlug()
    {
        $this->assertSame('id', $this->format->getLocale());

        $this->assertSame('dqO5WB', format_slug_hash(1));
        $this->assertSame('BZVlRl', format_slug_hash(2));
        $this->assertSame('9WNGR1', format_slug_hash(3));
    }

    public function testHashSlugWithTime()
    {
        $this->assertSame('0ZR-K9', format_slug_hash(1, '1984-03-22'));
        $this->assertSame('XbqOE-', format_slug_hash(2, '1984-03-22'));
        $this->assertSame('lZdbX4', format_slug_hash(3, '1984-03-22'));
        $this->assertSame('8G-0J9', format_slug_hash(1, '1986-10-03'));
        $this->assertSame('bXqbgQ', format_slug_hash(2, '1986-10-03'));
        $this->assertSame('l93g9O', format_slug_hash(3, '1986-10-03'));
    }

    public function testHashSlugCustomAlphabet()
    {
        $alphabet = 'qwertyuioplkjhgfdsazxcvbnm';

        $this->assertSame('zxjwgj', format_slug_hash(1, null, $alphabet));
        $this->assertSame('aoxazw', format_slug_hash(2, null, $alphabet));
        $this->assertSame('qlrljr', format_slug_hash(3, null, $alphabet));

        $this->assertSame('ekvgyv', format_slug_hash(1, '1984-03-22', $alphabet));
        $this->assertSame('opqwxd', format_slug_hash(2, '1984-03-22', $alphabet));
        $this->assertSame('wyvzlv', format_slug_hash(3, '1984-03-22', $alphabet));
        $this->assertSame('gxrlmw', format_slug_hash(1, '1986-10-03', $alphabet));
        $this->assertSame('akvxnv', format_slug_hash(2, '1986-10-03', $alphabet));
        $this->assertSame('awerle', format_slug_hash(3, '1986-10-03', $alphabet));

        $alphabet = '1234567890!@#$%^';

        $this->assertSame('@79878', format_slug_hash(1, null, $alphabet));
        $this->assertSame('98068@', format_slug_hash(2, null, $alphabet));
        $this->assertSame('@7!%7!', format_slug_hash(3, null, $alphabet));

        $this->assertSame('69^89%', format_slug_hash(1, '1984-03-22', $alphabet));
        $this->assertSame('7%07%!', format_slug_hash(2, '1984-03-22', $alphabet));
        $this->assertSame('0!%@!@', format_slug_hash(3, '1984-03-22', $alphabet));
        $this->assertSame('706#08', format_slug_hash(1, '1986-10-03', $alphabet));
        $this->assertSame('#$!#$8', format_slug_hash(2, '1986-10-03', $alphabet));
        $this->assertSame('8$7!$!', format_slug_hash(3, '1986-10-03', $alphabet));
    }

    public function testHashSlugCustomLength()
    {
        $alphabet = 'qwertyuioplkjhgfdsazxcvbnm';
        $length = 12;

        $this->assertSame('nrgzxjwgjbmy', format_slug_hash(1, null, $alphabet, $length));
        $this->assertSame('nqzaoxazwlrg', format_slug_hash(2, null, $alphabet, $length));
        $this->assertSame('bwzqlrljrxvy', format_slug_hash(3, null, $alphabet, $length));

        $this->assertSame('poqekvgyvjlw', format_slug_hash(1, '1984-03-22', $alphabet, $length));
        $this->assertSame('beaopqwxdljz', format_slug_hash(2, '1984-03-22', $alphabet, $length));
        $this->assertSame('ajlwyvzlvxod', format_slug_hash(3, '1984-03-22', $alphabet, $length));
        $this->assertSame('amygxrlmwnzo', format_slug_hash(1, '1986-10-03', $alphabet, $length));
        $this->assertSame('edpakvxnvlnq', format_slug_hash(2, '1986-10-03', $alphabet, $length));
        $this->assertSame('kmjawerlepgo', format_slug_hash(3, '1986-10-03', $alphabet, $length));

        $alphabet = '1234567890!@#$%^';

        $this->assertSame('!9%@79878^6$', format_slug_hash(1, null, $alphabet, $length));
        $this->assertSame('%^698068@$#0', format_slug_hash(2, null, $alphabet, $length));
        $this->assertSame('^#$@7!%7!096', format_slug_hash(3, null, $alphabet, $length));

        $this->assertSame('#@069^89%^$7', format_slug_hash(1, '1984-03-22', $alphabet, $length));
        $this->assertSame('8^#7%07%!$0@', format_slug_hash(2, '1984-03-22', $alphabet, $length));
        $this->assertSame('%^$0!%@!@6#8', format_slug_hash(3, '1984-03-22', $alphabet, $length));
        $this->assertSame('!$9706#08%^#', format_slug_hash(1, '1986-10-03', $alphabet, $length));
        $this->assertSame('@^7#$!#$896%', format_slug_hash(2, '1986-10-03', $alphabet, $length));
        $this->assertSame('96#8$7!$!%^7', format_slug_hash(3, '1986-10-03', $alphabet, $length));
    }
}
