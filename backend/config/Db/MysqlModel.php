<?php

namespace Config\Db;

use Config\Db\Connection\Database;
use PDO;
use PDOException;

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
            return $this->convertKeysToLower($stmt->fetchAll(PDO::FETCH_ASSOC));
         }
         return $stmt->rowCount();
      } catch (PDOException $e) {
         error_log($e->getMessage());
         throw new \Exception('Database query error');
      }
   }

    private function convertKeysToLower(array $array): array
    {
        return array_map(function ($row) {
            return array_change_key_case($row, CASE_LOWER);
        }, $array);
    }
}
