<?php

//users
$app->get('/users/list', 'App\Users\Controller\IndexController::listAction')->bind('users.list');
$app->get('/users/edit/{id}', 'App\Users\Controller\IndexController::editAction')->bind('users.edit');
$app->get('/users/new', 'App\Users\Controller\IndexController::newAction')->bind('users.new');
$app->post('/users/delete/{id}', 'App\Users\Controller\IndexController::deleteAction')->bind('users.delete');
$app->post('/users/save', 'App\Users\Controller\IndexController::saveAction')->bind('users.save');

//apples
$app->get('/apples/list', 'App\Apples\Controller\AppleController::listAction')->bind('apples.list');
$app->get('/apples/edit/{id}', 'App\Apples\Controller\AppleController::editAction')->bind('apples.edit');
$app->get('/apples/new', 'App\Apples\Controller\AppleController::newAction')->bind('apples.new');
$app->post('/apples/delete/{id}', 'App\Apples\Controller\AppleController::deleteAction')->bind('apples.delete');
$app->post('/apples/save', 'App\Apples\Controller\AppleController::saveAction')->bind('apples.save');
