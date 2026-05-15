<?php

namespace App\core; //We define the namespace of the Request class, so that we can use it in other files without having to worry about naming conflicts with other classes that might have the same name in other namespaces. It also helps to organize our code and make it more modular and reusable.


class Request 
{
  private string $method, $uri;
  private array $queryParams, $body;
  

  #REGION Constructor
  public function __construct()
  {
    $this -> method = $_SERVER['REQUEST_METHOD']; 
    $this -> queryParams = $_GET;
    $this -> uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
    $this -> uri = rtrim($this->uri, '/') ?: '/';
    

    // error_log ("actual uri: " . $this->uri);

    // $this->body = json_decode(file_get_contents('php://input'),true)??[];

    $input = file_get_contents('php://input');
    $this -> body = json_decode($input, true) ?? [];
  }


#REGION Getters
  public function getMethod ()
  { 
    return $this -> method;

  }
  public function getUri ()
  {
    return $this -> uri;
  }
  public function getQueryParams ()
  {
    return $this -> queryParams;
  }
  public function getBody ()
  {
    return $this -> body;
  }

  


}