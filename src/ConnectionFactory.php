<?php

namespace Spiffy\DoctrineORMPackage;

use Doctrine\DBAL\DriverManager;
use Doctrine\ORM\Configuration;
use Spiffy\Inject\Injector;
use Spiffy\Inject\ServiceFactory;

final class ConnectionFactory  implements ServiceFactory
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
     * @param Injector $i
     * @return \Doctrine\DBAL\Connection
     */
    public function createService(Injector $i)
    {
        return DriverManager::getConnection($i['doctrine-orm'][$this->name]['connection'], $this->config);
    }
}
