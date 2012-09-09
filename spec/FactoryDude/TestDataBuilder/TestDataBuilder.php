<?php

namespace spec\FactoryDude\TestDataBuilder;

use PHPSpec2\Specification;

class TestDataBuilder implements Specification
{
    public function described_with()
    {
        $class = 'spec\\FactoryDude\\TestDataBuilder\\Fixtures\\Builder\\ExampleTestDataBuilder';
        $this->testDataBuilder->isAnInstanceOf($class);
    }

    public function it_should_accept_properties()
    {
        $this->testDataBuilder->with('name', 'Kuba');
        $this->testDataBuilder->offsetGet('name')->shouldBe('Kuba');
    }

    public function it_should_provide_fluent_interface()
    {
        $this->testDataBuilder->with('name', 'Kuba')->shouldReturn($this->testDataBuilder);
    }

    public function it_should_accept_properties_with_magic_methods()
    {
        $this->testDataBuilder->withName('Kuba');
        $this->testDataBuilder->offsetGet('name')->shouldBe('Kuba');
    }

    public function it_should_complain_for_unknown_method()
    {
        $this->testDataBuilder
            ->shouldThrow('RuntimeException', 'Method not found: "getId"')
            ->during('getId');
    }

    public function it_should_complain_with_wrong_number_of_parameters()
    {
        $this->testDataBuilder
            ->shouldThrow('RuntimeException', 'Method not found: "withId"')
            ->during('withId');

        $this->testDataBuilder
            ->shouldThrow('RuntimeException', 'Method not found: "withId"')
            ->during('withId', array(1, 2));
    }
}
