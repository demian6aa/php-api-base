<?php

namespace App\Validators;

class UserValidator
{
  public static function store(): array
  {
    return
    [
      'name' => ['required', 'min:3'],
      'email' => ['required', 'email'],
      'password'=> ['required', 'min:8']
    ];
  }

  public static function update(): array
  {
    return
    [
      'name' => ['required', 'min:3'],
      'email' => ['required', 'email'],
    ];
  }
}