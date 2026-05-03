<?php

use App\Controllers\HomeController;

return function ($router) {
    $router->get('/', [HomeController::class, 'index']);
    

 };