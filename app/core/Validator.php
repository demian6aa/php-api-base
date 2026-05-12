<?php

namespace App\core;

class Validator
{
  public static function required (array $data, string $field): ?string
  {
    if(!isset($data[$field]) || trim($data[$field]) === '' )
    {
      return ucfirst($field) . ' is required';
    }


    return null;
  } 







  
}