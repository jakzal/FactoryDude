<?php

namespace spec\FactoryDude\TestDataBuilder\Fixtures\Builder;

use FactoryDude\TestDataBuilder\TestDataBuilderInterface;

class UserBuilder implements TestDataBuilderInterface
{
    public function build(array $values = array())
    {
    }

    public function with($propertyName, $value)
    {
        return $this;
    }
}
