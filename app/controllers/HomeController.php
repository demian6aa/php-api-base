<?php

namespace App\Controllers;

use App\core\Response;
use App\core\Request;

Class HomeController
{
  public function index(Request $request)
  {
    Response::json(["message: " => "API working"]);
  }


    public function user(Request $request ,mixed $id)
  {
    Response::json(["user_id: " => $id]);
  }
    
  public function store (Request $request)
  {
    $data = $request -> getBody();

    Response::json([
        "message" => "User created",
        "data" => $data
      ], 201);
  }



}
 