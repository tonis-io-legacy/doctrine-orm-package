<?php

namespace Tonis\DoctrineORMPackage;

use Doctrine\ORM\EntityManager;
use Tonis\Di\Container;
use Tonis\Di\ServiceFactoryInterface;

final class EntityManagerFactory implements ServiceFactoryInterface
{
    /** @var string */
    private $config;
    /** @var string */
    private $connection;
    /** @var string */
    private $driver;

    /**
     * @param string $connection
     * @param string $config
     * @param string $driver
     */
    public function __construct($connection, $config, $driver)
    {
        $this->connection = $connection;
        $this->config = $config;
        $this->driver = $driver;
    }

    /**
     * @param Container $di
     * @return \Doctrine\ORM\EntityManager
     */
    public function createService(Container $di)
    {
        $configFactory = new ConfigurationFactory($this->config);
        $config = $configFactory->createService($di);

        $connectionFactory = new ConnectionFactory($this->connection, $config);
        $connection = $connectionFactory->createService($di);

        $driverFactory = new DriverFactory($this->driver);
        $driver = $driverFactory->createService($di);

        $config->setMetadataDriverImpl($driver);

        return EntityManager::create($connection, $config);
    }
}
