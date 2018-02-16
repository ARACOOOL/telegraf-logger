<?php

namespace Neat\Profiler;

/**
 * Class Nanotime
 */
final class Nanotime
{
    const MICRO_DECIMAL_DIGITS = 6;
    const NANO_DECIMAL_DIGITS = 9;

    /**
     * @var int
     */
    private $mseconds;
    /**
     * @var int
     */
    private $seconds;

    /**
     * Nanotime constructor.
     * @param $seconds
     * @param $mseconds
     */
    private function __construct($seconds, $mseconds)
    {
        $this->seconds  = $seconds;
        $this->mseconds = $mseconds;
    }

    /**
     * @return int
     */
    public function nanotime()
    {
        return (int) ($this->seconds . str_pad($this->mseconds, self::NANO_DECIMAL_DIGITS, '0'));
    }

    /**
     * @return int
     */
    public function microtime()
    {
        return (int) ($this->seconds . substr($this->mseconds, 0, self::MICRO_DECIMAL_DIGITS));
    }

    /**
     * @return Nanotime
     */
    public static function now()
    {
        $microtime = microtime();
        list($mseconds, $seconds) = explode(' ', $microtime);
        return new self($seconds, substr($mseconds, 2));
    }
}