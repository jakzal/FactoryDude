<?php

namespace FactoryDude;

class FactoryDude
{
    /**
     * @param string $className
     *
     * @return TestDataBuilder
     */
    public function get($className)
    {
        return new TestDataBuilder($className);
    }
}
