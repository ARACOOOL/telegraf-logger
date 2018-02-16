<?php

namespace Neat\Profiler;

/**
 * Class Formatter
 * @package Neat\Profiler
 */
class Formatter
{
    /**
     * @param string $measurement
     * @param array  $data
     *  tags:
     *      - [tag_name1: tag_value1]
     *      - [tag_name2: tag_value2]
     *  fields:
     *      - [field_name2: field_value2]
     *      - [field_name2: field_value2]
     * @return string
     */
    public function format($measurement, array $data)
    {
        return $measurement . ',' . implode(',', $this->createKeyValueString($data['tags'])) . ' ' . implode(',', $this->createKeyValueString($data['fields'])) . ' ' . Nanotime::now()->nanotime();
    }

    /**
     * @param array $data
     * @return array
     */
    private function createKeyValueString(array $data)
    {
        $result = [];
        foreach ($data as $key => $val) {
            $result[] = $key . '=' . $val;
        }
        return $result;
    }
}