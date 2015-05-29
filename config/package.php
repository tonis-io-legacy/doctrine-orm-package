<?php

use Doctrine\ORM\Mapping\Driver\AnnotationDriver;

return [
    'doctrine-orm' => [
        'default' => [
            /*
             * Connection settings. These vary slightly based on what driver you're using. See
             * http://docs.doctrine-project.org/projects/doctrine-dbal/en/latest/reference/configuration.html
             * for more details.
             */
            'connection' => [
                'user' => 'sqlite',
                'password' => 'sqlite',
                'path' => 'cache/db.sqlite3',
                'driver' => 'pdo_sqlite'
            ],

            /*
             * Default driver settings. This driver is the default if no namespaces from the
             * chained_drivers section below matches. This is typically where you'll put your
             * application drivers.
             */
            'default_driver' => [
                'class' => AnnotationDriver::class,
                'paths' => []
            ],

            /*
             * Chained driver settings. This package uses a driver chain by default so you must specify the namespace
             * as well as the driver settings. The key should be the namespace and the value can be a string
             * defining the service to invoke or an array defining the creation parameters.
             */
            'chained_drivers' => [
                /*
                 * 'My\Namespace' => 'driver.service.name',
                 * 'My\Namespace' => [
                 *    'class' => AnnotationDriver::class,
                 *    'paths' => ['my/namespace/my/entities']
                 * ]
                 */
            ],

            /*
             * Cache settings. In general you will want to change the namespace to suit your needs
             * as well as the caching based on your current environment.
             */
            'cache_namespace' => 'doctrine',
            'metadata_cache' => Doctrine\Common\Cache\ArrayCache::class,
            'query_cache' => Doctrine\Common\Cache\ArrayCache::class,
            'result_cache' => Doctrine\Common\Cache\ArrayCache::class,
            'sql_logger' => null,

            /*
             * Proxy settings. You should not modify these unless you have a good
             * reason for it.
             */
            'proxy_dir' => 'cache/doctrine/proxies',
            'proxy_namespace' => 'Tonis\\DoctrineORMPackage',

            'auto_generate_proxy_classes' => getenv('TONIS_DEBUG')
        ]
    ],
];
