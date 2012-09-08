<?php

namespace spec\FactoryDude;

use PHPSpec2\Specification;

class TestDataBuilder implements Specification
{
    public function described_with()
    {
        $this->testDataBuilder->isAnInstanceOf('FactoryDude\\TestDataBuilder', array(
            'spec\\FactoryDude\\Fixtures\\Entity\\User'
        ));
    }

    public function it_should_return_class_name()
    {
        $this->testDataBuilder->getClassName()
            ->shouldBe('spec\\FactoryDude\\Fixtures\\Entity\\User');
    }

    public function it_should_create_an_entity_with_defaults()
    {
        $entity = $this->testDataBuilder->build();

        $entity->shouldBeAnInstanceOf('spec\\FactoryDude\\Fixtures\\Entity\\User');
        $entity->getId()->shouldReturn(null);
        $entity->getName()->shouldReturn('Anonymous');
        $entity->getCreatedAt()->shouldReturn(null);
    }

    public function it_should_set_up_public_entity_properties()
    {
        $entity = $this->testDataBuilder->with('name', 'Kuba')->build();

        $entity->getName()->shouldReturn('Kuba');
    }

    public function it_should_set_up_private_entity_properties()
    {
        $date = new \DateTime('-1 day');
        $entity = $this->testDataBuilder
            ->with('id', 13)
            ->with('createdAt', $date)
            ->build();

        $entity->getId()->shouldReturn(13);
        $entity->getCreatedAt()->shouldReturn($date);
    }

    public function it_should_complain_if_entity_property_does_not_exist()
    {
        $this->testDataBuilder
            ->with('gender', 'male')
            ->shouldThrow('RuntimeException')
            ->during('build');
    }

    public function it_should_call_a_callable_when_building_entity()
    {
        $this->testDataBuilder->with('name', function () { static $i = 1; return 'Jakub '.($i++); });

        $entity1 = $this->testDataBuilder->build();
        $entity2 = $this->testDataBuilder->build();

        $entity1->getName()->shouldReturn('Jakub 1');
        $entity2->getName()->shouldReturn('Jakub 2');
    }
}