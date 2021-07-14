<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';
require __DIR__ . '/../app/settings.php';

$logDate = new DateTime();

$app = new Slim\App(settings());

require __DIR__ . '/../app/routes.php';

$container = $app->getContainer();

$capsule = new \Illuminate\Database\Capsule\Manager;
$capsule->addConnection($container['settings']['db']);
$capsule->setAsGlobal();
$capsule->bootEloquent();

$container['db'] = function ($container) use ($capsule) {
    return $capsule;
};

$container['monsterController'] = function ($container) {
    return new \App\Controllers\monsterController($container);
};

$app->run();
