<?php

use Doctrine\ORM\EntityManager;
use Tonis\Di\Container;
use Tonis\DoctrineORMPackage\EntityManagerFactory;

return function(Container $di) {
    $di->set(EntityManager::class, function(Container $di) {
        return (new EntityManagerFactory('default', 'default', 'default'))->createService($di);
    });
};
