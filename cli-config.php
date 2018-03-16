<?php
use Doctrine\ORM\Tools\Console\ConsoleRunner;
$app = new \App\App();
return ConsoleRunner::createHelperSet($app->entityManager());
