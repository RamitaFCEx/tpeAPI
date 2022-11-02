<?php
require_once 'libs/routerBase.php';
require_once 'app/controllers/itemsApiController.php';

$router = new Router();

// tabla de ruteo
$router->addRoute('items', 'GET', 'itemsApiController', 'getAllItems');
$router->addRoute('test', 'GET', 'itemsApiController', 'test');


// rutea
$router->route($_GET["resource"], $_SERVER['REQUEST_METHOD']);






