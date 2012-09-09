<?php

namespace FactoryDude\TestDataBuilder;

class EntityBuilder extends TestDataBuilder
{
    /**
     * @param string $className
     */
    private $className = null;

    /**
     * @param string $className
     * @param array  $defaults
     */
    public function __construct($className, array $defaults = array())
    {
        $this->className = $className;

        parent::__construct($defaults);
    }

    /**
     * @param array $values
     *
     * @return mixed
     */
    public function build(array $values = array())
    {
        $defaults = array();
        foreach ($this->keys() as $key) {
            $defaults[$key] = $this[$key];
        }
        $properties = array_merge($defaults, $values);
        $entity = new $this->className();

        foreach ($properties as $propertyName => $value) {
            if (!property_exists($entity, $propertyName)) {
                throw new \RuntimeException(sprintf('Property does not exist: "%s"', $propertyName));
            }

            if (is_callable($value)) {
                $value = $value($this);
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
}
