<?php

require_once __DIR__ . '/../vendor/autoload.php'; //load the class autoloader of the composer 
use App\Core\Router;

header('Content-Type: application/json'); 


$router = new Router(); //router creation


(require __DIR__ . '/../routes/api.php')($router); //We load api.php and pass the router as an argument to it, so that it can define the routes on it

$uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); //We get a cleaned version of the URI, without query parameters, to use it for routing
$router ->dispatch($_SERVER['REQUEST_METHOD'], $uri); //We dispatch the request to the router, passing the HTTP method and the cleaned URI as arguments, so that it can find the corresponding route and execute its callback

