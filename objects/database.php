<?php

class Database
{
  private static $dsn = 'mysql:host=localhost;dbname=my_guitar_shop1';
  private static $username = 'msg_user';
  private static $password = 'pa55word';
  private static $db;

  public function __construct() {}

  public static function getDB()
  {
    if (!isset(self::$db)) {
      try {
        self::$db = new PDO(self::$dsn, self::$username, self::$password);
      } catch (PDOException $e) {
        $error_message = $e->getMessage();
        include 'database_error.php';
        exit();
      }
    }
    return self::$db;
  }
}