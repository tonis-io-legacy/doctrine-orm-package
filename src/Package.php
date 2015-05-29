<?php

namespace Tonis\DoctrineORMPackage;

use Doctrine\ORM\EntityManager;
use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Tonis\Mvc\Package\AbstractPackage;
use Tonis\Mvc\TonisConsole;

class Package extends AbstractPackage
{
    /**
     * {@inheritDoc}
     */
    public function bootstrapConsole(TonisConsole $console)
    {
        $di = $console->getTonis()->getDi();

        $console->setHelperSet(ConsoleRunner::createHelperSet($di->get(EntityManager::class)));
        ConsoleRunner::addCommands($console);
    }
}
