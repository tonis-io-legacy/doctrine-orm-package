<?php

namespace Tonis\DoctrineORMPackage;

use Doctrine\Common\Persistence\Mapping\Driver\MappingDriverChain;
use Tonis\Di\Container;
use Tonis\DoctrinePackage\DriverFactory as DoctrineDriverFactory;
use Tonis\Di\ServiceFactoryInterface;

final class DriverFactory implements ServiceFactoryInterface
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
     * @param Container $di
     * @return \Doctrine\ORM\Configuration
     */
    public function createService(Container $di)
    {
        $driver = new MappingDriverChain();
        $config = $di['doctrine-orm'][$this->name];

        if (isset($config['default_driver']) && !empty($config['default_driver'])) {
            $driver->setDefaultDriver((new DoctrineDriverFactory($config['default_driver']))->createService($di));
        }

        foreach ($config['chained_drivers'] as $namespace => $spec) {
            if (empty($spec)) {
                continue;
            }
            $driver->addDriver((new DoctrineDriverFactory($spec))->createService($di), $namespace);
        }

        return $driver;
    }
}
