<?php

namespace Shellby\Db;

use PDO;
use Shellby\Db\Connect;

class Query {

  private static PDO $pdo;
  
  public function __construct() {
    $dotenv = \Dotenv\Dotenv::createImmutable(__DIR__);
    $dotenv->load();

    self::$pdo = new Connect($_ENV["DB_HOST"], $_ENV["DB_DATABASE"], $_ENV["DB_USERNAME"], $_ENV["DB_PASSWORD"]);
  }

  public static function select(
    string $query,
    array $params,    
  ) : array {
    $stmt = self::$pdo->prepare($query);
    // foreach($params as $param) {
    //   echo $param;
    // }
    return [];
  }

}