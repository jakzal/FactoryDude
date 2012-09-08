<?php

namespace spec\FactoryDude\Fixtures\Builder;

use FactoryDude\TestDataBuilderInterface;

class UserBuilder implements TestDataBuilderInterface
{
    public function __construct($className)
    {
    }

    public function build(array $values = array())
    {
    }

    public function with($propertyName, $value)
    {
        return $this;
    }
}
