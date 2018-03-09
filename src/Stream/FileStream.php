<?php

namespace Neat\Profiler\Stream;

use Neat\Profiler\Formatter;

/**
 * Class FileStream
 * @package Neat\Profiler\Stream
 */
class FileStream extends WriteStream
{
    const DEFAULT_FILENAME = 'logs.log';
    const FILE_MAX_SIZE = 1000000;
    /**
     * @var string
     */
    private $logsDir;

    /**
     * FileStream constructor.
     * @param string    $logsDir
     * @param Formatter $formatter
     */
    public function __construct($logsDir, Formatter $formatter)
    {
        parent::__construct($formatter);
        if (!is_dir($logsDir) || !is_writable($logsDir)) {
            throw new \InvalidArgumentException('Logs directory does not exist or is not writable');
        }

        $this->logsDir = realpath($logsDir);
    }

    /**
     * @param string $measurement
     * @param array  $data
     */
    public function write($measurement, array $data)
    {
        $fp = fopen($this->getFilePath(), 'ab');
        fwrite($fp, $this->getFormatter()->format($measurement, $data) . PHP_EOL);
        fclose($fp);
        @chmod($this->getFilePath(), 0664);
    }

    /**
     * @return string
     */
    private function getFilePath()
    {
        $defaultLogFile = $this->logsDir . DIRECTORY_SEPARATOR . self::DEFAULT_FILENAME;
        if (!file_exists($defaultLogFile)) {
            return $defaultLogFile;
        }

        if (filesize($defaultLogFile) >= self::FILE_MAX_SIZE) {
            rename($this->logsDir . DIRECTORY_SEPARATOR . 'logs.log', $this->logsDir . DIRECTORY_SEPARATOR . 'logs_' . $this->filesInDir() . '.log');
        }

        return $defaultLogFile;
    }

    /**
     * @return int
     */
    private function filesInDir()
    {
        return count(glob($this->logsDir . DIRECTORY_SEPARATOR . '*.log'));
    }
}
