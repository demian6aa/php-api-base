<?php

namespace App\core; //We define the namespace of the Router class, so that we can use it in other files without having to worry about naming conflicts with other classes that might have the same name in other namespaces. It also helps to organize our code and make it more modular and reusable.


use App\core\Request;
use App\middlewares\AuthMiddleware;

class Router
{
  private array $routes = [];




  private function addRoute (string $method, string $path, array $action, array $middlewares)
  {
    $pattern = preg_replace('/\{(\w+)\}/', '([^/]+)', $path); // Extract data from the raw path with regex
    $pattern = '#^' . $pattern . '$#';


    $this -> routes[] = 
    [
      'method' => $method,
      'pattern' => $pattern,
      'action' => $action,
      'middlewares' => $middlewares
    ];
  }





  public function dispatch (Request $request)
  {
    $method = $request -> getMethod();
    $uri = $request -> getUri();



    //We check for each object in the array if they match the particularities we are looking for.
    foreach ($this -> routes as $route)
    {
      if($route['method'] === $method && preg_match($route['pattern'], $uri, $matches))
        {
          foreach ($route['middlewares'] as $middleware)
          {
            $middlewareInstance = new $middleware();
            $passed = $middlewareInstance -> handle($request);

            if(!$passed)
            {
              return;
            }

          }

          //Remove the first item of the array since we don't need it.
          array_shift($matches);

          //Assign the controller and the function we want to some variables to use them later
          [$controller, $function] = $route['action'];


          //Create a new 'homeController' object and call the 'user' function on it, passing the extracted data as arguments to the function. The '...' operator is used to unpack the array of matches into individual arguments that can be passed to the function.
          (new $controller)->$function($request ,...$matches); 
          return;
        }
    }
    // http_response_code(404);
    Response::json(["error" => "Route not found"], 404);
  }

  public function get(string $path, array $action, array $middlewares =[])
  {
      $this -> addRoute('GET', $path, $action, $middlewares);
      
  }

  public function post (string $path, array $action, array $middlewares =[]) : void
  {
    $this->routes[] = [
      'method' => 'POST',
      'path'  => $path,
      'pattern' => "#^" . preg_replace('/\{[^\/]+\}/', '([^/]+)', $path) . "$#",
      'action'  => $action,
      'middlewares' => $middlewares
    ];


  }

  public function delete(string $path, array $action, array $middlewares =[]) : void
  {
    $this->addRoute('DELETE', $path, $action, $middlewares);
  }

  public function put(string $path, array $action, array $middlewares =[]): void
  {
    $this -> addRoute('PUT', $path, $action, $middlewares);
  }






}