<?php

namespace App\Controllers;

use App\core\Response;

Class HomeController
{
  public function index()
  {
    Response::json(["message: " => "API working"]);
  }


    public function user(mixed $id)
  {
    Response::json(["user_id: " => $id]);
  }
    
}
 