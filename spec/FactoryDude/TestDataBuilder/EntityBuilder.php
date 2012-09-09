<?php

namespace spec\FactoryDude\TestDataBuilder;

use PHPSpec2\Specification;

class EntityBuilder implements Specification
{
    public function described_with()
    {
        $this->entityBuilder->isAnInstanceOf('FactoryDude\\TestDataBuilder\\EntityBuilder', array(
            'spec\\FactoryDude\\TestDataBuilder\\Fixtures\\Entity\\User'
        ));
    }

    public function it_should_return_a_class_name()
    {
        $this->entityBuilder->getClassName()
            ->shouldBe('spec\\FactoryDude\\TestDataBuilder\\Fixtures\\Entity\\User');
    }

    public function it_should_create_an_entity_with_defaults()
    {
        $entity = $this->entityBuilder->build();

        $entity->shouldBeAnInstanceOf('spec\\FactoryDude\\TestDataBuilder\\Fixtures\\Entity\\User');
        $entity->getId()->shouldReturn(null);
        $entity->getName()->shouldReturn('Anonymous');
        $entity->getCreatedAt()->shouldReturn(null);
    }

    public function it_should_set_up_public_entity_properties()
    {
        $entity = $this->entityBuilder->with('name', 'Kuba')->build();

        $entity->getName()->shouldReturn('Kuba');
    }

    public function it_should_set_up_private_entity_properties()
    {
        $date = new \DateTime('-1 day');
        $entity = $this->entityBuilder
            ->with('id', 13)
            ->with('createdAt', $date)
            ->build();

        $entity->getId()->shouldReturn(13);
        $entity->getCreatedAt()->shouldReturn($date);
    }

    public function it_should_set_up_defaults()
    {
        $this->entityBuilder->isAnInstanceOf('FactoryDude\\TestDataBuilder\\EntityBuilder', array(
            'spec\\FactoryDude\\TestDataBuilder\\Fixtures\\Entity\\User',
            array('id' => 14, 'name' => function ($container) { return 'Kuba'; })
        ));

        $entity = $this->entityBuilder->build();

        $entity->getId()->shouldReturn(14);
        $entity->getName()->shouldReturn('Kuba');
    }

    public function it_should_complain_if_entity_property_does_not_exist()
    {
        $this->entityBuilder
            ->with('gender', 'male')
            ->shouldThrow('RuntimeException')
            ->during('build');
    }

    public function it_should_call_a_callable_when_building_entity()
    {
        $this->entityBuilder->with('name', function () { static $i = 1; return 'Jakub '.($i++); });

        $entity1 = $this->entityBuilder->build();
        $entity2 = $this->entityBuilder->build();

        $entity1->getName()->shouldReturn('Jakub 1');
        $entity2->getName()->shouldReturn('Jakub 2');
    }

    public function it_should_accept_values_to_overwrite_defaults()
    {
        $entity = $this->entityBuilder
            ->with('id', 13)
            ->with('name', 'Jakub')
            ->build(array('name' => 'Kuba'));

        $entity->getId()->shouldReturn(13);
        $entity->getName()->shouldReturn('Kuba');
    }

    public function it_should_accept_callbacks_to_overwrite_defaults()
    {
        $entity = $this->entityBuilder
            ->with('name', 'Jakub')
            ->build(array('name' => function ($container) { return 'Kuba'; }));

        $entity->getName()->shouldReturn('Kuba');
    }
}
