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
    private $startMemory;
    private $startTime;
    private $data;
    private $name;

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
     * @param $appName
     */
    public function start($appName)
    {
        $this->name        = $appName;
        $this->startTime   = microtime(true);
        $this->startMemory = memory_get_usage();
    }

    /**
     *
     */
    public function finish()
    {
        $this->stream->write($this->measurement, array_merge($this->data, [
            'app'          => $this->name,
            'time_usage'   => microtime(true) - $this->startTime,
            'memory_usage' => memory_get_usage() - $this->startMemory
        ]));
    }

    /**
     * @param array $data
     */
    public function write(array $data)
    {
        $this->data = array_merge($this->data, $data);
    }
}