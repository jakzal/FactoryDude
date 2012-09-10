<?php

namespace FactoryDude\Extension;

use FactoryDude\FactoryDude;
use \Faker\Factory as FakerFactory;

class FakerExtension implements ExtensionInterface
{
    /**
     * @var string $locale
     */
    private $locale = null;

    /**
     * @param string $locale
     */
    public function __construct($locale = FakerFactory::DEFAULT_LOCALE)
    {
        $this->locale = $locale;
    }

    /**
     * @param FactoryDude $world
     */
    public function register(FactoryDude $world)
    {
        $world['faker'] = FakerFactory::create($this->locale);
    }
}
