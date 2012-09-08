<?php

namespace spec\FactoryDude\Fixtures\Builder;

use FactoryDude\TestDataBuilderInterface;

class UserBuilder implements TestDataBuilderInterface
{
    public function __construct($className)
    {
    }

    public function build()
    {
    }

    public function with($propertyName, $value)
    {
        return $this;
    }
}
