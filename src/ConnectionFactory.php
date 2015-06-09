<?php

namespace Tonis\DoctrineORMPackage;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Configuration;
use Interop\Container\ContainerInterface;
use Tonis\Di\ServiceFactoryInterface;

final class ConnectionFactory implements ServiceFactoryInterface
{
    /** @var \Doctrine\ORM\Configuration */
    private $config;
    /** @var string */
    private $name;

    /**
     * @param string $name
     * @param \Doctrine\ORM\Configuration $config
     */
    public function __construct($name, Configuration $config)
    {
        $this->name = $name;
        $this->config = $config;
    }

    /**
     * @param ContainerInterface $di
     * @return \Doctrine\DBAL\Connection
     */
    public function createService(ContainerInterface $di)
    {
        return DriverManager::getConnection($di['config']['doctrine-orm'][$this->name]['connection'], $this->config);
    }
}
