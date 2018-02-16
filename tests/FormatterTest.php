<?php

use Neat\Profiler\Formatter;
use PHPUnit\Framework\TestCase;

/**
 * Class FormatterTest
 */
class FormatterTest extends TestCase
{
    /**
     *
     */
    public function testFormattedString()
    {
        $formatter = new Formatter();
        self::assertRegExp('/test\,tag1\=tag2\,tag3\=tag4 field1=field2 \d+/', $formatter->format('test', [
            'tags' => ['tag1' => 'tag2', 'tag3' => 'tag4'],
            'fields' => ['field1' => 'field2']
        ]));
    }
}
