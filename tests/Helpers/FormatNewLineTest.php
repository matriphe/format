<?php

namespace Matriphe\Format\Tests\Helpers;

class FormatNewLineTest extends TestCase
{
    public function testRemoveNewLine()
    {
        $this->assertSame('Hello World', format_remove_new_line('Hello
        World'));
        $this->assertSame('Hello World', format_remove_new_line('Hello

        World

        '));
        $this->assertSame('Hello World', format_remove_new_line('Hello        World

        '));
    }
}
