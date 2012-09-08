<?php

namespace FactoryDude;

interface TestDataBuilderInterface
{
    /**
     * @return mixed
     */
    public function build();

    /**
     * @return string
     */
    public function getClassName();

    /**
     * @param string $propertyName
     * @param mixed  $value
     *
     * @return TestDataBuilderInterface
     */
    public function with($propertyName, $value);
}
