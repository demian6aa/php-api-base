<?php

require_once __DIR__ . '/../vendor/autoload.php'; //load the class autoloader of the composer 
use App\core\Router;
use App\core\Request;

header('Content-Type: application/json'); 


$router = new Router(); //router creation
$request = new Request();

 //Load api.php and pass the router as an argument to it, so that it can define the routes on it
(require __DIR__ . '/../routes/api.php')($router);


//Save the return of dispatch in router // the values for the dispatch method comes from the request class function calls
$router -> dispatch ($request -> getMethod(), $request -> getUri());












//DEPRECATED

// //Get a cleaned version of the URI, without query parameters, to use it for routing
// $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH); 


// //Dispatch the request to the router, passing the HTTP method and the cleaned URI as arguments, so that it can find the corresponding route and execute its callback
// $router ->dispatch($_SERVER['REQUEST_METHOD'], $uri);

