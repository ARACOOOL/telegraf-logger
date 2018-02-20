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
     * @var int
     */
    private $startMemory;
    /**
     * @var float
     */
    private $startTime;
    /**
     * @var array
     */
    private $data = ['tags' => [], 'fields' => []];
    /**
     * @var string
     */
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
        $this->stream->write($this->measurement, array_merge_recursive($this->data, [
            'tags'   => [
                'app' => $this->name
            ],
            'fields' => [
                'time_usage'   => microtime(true) - $this->startTime,
                'memory_usage' => memory_get_usage() - $this->startMemory
            ]
        ]));
    }

    /**
     * @param array $tags
     */
    public function addTags(array $tags)
    {
        $this->write(['tags' => $tags]);
    }

    /**
     * @param array $fields
     */
    public function addFields(array $fields)
    {
        $this->write(['fields' => $fields]);
    }

    /**
     * @param array $data
     */
    public function write(array $data)
    {
        $this->data = array_merge($this->data, $data);
    }
}