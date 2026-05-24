<?php

use App\Controllers\HomeController;
use App\middlewares\AuthMiddleware;

return function ($router) {
    
    $router -> post('/users', [HomeController::class, 'store']);

     $router -> get('/users',[HomeController::class, 'index'], [AuthMiddleware::class]);
    $router -> get('/users/{id}', [HomeController::class, 'show'] );
   
    
    $router -> delete('/users/{id}', [HomeController::class, 'destroy']);

    $router -> put('/users/{id}', [HomeController::class, 'update']);

 };