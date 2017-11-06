<?php

namespace App\Apples\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;
use App\Associations\Controller\UserAppleController;

class AppleController
{
    public function listAction(Request $request, Application $app)
    {
        $apples = $app['repository.apple']->getAll();

        return $app['twig']->render('apples.list.html.twig', array('apples' => $apples));
    }

    public function deleteAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $app['repository.apple']->delete($parameters['id']);

        $userAppleController = new UserAppleController();
        $userAppleController->deleteByApple($parameters['id'], $app);

        return $app->redirect($app['url_generator']->generate('apples.list'));
    }

    public function editAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $apple = $app['repository.apple']->getById($parameters['id']);

        return $app['twig']->render('apples.form.html.twig', array('apple' => $apple));
    }

    public function saveAction(Request $request, Application $app)
    {
        $parameters = $request->request->all();
        if ($parameters['id']) {
            $apple = $app['repository.apple']->update($parameters);
        } else {
            $apple = $app['repository.apple']->insert($parameters);
        }

        return $app->redirect($app['url_generator']->generate('apples.list'));
    }

    public function newAction(Request $request, Application $app)
    {
        return $app['twig']->render('apples.form.html.twig');
    }

}
