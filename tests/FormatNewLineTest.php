<?php

namespace Matriphe\Format\Tests;

class FormatNewLineTest extends TestCase
{
    public function testRemoveNewLine()
    {
        $this->assertSame('Hello World', $this->format->removeNewLine('Hello
        World'));
        $this->assertSame('Hello World', $this->format->removeNewLine('Hello

        World

        '));
        $this->assertSame('Hello World', $this->format->removeNewLine('Hello        World

        '));
    }
}
