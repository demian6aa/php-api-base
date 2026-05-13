<?php

namespace App\core;

 class Validator
 {
    public static function validate (array $data, array $rules)
    {
      $errors = [];

      foreach ($rules as $field => $fieldRules)
      {
        //REQUIRED PARAMS
        foreach ($fieldRules as $rule)
        {
          if($rule === 'required')
          {
            if(!isset($data[$field]) || trim($data[$field]) === '')
            { $errors[$field][] = ucfirst($field) . ' is required'; }
          }
        }
        

        //MIN LENGTH CONTROL
        if(str_starts_with($rule, 'min:'))
        {
          $min = (int) explode (':', $rule)[1];

          if(isset($data[$field]) && strlen($data[$field])<$min)
          { $errors[$field][] = ucfirst($field) . " must be at least {$min} characters"; }
        }
      }
      return $errors;


    }

 }














// class Validator
// {
//   public static function required (array $data, string $field): ?string
//   {
//     if(!isset($data[$field]) || trim($data[$field]) === '' )
//     {
//       return ucfirst($field) . ' is required';
//     }
//     return null;
//   }  
// }