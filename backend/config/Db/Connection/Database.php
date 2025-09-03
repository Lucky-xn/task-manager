<?php

namespace Config\Db\Connection;

use PDO;
use PDOException;

class Database
{
   private static ?PDO $instance = null;
   private static array $options = [
      PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
      PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
      PDO::ATTR_EMULATE_PREPARES => false,
      PDO::ATTR_PERSISTENT => true // Conexões persistentes
   ];

   public static function getConnection()
   {
      if (self::$instance === null) {

         $host = $_ENV['DB_HOST'];
         $dbname = $_ENV['DB_NAME'];
         $user = $_ENV['DB_USER'];
         $password = $_ENV['DB_PASSWORD'];

         $dns = "mysql:host=$host;dbname=$dbname;charset=utf8mb4";

         try {
            self::$instance = new PDO(
               $dns,
               $user,
               $password,
               self::$options
            );
         } catch (PDOException $e) {
            throw new \Exception('Connection failed: ' . $e->getMessage());
         }
         return self::$instance;
      }
   }
}
