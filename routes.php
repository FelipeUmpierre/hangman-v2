<?php

use Illuminate\Routing\Router;

/** @var $router Router */
$router->get('/', 'Hangman\Controller\GameController@index');
$router->get('/load/{id}', 'Hangman\Controller\GameController@load');
$router->get('/guess/{id}/character/{char}', 'Hangman\Controller\GameController@guess');
