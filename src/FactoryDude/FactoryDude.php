<?php

namespace FactoryDude;

class FactoryDude extends \Pimple
{
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
