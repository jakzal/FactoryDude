<?php

namespace FactoryDude;

use FactoryDude\Extension\ExtensionInterface;

class FactoryDude extends \Pimple
{
    public function addExtension(ExtensionInterface $extension)
    {
        $extension->register($this);
    }

    /**
     * @param string $id
     *
     * @return mixed
     */
    public function offsetGet($id)
    {
        $service = parent::offsetGet($id);

        if ($service instanceof TestDataBuilder\TestDataBuilderInterface) {
            $service['_world'] = $this;
        }

        return $service;
    }
}
