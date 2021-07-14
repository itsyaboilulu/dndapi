<?php

session_start();

require __DIR__ . '/../vendor/autoload.php';

$logDate = new DateTime();

$app = new Slim\App([
    'settings'  => [
        'displayErrorDetails' => TRUE,
        'db'    => [
            'driver'    => 'mysql',
            'host'      => '127.0.0.1',
            'database'  => 'u519567483_dnd',
            'username'  => 'u519567483_dnd',
            'password'  => '9Ky*iF2tw',
            'charset'   => 'utf8',
            'collation' => 'utf8_unicode_ci',
        ],
    ],
]);

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
