<?php

namespace FactoryDude\TestDataBuilder;

interface TestDataBuilderInterface
{
    /**
     * @param array $values
     *
     * @return mixed
     */
    public function build(array $values = array());

    /**
     * @param string $propertyName
     * @param mixed  $value
     *
     * @return TestDataBuilderInterface
     */
    public function with($propertyName, $value);
}
