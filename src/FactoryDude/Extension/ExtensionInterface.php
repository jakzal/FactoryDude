<?php

namespace FactoryDude\Extension;

use FactoryDude\FactoryDude;

interface ExtensionInterface
{
    /**
     * @param FactoryDude $world
     */
    public function register(FactoryDude $world);
}
