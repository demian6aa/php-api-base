<?php

namespace App\Controllers;

Class HomeController
{
  public function index(){
    echo json_encode([
      'message' => 'Api working'
    ]);}
    
}
