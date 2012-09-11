<?php

namespace FactoryDude\Extension;

class LazyCall
{
    /**
     * @var mixed $subject
     */
    private $subject = null;

    /**
     * @param mixed $subject
     */
    public function __construct($subject)
    {
        $this->subject = $subject;
    }

    /**
     * @return mixed
     */
    public function getSubject()
    {
        return $this->subject;
    }

    /**
     * @param string $name
     * @param array  $arguments
     *
     * @return \Closure
     */
    public function __call($name, $arguments)
    {
        $subject = $this->subject;

        return function () use ($subject, $name, $arguments) {
            return call_user_func_array(array($subject, $name), $arguments);
        };
    }

    /**
     * @param string $name
     *
     * @return \Closure
     */
    public function __get($name)
    {
        $subject = $this->subject;

        return function () use ($subject, $name) {
            return $subject->$name;
        };
    }
}
