<?php

namespace spec\FactoryDude;

use PHPSpec2\Specification;

class FactoryDude implements Specification
{
    /**
     * @param ObjectStub $builder mock of FactoryDude\TestDataBuilder\TestDataBuilder
     */
    public function it_should_act_as_a_container($builder)
    {
        // @todo check if it's possible to use ArrayAccess with PHPSpec ($this->factoryDude['User'])
        $this->factoryDude->offsetSet('User', function ($container) use ($builder) {
            return $builder;
        });

        $this->factoryDude->offsetGet('User')->shouldReturn($builder);
    }

    /**
     * @param ObjectStub $builder mock of FactoryDude\TestDataBuilder\TestDataBuilder
     */
    public function it_should_pass_the_world_to_the_builder($builder)
    {
        // @todo until PHPSpec supports this...
        $builder = \Mockery::mock('FactoryDude\TestDataBuilder\TestDataBuilder');
        $builder->shouldReceive('offsetSet')->once()->with('_world', $this->factoryDude->getStubSubject());

        $this->factoryDude->offsetSet('User', function ($container) use ($builder) {
            return $builder;
        });

        $this->factoryDude->offsetGet('User');
    }

    public function it_should_not_pass_the_world_to_the_non_builder()
    {
        $this->factoryDude->offsetSet('User', function ($container) {
            $service = \Mockery::mock('stdClass');
            $service->shouldReceive('offsetSet')->never();

            return $service;
        });

        $this->factoryDude->offsetGet('User');
    }
}
