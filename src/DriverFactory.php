<?php

namespace Spiffy\DoctrineORMPackage;

use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Spiffy\DoctrinePackage\DriverFactory as DoctrineDriverFactory;
use Spiffy\Inject\Injector;
use Spiffy\Inject\ServiceFactory;

final class DriverFactory implements ServiceFactory
{
    /**
     * @var string
     */
    private $name;

    /**
     * @param string $name
     */
    public function __construct($name)
    {
        $this->name = $name;
    }

    /**
     * @param Injector $i
     * @return \Doctrine\ORM\Configuration
     */
    public function createService(Injector $i)
    {
        $driver = new MappingDriverChain();

        foreach ($i['doctrine-orm'][$this->name]['drivers'] as $namespace => $spec) {
            if (empty($spec)) {
                continue;
            }
            $factory = new DoctrineDriverFactory($spec);
            $driver->addDriver($factory->createService($i), $namespace);
        }

        return $driver;
    }
}
