<?php 

namespace Mailbox\Controller;

use Silex\Application;
use Silex\Api\ControllerProviderInterface;

class MainControllerProvider implements ControllerProviderInterface
{
    public function connect(Application $app)
    {
        $controllers = $app['controllers_factory'];

        $controllers->get('/list/{page}', 'main.controller:listAction')
            ->value('page', 1)
            ->assert('page', '\d+');
        $controllers->get('/list/archived/{page}', 'main.controller:listArchivedAction')
            ->value('page', 1)
            ->assert('page', '\d+');
        $controllers->get('/show/{uid}', 'main.controller:showAction')
            ->assert('uid', '\d+');
        $controllers->get('/read/{uid}', 'main.controller:readAction')
            ->assert('uid', '\d+');
        $controllers->patch('/archive/{uid}', 'main.controller:archiveAction')
            ->assert('uid', '\d+');

        return $controllers;
    }
}