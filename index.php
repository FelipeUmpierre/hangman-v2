<?php

require_once 'vendor/autoload.php';

use Illuminate\Container\Container;
use Illuminate\Events\Dispatcher;
use Illuminate\Http\Request;
use Illuminate\Routing\Router;

$events = new Dispatcher(new Container);
$router = new Router($events);

require_once 'routes.php';

$request = Request::capture();
$response = $router->dispatch($request);

$response->send();