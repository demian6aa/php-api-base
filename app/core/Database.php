<?php
namespace App\core;

use PDO, PDOException;

class Database 
{
  private static?PDO $connection = null;

  public static function connect(): PDO 
  {
    if(self::$connection === null)
    {
      $host = $_ENV['DB_HOST'];
      $port = $_ENV['DB_PORT'];
      $dbname = $_ENV['DB_NAME'];
      $user = $_ENV['DB_USER'];
      $password = $_ENV['DB_PASSWORD'];

      $dsn = "pgsql:host=$host;port=$port;dbname=$dbname";

      try
      {
        self::$connection = new PDO($dsn, $user, $password);
        self::$connection -> setAttribute(
          PDO::ATTR_ERRMODE,
          PDO::ERRMODE_EXCEPTION
        );
      }catch (PDOException $e)
      {
        die("Database connection failed:" . $e->getMessage());
      }
    }

    return self::$connection;
  }
}