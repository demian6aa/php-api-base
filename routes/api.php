<?php

use App\Controllers\HomeController;

return function ($router) {
    $router -> get('/users/{id}', [HomeController::class, 'user']);
    $router->get('/', [HomeController::class, 'index']);
    

 };