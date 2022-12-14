<?php
require_once 'libs/routerBase.php';
require_once 'app/controllers/animalesApiController.php';
require_once 'app/controllers/especiesApiController.php';

$router = new Router();

// tabla de ruteo
$router->addRoute('animales', 'GET', 'animalesApiController', 'get');
$router->addRoute('animales/:ID', 'GET', 'animalesApiController', 'get');

$router->addRoute('animales', 'POST', 'animalesApiController', 'post');

$router->addRoute('animales/:ID', 'PUT', 'animalesApiController', 'put');

$router->addRoute('animales/:ID', 'DELETE', 'animalesApiController', 'delete');


$router->addRoute('especies', 'GET', 'especiesApiController', 'get');


// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);






