<?php

namespace FactoryDude\Extension;

use FactoryDude\FactoryDude;
use FactoryDude\Generator\SequenceGenerator;

class SequenceExtension
{
    /**
     * @param FactoryDude $world
     */
    public function register(FactoryDude $world)
    {
        $world['sequence'] = new LazyCall(new SequenceGenerator());
    }
}
