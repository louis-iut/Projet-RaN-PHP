<?php

namespace App\Users\Controller;

use App\Associations\Controller\UserAppleController;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

class IndexController
{
    public function listAction(Request $request, Application $app)
    {
        $users = $app['repository.user']->getAll();

        if (!empty($users)) {

            $userHasAppleList = $app['repository.userappleassociation']->getAll();

            foreach ($userHasAppleList as $userHasApple) {
                foreach ($users as $tmp) {
                    if ($tmp->getId() == $userHasApple->getUserId()) {
                        unset($users[$tmp->getId()]);
                        break;
                    }
                }

                $apple = $app['repository.apple']->getById($userHasApple->getAppleId());
                $user = $app['repository.user']->getById($userHasApple->getUserId());
                $user->setApple($apple);
                array_push($users, $user);
            }

        }

        return $app['twig']->render('users.list.html.twig', array('users' => $users));
    }

    public function deleteAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $app['repository.user']->delete($parameters['id']);

        $userAppleController = new UserAppleController();
        $userAppleController->deleteByUser($parameters['id'], $app);

        return $app->redirect($app['url_generator']->generate('users.list'));
    }

    public function editAction(Request $request, Application $app)
    {
        $parameters = $request->attributes->all();
        $user = $app['repository.user']->getById($parameters['id']);

        return $app['twig']->render('users.form.html.twig', array('user' => $user));
    }

    public function saveAction(Request $request, Application $app)
    {
        $parameters = $request->request->all();

        if (array_key_exists('id', $parameters)) {
            $user = $app['repository.user']->update($parameters);
        } else {
            $userId = $app['repository.user']->insert($parameters);


            if ($parameters['select_pomme'] != "none") {
                $userAppleController = new UserAppleController();
                $userAppleController->saveAction($userId, $parameters['select_pomme'], $app);
            }
        }



        return $app->redirect($app['url_generator']->generate('users.list'));
    }

    public function newAction(Request $request, Application $app)
    {
        $apples = $app['repository.apple']->getAll();
        return $app['twig']->render('users.form.html.twig', array('apples' => $apples));
    }
}
