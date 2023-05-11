<?php

namespace Shellby\Db;

use Exception;
use PDO;

class Connect {

  private static PDO $pdo;
  
  public function __construct(
    string $hostname,
    string $dbname,
    string $username,
    string $password,
    string $database = "mysql",
    int $port = 3306,
    string $charset = "utf8",
    array $option = array(PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION),
  ) {
    $dsn = "{$database}:host={$hostname};port={$port};dbname={$dbname};charset={$charset}";
    try {
      self::$pdo = new PDO($dsn, $username, $password, $option);
    } catch(Exception $e) {
      print($e);
    }
  } 

  public static function selectAll(
    string $table,
  ): array {
    $column = "*";
    
    $stmt = self::$pdo->prepare("SELECT * FROM {$table}");

    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }
  
  public static function select(
    string $column,
    string $table,
    ): array {
    
    $stmt = self::$pdo->prepare("SELECT {$column} FROM {$table}");
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
  }

  public static function update(
    string $column,
    string $table,
    string $where = "1"
  ):int {
    $stmt = self::$pdo->prepare("UPDATE :table SET :column WHERE :where");
    $stmt->bindParam(":table", $table);
    $stmt->bindParam(":column", $column);
    $stmt->bindParam(":where", $where);
    return 0;
  }

}