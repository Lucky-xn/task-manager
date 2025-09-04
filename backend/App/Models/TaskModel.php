<?php

namespace App\Models;

use Config\Db\MysqlModel;
use PDO;
use PDOException;

class TaskModel extends MysqlModel
{
   public function addNewTask($data)
   {
      try {
         $sql = "INSERT INTO tasks (user_id, title, status, tags) VALUES (:user_id, :title, :status, :tags)";

         $params = [
            ':user_id' => $data['user_id'],
            ':title' => $data['title'],
            ':status' => $data['status'],
            ':tags' => $data['tags'],
         ];

         $this->executeQuery($sql, $params);
      } catch (PDOException $e) {
         throw new \Exception("Error adding task: " . $e->getMessage());
      }
   }

   public function getAllTasks($userId)
   {
      try {
         $sql = "SELECT id, title, status, tags, created_at FROM tasks WHERE user_id = :user_id ORDER BY created_at DESC";
         $params = [':user_id' => $userId];
         return $this->executeQuery($sql, $params);
      } catch (PDOException $e) {
         throw new \Exception("Error fetching tasks: " . $e->getMessage());
      }
   }
}
