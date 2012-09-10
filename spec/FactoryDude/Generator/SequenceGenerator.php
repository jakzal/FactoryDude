<?php

namespace spec\FactoryDude\Generator;

use PHPSpec2\Specification;

class SequenceGenerator implements Specification
{
    public function it_should_generate_string_sequence()
    {
        $this->sequenceGenerator->get()->shouldBe('1');
        $this->sequenceGenerator->get()->shouldBe('2');
        $this->sequenceGenerator->get()->shouldBe('3');
    }

    public function it_should_generate_string_sequence_for_given_format()
    {
        $this->sequenceGenerator->get('User $n')->shouldBe('User 1');
        $this->sequenceGenerator->get('User $n')->shouldBe('User 2');
        $this->sequenceGenerator->get('User $n')->shouldBe('User 3');
    }

    public function it_should_generate_separate_sequence_for_given_for_each_format()
    {
        $this->sequenceGenerator->get('User $n')->shouldBe('User 1');
        $this->sequenceGenerator->get('$n')->shouldBe('1');
        $this->sequenceGenerator->get('User $n $n')->shouldBe('User 1 1');
    }
}
