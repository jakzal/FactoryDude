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

        return $this->callIfCallable($values);
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
     * @param mixed $value
     *
     * @return mixed
     */
    private function callIfCallable($value)
    {
        if (is_callable($value)) {
            return $value($this);
        }

        if (is_array($value)) {
            return array_map(array($this, 'callIfCallable'), $value);
        }

        return $value;
    }
}
