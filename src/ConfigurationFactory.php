<?php

namespace Spiffy\DoctrineORMPackage;

use Doctrine\ORM\Configuration;
use Spiffy\Inject\Injector;
use Spiffy\Inject\InjectorUtils;
use Spiffy\Inject\ServiceFactory;

final class ConfigurationFactory implements ServiceFactory
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
        $params = $i['doctrine-orm'][$this->name];
        
        $config = new Configuration();
        $config->setMetadataCacheImpl(InjectorUtils::get($i, $params['metadata_cache']));
        $config->setQueryCacheImpl(InjectorUtils::get($i, $params['query_cache']));
        $config->setResultCacheImpl(InjectorUtils::get($i, $params['result_cache']));
        $config->setProxyDir($params['proxy_dir']);
        $config->setProxyNamespace($params['proxy_namespace']);
        $config->setAutoGenerateProxyClasses($params['auto_generate_proxy_classes']);
        
        if (isset($params['sql_logger'])) {
            $config->setSQLLogger(InjectorUtils::get($i, $params['sql_logger']));
        }
        
        return $config;
    }
}
