<?php

use App\Controllers\HomeController;

return function ($router) {
    
    $router -> post('/users', [HomeController::class, 'store']);

    $router -> get('/users', [HomeController::class, 'index']);
    $router -> get('/users/{id}', [HomeController::class, 'show'] );
    
    $router -> delete('/users/{id}', [HomeController::class, 'destroy']);

    $router -> put('/users/{id}', [HomeController::class, 'update']);

 };