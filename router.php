<?php
require_once 'libs/routerBase.php';
require_once 'app/controllers/itemsApiController.php';

$router = new Router();

// tabla de ruteo
$router->addRoute('test', 'GET', 'itemsApiController', 'test');
$router->addRoute('items', 'GET', 'itemsApiController', 'get');
$router->addRoute('items/:ID', 'GET', 'itemsApiController', 'get');

$router->addRoute('items', 'POST', 'itemsApiController', 'post');

$router->addRoute('items/:ID', 'PUT', 'itemsApiController', 'put');

$router->addRoute('items/:ID', 'DELETE', 'itemsApiController', 'deleteItem');


// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);






