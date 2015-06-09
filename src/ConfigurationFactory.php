<?php

namespace Tonis\DoctrineORMPackage;

use Doctrine\ORM\Configuration;
use Interop\Container\ContainerInterface;
use Tonis\Di\ContainerUtil;
use Tonis\Di\ServiceFactoryInterface;

final class ConfigurationFactory implements ServiceFactoryInterface
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
     * @param ContainerInterface $di
     * @return \Doctrine\ORM\Configuration
     */
    public function createService(ContainerInterface $di)
    {
        $params = $di['config']['doctrine-orm'][$this->name];
        
        $config = new Configuration();
        $config->setMetadataCacheImpl(ContainerUtil::get($di, $params['metadata_cache']));
        $config->setQueryCacheImpl(ContainerUtil::get($di, $params['query_cache']));
        $config->setResultCacheImpl(ContainerUtil::get($di, $params['result_cache']));
        $config->setProxyDir($params['proxy_dir']);
        $config->setProxyNamespace($params['proxy_namespace']);
        $config->setAutoGenerateProxyClasses($params['auto_generate_proxy_classes']);
        
        if (isset($params['sql_logger'])) {
            $config->setSQLLogger(ContainerUtil::get($di, $params['sql_logger']));
        }
        
        return $config;
    }
}
