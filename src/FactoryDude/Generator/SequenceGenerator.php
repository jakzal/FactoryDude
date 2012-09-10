<?php

namespace FactoryDude\Generator;

class SequenceGenerator
{
    /**
     * @var array $sequences
     */
    private $sequences = array();

    /**
     * @param string $format
     *
     * @return string
     */
    public function get($format = '$n')
    {
        if (!isset($this->sequences[$format])) {
            $this->sequences[$format] = 1;
        }

        return str_replace('$n', $this->sequences[$format]++, $format);
    }
}
