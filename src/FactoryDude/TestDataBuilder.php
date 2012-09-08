<?php

namespace FactoryDude;

class TestDataBuilder implements TestDataBuilderInterface
{
    /**
     * @param string $className
     */
    private $className = null;

    /**
     * @param array $properties
     */
    private $properties = array();

    /**
     * @param string $className
     */
    public function __construct($className)
    {
        $this->className = $className;
    }

    /**
     * @return mixed
     */
    public function build()
    {
        $entity = new $this->className();

        foreach ($this->properties as $propertyName => $value) {
            if (!property_exists($entity, $propertyName)) {
                throw new \RuntimeException();
            }

            if (is_callable($value)) {
                $value = call_user_func($value);
            }

            $property = new \ReflectionProperty($this->className, $propertyName);
            $property->setAccessible(true);
            $property->setValue($entity, $value);
        }

        return $entity;
    }

    /**
     * @return string
     */
    public function getClassName()
    {
        return $this->className;
    }

    /**
     * @param string $propertyName
     * @param mixed  $value
     *
     * @return TestDataBuilder
     */
    public function with($propertyName, $value)
    {
        $this->properties[$propertyName] = $value;

        return $this;
    }
}