<?php

namespace spec\FactoryDude;

use PHPSpec2\Specification;

class FactoryDude implements Specification
{
    public function it_should_return_test_data_builder()
    {
        $testDataBuilder = $this->factoryDude->get('spec\\FactoryDude\\Fixtures\\Entity\\User');

        $testDataBuilder->shouldBeAnInstanceOf('FactoryDude\\TestDataBuilder');
        $testDataBuilder->getClassName()->shouldBe('spec\\FactoryDude\\Fixtures\\Entity\\User');
    }

    public function it_should_return_data_builder_by_alias()
    {
        $this->factoryDude->setAlias('User', 'spec\\FactoryDude\\Fixtures\\Entity\\User');

        $testDataBuilder = $this->factoryDude->get('User');

        $testDataBuilder->shouldBeAnInstanceOf('FactoryDude\\TestDataBuilder');
        $testDataBuilder->getClassName()->shouldBe('spec\\FactoryDude\\Fixtures\\Entity\\User');
    }

    public function it_should_complain_if_class_is_unknown()
    {
        $this->factoryDude->shouldThrow('RuntimeException')
            ->during('get', array('spec\\FactoryDude\\Fixtures\\Entity\\Employee'));
    }

    public function it_should_complain_if_alias_is_unknown()
    {
        $this->factoryDude->shouldThrow('RuntimeException')->during('get', array('employee'));
    }
}
