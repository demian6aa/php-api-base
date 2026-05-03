<?php

namespace App\core; //We define the namespace of the Router class, so that we can use it in other files without having to worry about naming conflicts with other classes that might have the same name in other namespaces. It also helps to organize our code and make it more modular and reusable.

class Router
{
  private array $routes = [];

  public function get ($path, $action)
  {
    $this->routes[] = 
    [
      'method' => 'GET',
      'path' => $path,
      'action' => $action
    ];

  }

  public function dispatch ($method , $uri)
  {
    foreach ($this->routes as $route)
    {
      if ($route['method'] === $method && $route['path'] === $uri)
      {
        [$controller, $function] = $route['action'];

        (new $controller)->$function();
        return;

      }
    }

    http_response_code(404);
    echo json_encode(["error" => "Route not found"]);

  }



}