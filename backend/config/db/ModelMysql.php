<?php

use Database\Database;

abstract class MysqlModel
{
   public function executeQuery($query, $params = [])
   {
      try {

         $stmt = Database::getConnection()->prepare($query);

         foreach ($params as $key => $value) {
            $stmt->bindValue($key, $value);
         }
         $stmt->execute();

         if (preg_match('/^(SELECT|SHOW|DESCRIBE)/i', $query)) {
            return $stmt->fetchAll(PDO::FETCH_ASSOC);
         } else {
            return $stmt->rowCount();
         }
      } catch (PDOException $e) {
         error_log($e->getMessage());
         throw new Exception("Database query error");
      }
   }
}
