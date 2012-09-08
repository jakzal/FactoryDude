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
     * @param array $values
     *
     * @return mixed
     */
    public function build(array $values = array())
    {
        $entity = new $this->className();
        $properties = array_merge($this->properties, $values);

        foreach ($properties as $propertyName => $value) {
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

    /**
     * @param string $methodName
     * @param array  $arguments
     *
     * @return TestDataBuilder
     */
    public function __call($methodName, $arguments)
    {
        if (0 === strpos($methodName, 'with') && count($arguments) === 1) {
            $propertyName = lcfirst(substr($methodName, 4));

            return $this->with($propertyName, $arguments[0]);
        }

        throw new \RuntimeException(sprintf('Method not found: "%s"', $methodName));
    }
}
