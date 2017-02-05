<?php

use Symfony\Component\Debug\Debug;

require_once __DIR__.'/../vendor/autoload.php';

$app = require __DIR__.'/../src/app.php';

if ($app['debug']) {
    Debug::enable();
}

require __DIR__.'/../config/prod.php';
$app->run();
