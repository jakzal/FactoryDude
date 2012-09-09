<?php

namespace FactoryDude\TestDataBuilder;

class ArrayBuilder extends TestDataBuilder
{
    /**
     * @param array $values
     *
     * @return mixed
     */
    public function build(array $values = array())
    {
        $values = array_merge($this->getValues(), $values);

        return $this->evaluateCallables($values);
    }

    /**
     * @return array
     */
    private function getValues()
    {
        $values = array();

        foreach ($this->keys() as $key) {
            $values[$key] = $this[$key];
        }

        return $values;
    }

    /**
     * @param array $values
     *
     * @return array
     */
    private function evaluateCallables(array $values)
    {
        return array_map(array($this, 'callIfCallable'), $values);
    }

    /**
     * @param mixed $value
     *
     * @return mixed
     */
    private function callIfCallable($value)
    {
        if (is_callable($value)) {
            return $value($this);
        }

        return $value;
    }
}
