<?php

namespace App\Associations\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class UserAppleController
{
    public function deleteByUser($userId, Application $app)
    {
        $userHasAppleList = $app['repository.userappleassociation']->getAllForUser($userId);
        foreach ($userHasAppleList as $userHasApple) {
            $app['repository.userappleassociation']->delete($userHasApple->getId());
        }

    }

    public function deleteByApple($appleId, Application $app)
    {
        $userHasAppleList = $app['repository.userappleassociation']->getAllForApple($appleId);
        foreach ($userHasAppleList as $userHasApple) {
            $app['repository.userappleassociation']->delete($userHasApple->getId());
        }

    }

    public function editAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $apple = $app['repository.apple']->getById($parameters['id']);

        return $app['twig']->render('apples.form.html.twig', array('apple' => $apple));
    }

    public function saveAction($userId, $appleId, Application $app)
    {
        $apple = $app['repository.apple']->getById($appleId);
        $user = $app['repository.user']->getById($userId);
        $user->setApple($apple);

        $parameters = array('user_id' => $userId, 'apple_id' => $appleId);
        $app['repository.userappleassociation']->insert($parameters);
    }

    public function newAction(Request $request, Application $app)
    {
        return $app['twig']->render('apples.form.html.twig');
    }
}
