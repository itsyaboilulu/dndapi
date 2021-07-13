<?php

use Slim\App;

$app->group('/monsters', function (App $app) {
    $app->get('/search',            'monsterController:search');
    $app->get('/',                  'monsterController:search');
    $app->get('/all',               'monsterController:all');
    $app->get('/random',            'monsterController:random');
    $app->get('/wildshape/random',  'monsterController:randomWildshape');

    $app->get('/{any}',             'monsterController:find');
});
