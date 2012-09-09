<?php

namespace FactoryDude\TestDataBuilder;

class EntityBuilder extends ArrayBuilder
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
        $properties = parent::build($values);
        $entity = $this->buildEntity();
        $this->populateEntity($entity, $properties);

        return $entity;
    }

    /**
     * @return string
     */
    protected function getClassName()
    {
        return $this->className;
    }

    /**
     * @return mixed
     */
    protected function buildEntity()
    {
        return new $this->className();
    }

    /**
     * @param mixed $entity
     * @param array $properties
     */
    protected function populateEntity($entity, array $properties)
    {
        foreach ($properties as $propertyName => $value) {
            if (!property_exists($entity, $propertyName)) {
                throw new \RuntimeException(sprintf('Property does not exist: "%s"', $propertyName));
            }

            $property = new \ReflectionProperty($this->className, $propertyName);
            $property->setAccessible(true);
            $property->setValue($entity, $value);
        }
    }
}
