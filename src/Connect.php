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

  public static function getPdo() :PDO {
    return self::$pdo;
  }
  
}