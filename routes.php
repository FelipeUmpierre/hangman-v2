<?php

use Illuminate\Routing\Router;

/** @var $router Router */
$router->get('/', 'Hangman\Controller\GameController@index');
$router->get('/load/{id}', 'Hangman\Controller\GameController@load');
$router->get('/save/{id}', 'Hangman\Controller\GameController@save');
$router->get('/guess/{id}/letter/{char}', 'Hangman\Controller\GameController@guess');
