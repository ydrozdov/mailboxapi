<?php

use Silex\Application;
use Silex\Provider\ServiceControllerServiceProvider;
use Silex\Provider\SecurityServiceProvider;

$app = new Application();
$app->register(new ServiceControllerServiceProvider());
$app->register(new SecurityServiceProvider(), array(
    'security.firewalls' => 
    array(
    'admin' => array(
        'pattern' => '^/api',
        'http' => true,
        'users' => array(
            // raw password is foo
            'admin' => array('ROLE_ADMIN', '$2y$10$3i9/lVd8UOFIJ6PAMFt8gu3/r5g0qeCJvoSlLCsvMTythye19F77a'),
        ),
    ))));

$app->mount('/api', new \Mailbox\Controller\MainControllerProvider());

return $app;
