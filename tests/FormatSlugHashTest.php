<?php

namespace Matriphe\Format\Tests;

use Jenssegers\Date\Date;

class FormatSlugHashTest extends TestCase
{
    public function setUp()
    {
        parent::setUp();

        Date::setTestNow(Date::parse('2018-07-09 14:02:15'));
    }

    public function tearDown()
    {
        Date::setTestNow(null);

        parent::tearDown();
    }

    public function testHashSlug()
    {
        $this->assertSame('id', $this->format->getLocale());

        $this->assertSame('dqO5WB', $this->format->slugHash(1));
        $this->assertSame('BZVlRl', $this->format->slugHash(2));
        $this->assertSame('9WNGR1', $this->format->slugHash(3));
    }

    public function testHashSlugWithTime()
    {
        $this->assertSame('0ZR-K9', $this->format->slugHash(1, '1984-03-22'));
        $this->assertSame('XbqOE-', $this->format->slugHash(2, '1984-03-22'));
        $this->assertSame('lZdbX4', $this->format->slugHash(3, '1984-03-22'));
        $this->assertSame('8G-0J9', $this->format->slugHash(1, '1986-10-03'));
        $this->assertSame('bXqbgQ', $this->format->slugHash(2, '1986-10-03'));
        $this->assertSame('l93g9O', $this->format->slugHash(3, '1986-10-03'));
    }

    public function testHashSlugCustomAlphabet()
    {
        $alphabet = 'qwertyuioplkjhgfdsazxcvbnm';

        $this->assertSame('zxjwgj', $this->format->slugHash(1, null, $alphabet));
        $this->assertSame('aoxazw', $this->format->slugHash(2, null, $alphabet));
        $this->assertSame('qlrljr', $this->format->slugHash(3, null, $alphabet));

        $this->assertSame('ekvgyv', $this->format->slugHash(1, '1984-03-22', $alphabet));
        $this->assertSame('opqwxd', $this->format->slugHash(2, '1984-03-22', $alphabet));
        $this->assertSame('wyvzlv', $this->format->slugHash(3, '1984-03-22', $alphabet));
        $this->assertSame('gxrlmw', $this->format->slugHash(1, '1986-10-03', $alphabet));
        $this->assertSame('akvxnv', $this->format->slugHash(2, '1986-10-03', $alphabet));
        $this->assertSame('awerle', $this->format->slugHash(3, '1986-10-03', $alphabet));

        $alphabet = '1234567890!@#$%^';

        $this->assertSame('@79878', $this->format->slugHash(1, null, $alphabet));
        $this->assertSame('98068@', $this->format->slugHash(2, null, $alphabet));
        $this->assertSame('@7!%7!', $this->format->slugHash(3, null, $alphabet));

        $this->assertSame('69^89%', $this->format->slugHash(1, '1984-03-22', $alphabet));
        $this->assertSame('7%07%!', $this->format->slugHash(2, '1984-03-22', $alphabet));
        $this->assertSame('0!%@!@', $this->format->slugHash(3, '1984-03-22', $alphabet));
        $this->assertSame('706#08', $this->format->slugHash(1, '1986-10-03', $alphabet));
        $this->assertSame('#$!#$8', $this->format->slugHash(2, '1986-10-03', $alphabet));
        $this->assertSame('8$7!$!', $this->format->slugHash(3, '1986-10-03', $alphabet));
    }

    public function testHashSlugCustomLength()
    {
        $alphabet = 'qwertyuioplkjhgfdsazxcvbnm';
        $length = 12;

        $this->assertSame('nrgzxjwgjbmy', $this->format->slugHash(1, null, $alphabet, $length));
        $this->assertSame('nqzaoxazwlrg', $this->format->slugHash(2, null, $alphabet, $length));
        $this->assertSame('bwzqlrljrxvy', $this->format->slugHash(3, null, $alphabet, $length));

        $this->assertSame('poqekvgyvjlw', $this->format->slugHash(1, '1984-03-22', $alphabet, $length));
        $this->assertSame('beaopqwxdljz', $this->format->slugHash(2, '1984-03-22', $alphabet, $length));
        $this->assertSame('ajlwyvzlvxod', $this->format->slugHash(3, '1984-03-22', $alphabet, $length));
        $this->assertSame('amygxrlmwnzo', $this->format->slugHash(1, '1986-10-03', $alphabet, $length));
        $this->assertSame('edpakvxnvlnq', $this->format->slugHash(2, '1986-10-03', $alphabet, $length));
        $this->assertSame('kmjawerlepgo', $this->format->slugHash(3, '1986-10-03', $alphabet, $length));

        $alphabet = '1234567890!@#$%^';

        $this->assertSame('!9%@79878^6$', $this->format->slugHash(1, null, $alphabet, $length));
        $this->assertSame('%^698068@$#0', $this->format->slugHash(2, null, $alphabet, $length));
        $this->assertSame('^#$@7!%7!096', $this->format->slugHash(3, null, $alphabet, $length));

        $this->assertSame('#@069^89%^$7', $this->format->slugHash(1, '1984-03-22', $alphabet, $length));
        $this->assertSame('8^#7%07%!$0@', $this->format->slugHash(2, '1984-03-22', $alphabet, $length));
        $this->assertSame('%^$0!%@!@6#8', $this->format->slugHash(3, '1984-03-22', $alphabet, $length));
        $this->assertSame('!$9706#08%^#', $this->format->slugHash(1, '1986-10-03', $alphabet, $length));
        $this->assertSame('@^7#$!#$896%', $this->format->slugHash(2, '1986-10-03', $alphabet, $length));
        $this->assertSame('96#8$7!$!%^7', $this->format->slugHash(3, '1986-10-03', $alphabet, $length));
    }
}
