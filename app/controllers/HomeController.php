<?php

namespace App\Controllers;

use App\core\Response;
use App\core\Request;

use App\models\UserModel;

use App\Validators\UserValidator;
use App\Validators\Validator;
Class HomeController
{

  //Save Params into the database
  public function store (Request $request) : void
  {
    $data = $request -> getBody();

    $errors = Validator::validate($data, UserValidator::store()); 
    if (!empty($errors))
    {
      Response::json(['errors' => $errors], 422);
      return;
    }

    $data['password'] = password_hash(
      $data['password'], PASSWORD_DEFAULT
    );


    $user = UserModel::create($data);

    Response::json([
      'message' => 'User created',
      'data' => $user
    ], 201);
  }

  // All index
  public function index(Request $request):void
  {
    $users = UserModel::all();
    
    foreach($users as &$user){unset($user['password']);}
    Response::json($users);
  }
  
  public function show(Request $request, string $id) : void
  {
    $user = UserModel::find($id);
    if(!$user)
    {
      Response::json(['error' => 'User not found'], 404);
      return;
    }
    unset($user['password']);
    Response::json($user);
  }

  public function destroy (Request $request, string $id) : void
  {
    $user = UserModel::delete($id);
    if(!$user)
    {
      Response::json(['error' => 'User not found'],404);
      return;
    }

    Response::json(['message' => 'User deleted', 'data' => $user]);
  }

  public function update(Request $request, string $id): void
  {
    $data = $request->getBody();

    $errors = Validator::validate( $data,UserValidator::update());
    if(!empty($errors)){
      Response::json([
        'errors' => $errors
      ], 422);
      return;
    }


    $user = UserModel::update($id, $data);
    if(!$user)
    {
      Response::json([
        'error' => 'User not found'
      ], 404);
      return;
    }

    Response::json(['message' => 'User updated', 'data'=>$user]);

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
 