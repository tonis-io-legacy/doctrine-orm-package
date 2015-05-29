<?php

namespace Spiffy\DoctrineORMPackage;

use Doctrine\ORM\Tools\Console\ConsoleRunner;
use Spiffy\Framework\AbstractPackage;
use Spiffy\Framework\ConsoleApplication;

class Package extends AbstractPackage
{
    /**
     * {@inheritDoc}
     */
    public function bootstrapConsole(ConsoleApplication $console)
    {
        $app = $console->getApplication();
        $i = $app->getInjector();

        $console->setHelperSet(ConsoleRunner::createHelperSet($i->nvoke('doctrine-orm.main')));
        ConsoleRunner::addCommands($console);
    }
}
