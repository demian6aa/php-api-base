<?php

namespace App\models;

use App\core\Database;
use PDO;

class BaseModel
{
  protected static PDO $pdo;

  public static function init():void{
    if(!isset(self::$pdo))
    {
      self::$pdo = Database::connect();
    }
    
  }
}