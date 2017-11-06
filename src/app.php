<?php

use Silex\Application;
use Silex\Provider\TwigServiceProvider;
use Silex\Provider\DoctrineServiceProvider;

$app = new Application();

// Ajout des fournisseurs de services
$app->register(new DoctrineServiceProvider());
$app->register(new TwigServiceProvider(), array(
    'twig.path' => __DIR__.'/../views',
));

//Ajout des repository
$app['repository.user'] = function ($app) {
    return new App\Users\Repository\UserRepository($app['db']);
};

$app['repository.apple'] = function ($app) {
    return new App\Apples\Repository\AppleRepository($app['db']);
};

$app['repository.userappleassociation'] = function ($app) {
    return new App\Associations\Repository\UserAppleAssociationRepository($app['db']);
};
