<?php

namespace Neat\Profiler;

use Neat\Profiler\Stream\WriteStreamInterface;

/**
 * Class Profiler
 * @package Neat\Profiler
 */
class Profiler
{
    /**
     * @var string
     */
    private $measurement;
    /**
     * @var WriteStreamInterface
     */
    private $stream;

    /**
     * Profiler constructor.
     * @param string               $measurement
     * @param WriteStreamInterface $stream
     */
    public function __construct($measurement, WriteStreamInterface $stream)
    {
        $this->measurement = $measurement;
        $this->stream      = $stream;
    }

    /**
     * @param array $data
     */
    public function write(array $data)
    {
        $this->stream->write($this->measurement, $data);
    }
}