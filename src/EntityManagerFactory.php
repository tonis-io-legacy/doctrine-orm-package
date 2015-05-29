<?php

namespace Spiffy\DoctrineORMPackage;

use Doctrine\DBAL\Logging\EchoSQLLogger;
use Doctrine\ORM\Cache\RegionsConfiguration;
use Doctrine\ORM\EntityManager;
use Spiffy\Inject\Injector;
use Spiffy\Inject\ServiceFactory;

final class EntityManagerFactory implements ServiceFactory
{
    /**
     * @var string
     */
    private $config;

    /**
     * @var string
     */
    private $connection;

    /**
     * @var string
     */
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
     * @param Injector $i
     * @return \Doctrine\ORM\EntityManager
     */
    public function createService(Injector $i)
    {
        $configFactory = new ConfigurationFactory($this->config);
        $config = $configFactory->createService($i);

        $connectionFactory = new ConnectionFactory($this->connection, $config);
        $connection = $connectionFactory->createService($i);

        $driverFactory = new DriverFactory($this->driver);
        $driver = $driverFactory->createService($i);

        $config->setMetadataDriverImpl($driver);

        return EntityManager::create($connection, $config);
    }
}
