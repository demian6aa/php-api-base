<?php

namespace App\models;

use App\core\Database;
use PDO;

class UserModel extends BaseModel
{
  public static function all(): array
  {
    self::init();

    $statement = self::$pdo->query("
      SELECT *
      FROM users
      ORDER BY id DESC
    ");
    
    return $statement -> fetchAll(PDO::FETCH_ASSOC);
  }

  public static function find(string $id): array|false
  {
    self::init();

    $statement = self::$pdo->prepare("
      SELECT * 
      FROM users 
      WHERE id = :id
    ");
    $statement->execute(['id'=>$id]);

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public static function create(array $data): array
  {
    self::init();

    $statement = self::$pdo->prepare("
      INSERT INTO users (name, email, password)
      VALUES (:name, :email, :password)

      RETURNING *
    ");
    $statement->execute([
      'name'=>$data['name'], 
      'email'=> $data['email'],
      'password'=>$data['password']
    ]);

    $user = $statement->fetch(PDO::FETCH_ASSOC);
    unset($user['password']);
    return $user;
  }

  public static function update(string $id, array $data): array|false
  {
    self::init();

    $statement = self::$pdo->prepare("
        UPDATE users
        SET name = :name
        WHERE id = :id
        RETURNING *      
    ");
    $statement->execute([
      'name' => $data['name'],
      'id' => $id
    ]);

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public static function delete(string $id) : array|false
  { 
    self::init();
 
    $statement = self::$pdo->prepare("
      DELETE FROM users
      WHERE id = :id
      RETURNING *
    ");
    $statement->execute(['id' => $id]);

    return $statement->fetch(PDO::FETCH_ASSOC);
  }
}
