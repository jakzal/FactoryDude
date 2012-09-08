<?php

namespace FactoryDude;

class FactoryDude
{
    /**
     * @var array $aliases
     */
    private $aliases = array();

    /**
     * @param arra $builderClassNames
     */
    private $builderClassNames = array();

    /**
     * @param string $className A class name or its alias
     *
     * @return TestDataBuilderInterface
     */
    public function get($className)
    {
        $className = $this->getClassName($className);
        $builderClassName = $this->getBuilderClassName($className);

        return new $builderClassName($className);
    }

    /**
     * @param string $alias
     * @param string $className
     */
    public function setAlias($alias, $className)
    {
        $this->aliases[$alias] = $className;
    }

    /**
     * @param string $entityClassName
     * @param string $builderClassName
     */
    public function setBuilderClass($entityClassName, $builderClassName)
    {
        $builderClass = new \ReflectionClass($builderClassName);
        if (!$builderClass->implementsInterface('FactoryDude\TestDataBuilderInterface')) {
            throw new \RuntimeException('Builder has to implement FactoryDude\TestDataBuilderInterface');
        }

        $this->builderClassNames[$entityClassName] = $builderClassName;
    }

    /**
     * @param string $aliasOrClassName
     *
     * @return string
     */
    protected function getClassName($aliasOrClassName)
    {
        $className = isset($this->aliases[$aliasOrClassName]) ? $this->aliases[$aliasOrClassName] : $aliasOrClassName;

        if (!class_exists($className)) {
            throw new \RuntimeException(sprintf('Unknown class or alias: "%s"', $className));
        }

        return $className;
    }

    /**
     * @param string $builderClassName
     *
     * @return string
     */
    protected function getBuilderClassName($className)
    {
        $builderClassName = '\\FactoryDude\\TestDataBuilder';

        if (isset($this->builderClassNames[$className])) {
             $builderClassName = $this->builderClassNames[$className];
        }

        return $builderClassName;
    }
}
