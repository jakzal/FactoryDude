<?php

namespace spec\FactoryDude\Fixtures\Builder;

use FactoryDude\TestDataBuilderInterface;

class UserBuilder implements TestDataBuilderInterface
{
    public function build()
    {
    }

    public function getClassName()
    {
    }

    public function with($propertyName, $value)
    {
        return $this;
    }
}
