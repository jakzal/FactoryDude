<?php

namespace FactoryDude\TestDataBuilder;

abstract class TestDataBuilder extends \Pimple implements TestDataBuilderInterface
{
    /**
     * @param string $propertyName
     * @param mixed  $value
     *
     * @return TestDataBuilder
     */
    public function with($propertyName, $value)
    {
        $this[$propertyName] = $value;

        return $this;
    }

    /**
     * @param string $methodName
     * @param array  $arguments
     *
     * @return TestDataBuilder
     */
    public function __call($methodName, $arguments)
    {
        if (0 === strpos($methodName, 'with') && count($arguments) === 1) {
            $propertyName = lcfirst(substr($methodName, 4));

            return $this->with($propertyName, $arguments[0]);
        }

        throw new \RuntimeException(sprintf('Method not found: "%s"', $methodName));
    }
}
