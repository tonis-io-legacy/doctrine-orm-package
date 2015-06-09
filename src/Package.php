<?php

namespace Tonis\DoctrineORMPackage;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Tonis\Mvc\Package\AbstractPackage;
use Tonis\Mvc\TonisConsole;
use Interop\Container\ContainerInterface;

class Package extends AbstractPackage
{
    /**
     * {@inheritDoc}
     */
    public function bootstrapConsole(TonisConsole $console)
    {
        $di = $console->getTonis()->di();

        $console->setHelperSet(ConsoleRunner::createHelperSet($di->get(EntityManager::class)));
        ConsoleRunner::addCommands($console);
    }

    /**
     * {@inheritDoc}
     */
    public function configureServices(ContainerInterface $di)
    {
        if (!method_exists($di, 'set')) {
            return;
        }

        $di->set(EntityManager::class, function(ContainerInterface $di) {
            return (new EntityManagerFactory('default', 'default', 'default'))->createService($di);
        });
    }
}
