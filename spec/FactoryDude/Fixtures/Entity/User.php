<?php

namespace spec\FactoryDude\Fixtures\Entity;

class User
{
    private $id = null;

    public $name = 'Anonymous';

    private $createdAt = null;

    public function getId()
    {
        return $this->id;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
