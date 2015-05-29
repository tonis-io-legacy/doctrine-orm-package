<?php

return [
    'doctrine-orm' => [
        'main' => [
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
             * Driver settings. This package uses a driver chain by default so you must specify the namespace
             * as well as the driver settings. The key should be the namespace and the value can be a string
             * defining the service to invoke or an array defining the creation parameters.
             */
            'drivers' => [
                /*
                 * 'My\Namespace' => 'my.namespace.driver',
                 * 'My\Namespace' => [
                 *    'type' => 'annotation',
                 *    'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                 *    'paths' => 'my/namespace/my/entities'
                 * ]
                 */
            ],

            /*
             * Cache settings. In general you will want to change the namespace to suit your needs
             * as well as the caching based on your current environment.
             */
            'cache_namespace' => 'doctrine',
            'metadata_cache' => 'doctrine.cache.array',
            'query_cache' => 'doctrine.cache.array',
            'result_cache' => 'doctrine.cache.array',
            'sql_logger' => isset($_ENV['debug']) ? 'doctrine-orm.main.logger' : null,

            /*
             * Proxy settings. You should not modify these unless you have a good
             * reason for it.
             */
            'proxy_dir' => 'cache/doctrine/proxies',
            'proxy_namespace' => 'DoctrineORMPackage',

            'auto_generate_proxy_classes' => isset($_ENV['debug']) ? (bool) $_ENV['debug'] : true
        ]
    ],
];
