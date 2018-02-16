<?php

namespace Neat\Profiler\Stream;

use Neat\Profiler\Formatter;

/**
 * Class WriteStream
 * @package Neat\Profiler\Stream
 */
abstract class WriteStream implements WriteStreamInterface
{
    /**
     * @var Formatter
     */
    private $formatter;

    /**
     * WriteStream constructor.
     * @param Formatter $formatter
     */
    public function __construct(Formatter $formatter)
    {
        $this->formatter = $formatter;
    }

    /**
     * @return Formatter
     */
    public function getFormatter()
    {
        return $this->formatter;
    }
}