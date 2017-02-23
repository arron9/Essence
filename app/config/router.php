<?php

use Phalcon\Mvc\Router\Annotations as Router;

$router = new Router(false);
$router->removeExtraSlashes(true);

$router->addResource("Plu\Admin\Controllers\Home\Index", "/");
$router->addResource("Plu\Admin\Controllers\Home\Signup", "/signup");

return $router;

