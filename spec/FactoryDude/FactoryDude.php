<?php

namespace spec\FactoryDude;

use PHPSpec2\Specification;

class FactoryDude implements Specification
{
    public function it_should_return_test_data_builder()
    {
        $this->factoryDude
            ->get('spec\\FactoryDude\\Fixtures\\Entity\\User')
            ->shouldReturnAnInstanceOf('FactoryDude\\TestDataBuilder');
    }
}
