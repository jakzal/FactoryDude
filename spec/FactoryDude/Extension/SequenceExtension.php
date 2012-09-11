<?php

namespace spec\FactoryDude\Extension;

use PHPSpec2\Specification;

class SequenceExtension implements Specification
{
    public function it_should_register_the_sequence_service($world)
    {
        $world->isAnInstanceOf('FactoryDude\FactoryDude');

        $this->sequenceExtension->register($world);

        $world->offsetGet('sequence')->shouldBeAnInstanceOf('FactoryDude\Extension\LazyCall');
        $world->offsetGet('sequence')->getSubject()->shouldBeAnInstanceOf('FactoryDude\\Generator\\SequenceGenerator');
    }
}
