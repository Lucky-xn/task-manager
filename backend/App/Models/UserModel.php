<?php

namespace App\Models;

use Config\Db\MysqlModel;
use Services\Auth;

class UserModel extends MysqlModel
{

   public function createNewUser($data)
   {
      try {
         $sql = 'INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)';

         $params = [
            ':first_name' => $data['first_name'],
            ':last_name' => $data['last_name'],
            ':email' => $data['email'],
            ':password' => password_hash($data['password'], PASSWORD_BCRYPT)
         ];

         $this->executeQuery($sql, $params);
         $auth = new Auth();
         return $auth->generateToken($data);
      } catch (\PDOException $e) {
         throw new \Exception("Error creating user: " . $e->getMessage());
      }
   }

   public function login($data)
   {
      try {
         $sql = 'SELECT first_name, last_name, email, password FROM users WHERE email = :email LIMIT 1';
         $params = [':email' => $data['email']];

         $result = $this->executeQuery($sql, $params);
         if (!$result || count($result) === 0) {
            throw new \Exception('User not found');
         }
         return $this->authenticateUser($data['password'], $result[0]['password'], $result[0]);
      } catch (\PDOException $e) {
         throw new \Exception("Error logging in: " . $e->getMessage());
      }
   }

   private function authenticateUser($password, $hashedPassword, $data)
   {
      if (password_verify($password, $hashedPassword)) {
         $auth = new Auth();
         return $auth->generateToken($data);
      } else {
         throw new \Exception("Invalid credentials");
      }
   }
}
