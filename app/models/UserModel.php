<?php

namespace App\models;

use App\core\Database;
use PDO;

class UserModel
{
  public static function all(): array
  {
    $pdo = Database::connect();

    $statement = $pdo->query("
      SELECT *
      FROM users
      ORDER BY id DESC
    ");
    
    return $statement -> fetchAll(PDO::FETCH_ASSOC);
  }

  public static function find(string $id): array|false
  {
    $pdo = Database::connect();

    $statement = $pdo->prepare("
      SELECT * 
      FROM users 
      WHERE id = :id
    ");
    $statement->execute(['id'=>$id]);

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public static function create(array $data): array
  {
    $pdo= Database::connect();

    $statement = $pdo->prepare("
      INSERT INTO users (name)
      VALUES (:name)
      RETURNING *
    ");
    $statement->execute(['name'=>$data['name']]);

    return $statement->fetch(PDO::FETCH_ASSOC);
  }

  public static function update(string $id, array $data): array|false
  {
    $pdo = Database::connect();

    $statement = $pdo->prepare("
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
    $pdo = Database::connect();

    
    $statement = $pdo->prepare("
      DELETE FROM users
      WHERE id = :id
      RETURNING *
    ");
    $statement->execute(['id' => $id]);

    return $statement->fetch(PDO::FETCH_ASSOC);
  }
}
