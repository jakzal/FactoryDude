<?php

namespace spec\FactoryDude;

use PHPSpec2\Specification;

class FactoryDude implements Specification
{
    /**
     * @param ObjectStub $builder mock of FactoryDude\TestDataBuilder
     */
    public function it_should_act_as_a_container($builder)
    {
        // @todo check if it's possible to use ArrayAccess with PHPSpec ($this->factoryDude['User'])
        $this->factoryDude->offsetSet('User', function ($container) use ($builder) {
            return $builder;
        });

        $this->factoryDude->offsetGet('User')->shouldBe($builder);
    }
}
