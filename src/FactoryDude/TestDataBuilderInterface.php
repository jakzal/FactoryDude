<?php

namespace FactoryDude;

interface TestDataBuilderInterface
{
    /**
     * @param string @className
     */
    public function __construct($className);

    /**
     * @return mixed
     */
    public function build();

    /**
     * @param string $propertyName
     * @param mixed  $value
     *
     * @return TestDataBuilderInterface
     */
    public function with($propertyName, $value);
}
