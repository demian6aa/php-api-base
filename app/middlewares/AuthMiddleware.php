<?php
 namespace App\middlewares;

 use App\core\Request;
 use App\core\Response;

 class AuthMiddleware
 {
  
  public function handle(Request $request)
  {
    
    $headers = getallheaders();

    $token = $headers['Authorization'] ?? null; 
    if($token !==$_ENV['API_SECRET'])
    {
      Response::json([
        'error' => 'Unauthorized'
      ],401);
      return false;
    }
    return true;
  }
 }