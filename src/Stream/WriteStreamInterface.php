<?php

namespace Neat\Profiler\Stream;

/**
 * Class WriteStreamInterface
 * @package Neat\Profiler\Stream
 */
interface WriteStreamInterface
{
    /**
     * @param string $measurement
     * @param array  $data
     * @return mixed
     */
    public function write($measurement, array $data);
}