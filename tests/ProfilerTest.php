<?php

use Neat\Profiler\Formatter;
use Neat\Profiler\Profiler;
use Neat\Profiler\Stream\FileStream;
use PHPUnit\Framework\TestCase;

/**
 * Class ProfilerTest
 */
class ProfilerTest extends TestCase
{

    /**
     *
     */
    public function setUp()
    {
        mkdir($this->getLogsDir());
    }

    /**
     *
     */
    public function testAddTagsAndFields()
    {
        $profiler = new Profiler('test', new FileStream($this->getLogsDir(), new Formatter()));
        $profiler->addFields(['testField' => 'testFieldValue', 'testField2' => 'testFieldValue2']);
        $profiler->addTags(['testTag' => 'testTagValue', 'testTag2' => 'testTagValue2']);
    }

    /**
     *
     */
    public function tearDown()
    {
        $this->delTree($this->getLogsDir());
    }

    private function delTree($dir)
    {
        $files = array_diff(scandir($dir), array('.', '..'));
        foreach ($files as $file) {
            (is_dir("$dir/$file")) ? $this->delTree("$dir/$file") : unlink("$dir/$file");
        }
        return rmdir($dir);
    }

    /**
     * @return string
     */
    private function getLogsDir()
    {
        return __DIR__ . '/logs';
    }
}