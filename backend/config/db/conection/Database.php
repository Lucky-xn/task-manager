<?php

namespace Database;
use PDO;
use PDOException;

class Database
{
   protected static $pdo = null;

   public static function getConnection()
   {
      try {
         if (self::$pdo === null) {
            self::$pdo = new PDO(
               "mysql:host={$_ENV['DB_HOST']};dbname={$_ENV['DB_NAME']};charset=utf8mb4",
               $_ENV['DB_USER'],
               $_ENV['DB_PASSWORD']
            );
            self::$pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
         }
         return self::$pdo;
      } catch (PDOException $e) {
         echo "Connection failed: " . $e->getMessage();
         exit;
      }
   }
}
