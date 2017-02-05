<?php
require_once __DIR__.'/../vendor/autoload.php';

use Doctrine\ODM\MongoDB\Tools\Console\Helper\DocumentManagerHelper;
use Symfony\Component\Console\Helper\HelperSet;

use Symfony\Component\Console\Input\ArgvInput;

$input = new ArgvInput();
$env = $input->getParameterOption(array('--env', '-e'), getenv('SYMFONY_ENV') ?: 'prod');

$app = require __DIR__.'/../src/app.php';
require __DIR__.'/../config/'.$env.'.php';

$helperSet = new HelperSet(array(
    'dm' => new DocumentManagerHelper($app['doctrine.mongodb.dm']),
));

$appM = new \Symfony\Component\Console\Application('Doctrine MongoDB ODM');

if (isset($helperSet)) {
    $appM->setHelperSet($helperSet);
}

$appM->addCommands(array(
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateDocumentsCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateHydratorsCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateProxiesCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\GenerateRepositoriesCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\QueryCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\ClearCache\MetadataCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\CreateCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\DropCommand(),
    new \Doctrine\ODM\MongoDB\Tools\Console\Command\Schema\UpdateCommand(),
));

$appM->run();