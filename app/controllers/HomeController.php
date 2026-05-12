<?php

namespace App\Controllers;

use App\core\Response;
use App\core\Request;
use App\core\Validator;

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
    $error = Validator::required($data, 'name');

    if($error)
    {
      Response::json(["Error " => $error], 422);
      return;
    }



    Response::json([
        "message" => "User created",
        "data" => $data
      ], 201);
  }



}
 