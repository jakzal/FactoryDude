<?php

namespace spec\FactoryDude\Extension;

use PHPSpec2\Specification;

class LazyCall implements Specification
{
    private $subject = null;

    public function described_with()
    {
        $this->subject = new Subject();
        $this->lazyCall->isAnInstanceOf(
            'FactoryDude\Extension\LazyCall',
            array($this->subject)
        );
    }

    public function it_should_not_call_the_method_immediately()
    {
        $a = $this->lazyCall->callA('a');
        $b = $this->lazyCall->callB('b');

        $a->shouldBeAnInstanceOf('Closure');
        $b->shouldBeAnInstanceOf('Closure');

        $b->__invoke()->shouldBe('b1');
        $a->__invoke()->shouldBe('a2');
    }

    public function it_should_not_access_the_property_immediately()
    {
        $a = $this->lazyCall->a;
        $b = $this->lazyCall->b;

        $a->shouldBeAnInstanceOf('Closure');
        $b->shouldBeAnInstanceOf('Closure');

        $this->subject->a = 1;
        $this->subject->b = 2;

        $a->__invoke()->shouldBe(1);
        $b->__invoke()->shouldBe(2);
    }

    public function it_should_give_access_to_the_original_subject()
    {
        $this->lazyCall->getSubject()->shouldBeAnInstanceOf('spec\FactoryDude\Extension\Subject');
    }
}

class Subject
{
    private $i = 0;

    public $a = 0;

    public $b = 0;

    public function callA($name)
    {
        return $name.((string) ++$this->i);
    }

    public function callB($name)
    {
        return $name.((string) ++$this->i);
    }
}
