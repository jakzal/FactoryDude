<?php

namespace spec\FactoryDude\Extension;

use PHPSpec2\Specification;

class FakerExtension implements Specification
{
    public function it_should_register_the_faker_service($world)
    {
        $world->isAnInstanceOf('FactoryDude\FactoryDude');

        $this->fakerExtension->register($world);

        $world->offsetGet('faker')->shouldBeAnInstanceOf('FactoryDude\Extension\LazyCall');
        $world->offsetGet('faker')->getSubject()->shouldBeAnInstanceOf('Faker\\Generator');
    }
}
