<?php

namespace App;

use App\Services\SupportService;

/**
 * Factory para la instanciación de objetos, donde se prueban mejoras a la hora
 * de establecer cuales instancias serán reales y cuales mocks.
 */
class ObjectFactoryV2
{
    private static $factoryInstance;
    private $objectInstances;

    private function __construct()
    {
        $this->objectInstances = [];
    }

    public static function getInstance(): ObjectFactoryV2
    {
        if (!ObjectFactoryV2::$factoryInstance) {
            ObjectFactoryV2::$factoryInstance = new ObjectFactoryV2();
        }
        return ObjectFactoryV2::$factoryInstance;
    }

    public function getSupportService()
    {
        if (!$this->hasInstance(SupportService::class)) {
            $this->setInstance(SupportService::class, new SupportService());
        }
        return $this->objectInstances[SupportService::class];
    }

    public function hasInstance($class)
    {
        return array_key_exists($class, $this->objectInstances);
    }

    public function setInstance($class, $instance)
    {
        $this->objectInstances[$class] = $instance;
    }
}
