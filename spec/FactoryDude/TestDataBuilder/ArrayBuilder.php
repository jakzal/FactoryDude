<?php

namespace spec\FactoryDude\TestDataBuilder;

use PHPSpec2\Specification;

class ArrayBuilder implements Specification
{
    public function it_should_build_an_array()
    {
        $result = $this->arrayBuilder->build(array(
            'id' => 13,
            'name' => function ($container) { return 'Kuba'; }
        ));

        $result->shouldBe(array('id' => 13, 'name' => 'Kuba'));
    }

    public function it_should_build_an_empty_array()
    {
        $this->arrayBuilder->build()->shouldReturn(array());
    }

    public function it_should_build_nested_arrays()
    {
        $result = $this->arrayBuilder->build(array(
            'id' => 13,
            'groups' => array(
                2 => 'User',
                3 => function ($container) {
                    return 'Admin';
                }
            )
        ));

        $result->shouldBe(array('id' => 13, 'groups' => array(2 => 'User', 3 => 'Admin')));
    }

    public function it_should_use_prepared_values()
    {
        $result = $this->arrayBuilder
            ->with('id', 13)
            ->with('name', function ($container) { return 'Kuba'; })
            ->build();

        $result->shouldBe(array('id' => 13, 'name' => 'Kuba'));
    }

    public function it_should_combine_prepared_and_passed_values()
    {
        $result = $this->arrayBuilder
            ->with('id', 13)
            ->with('name', function ($container) { return 'Kuba'; })
            ->build(array('id' => 14, 'gender' => 'male'));

        $result->shouldBe(array('id' => 14, 'name' => 'Kuba', 'gender' => 'male'));
    }
}
