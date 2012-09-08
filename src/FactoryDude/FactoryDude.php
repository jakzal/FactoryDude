<?php

namespace FactoryDude;

class FactoryDude
{
    /**
     * @var array $aliases
     */
    private $aliases = array();

    /**
     * @param string $className A class name or its alias
     *
     * @return TestDataBuilder
     */
    public function get($className)
    {
        $className = isset($this->aliases[$className]) ? $this->aliases[$className] : $className;

        if (!class_exists($className)) {
            throw new \RuntimeException(sprintf('Unknown class or alias: "%s"', $className));
        }

        return new TestDataBuilder($className);
    }

    /**
     * @param string $alias
     * @param string $className
     */
    public function setAlias($alias, $className)
    {
        $this->aliases[$alias] = $className;
    }
}
