<?php
require_once 'libs/routerBase.php';
require_once 'app/controllers/itemsApiController.php';

$router = new Router();

// tabla de ruteo
$router->addRoute('animales', 'GET', 'itemsApiController', 'get');
$router->addRoute('animales/:ID', 'GET', 'itemsApiController', 'get');

$router->addRoute('animales', 'POST', 'itemsApiController', 'post');

$router->addRoute('animales/:ID', 'PUT', 'itemsApiController', 'put');

$router->addRoute('animales/:ID', 'DELETE', 'itemsApiController', 'deleteItem');


// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);






