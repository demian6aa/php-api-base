<?php

namespace App\Controllers;

use App\core\Database;
use App\core\Response;
use App\core\Request;
use App\core\Validator;
use PDO;

Class HomeController
{

  //Save Params into the database
  public function store (Request $request) : void
  {
    $data = $request -> getBody();

    $errors = Validator::validate($data, ['name' => ['required', 'min:3']]); 

    if ($errors)
    {
      Response::json(['errors' => $errors], 422);
      return;
    }

    $pdo = Database::connect();
    $statement = $pdo->prepare("
      INSERT INTO users (name) 
      VALUES(:name) 
    ");

    $statement->execute([
      'name' => $data['name']
    ]);


    Response::json([
      'message' => 'User created'
    ], 201);

  }


  // All index
  public function index(Request $request)
  {
    $pdo = Database::connect();

    $statement = $pdo->query("
      SELECT *
      FROM users
      ORDER BY id DESC   
    ");

    $users = $statement->fetchAll(PDO::FETCH_ASSOC);
    Response::json($users);

    #DEPRECATED
    // Response::json(["message: " => "API working"]);
  }
  
  //
  public function show(Request $request, string $id) : void
  {
    $pdo = Database::connect();
    
    $statement = $pdo->prepare("
      SELECT *
      FROM users
      WHERE id = :id
    ");

    $statement->execute([
      'id' => $id
    ]);



    $user = $statement ->fetch(PDO::FETCH_ASSOC);
    if(!$user)
    {
      Response::json([
        'error' => 'User not found'
      ], 404);
      return;
    }
    Response::json($user);

  }

  public function destroy (Request $request, string $id) : void
  {
     $pdo = Database::connect();

     $statement = $pdo->prepare("
        DELETE FROM users
        WHERE id = :id
     ");
     $statement->execute(['id' => $id]);


    if ($statement->rowCount() === 0 )
    {
      Response::json(['error' => 'User not found'], 404);
      return;     
    }
    Response::json(['message' => 'User deleted']);
    
  }










#DEPRECATED
  // public function user(Request $request ,mixed $id)
  // {
  //   Response::json(["user_id: " => $id]);
  // }



  #DEPRECATED STORE

  // public function store (Request $request)
  // {
  //   $data = $request -> getBody();
  //   // $error = Validator::required($data, 'name');
  //   $errors = Validator::validate($data, ['name' => ['required', 'min:3']]);

  //   if(!empty($errors))
  //   {
  //     Response::json(['errors'=> $errors], 422);
  //     return;
  //   }



  //   Response::json([
  //       "message" => "User created",
  //       "data" => $data
  //     ], 201);
  // }



}
 