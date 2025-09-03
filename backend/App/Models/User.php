<?php

namespace App\Models;

use Config\Db\MysqlModel;
use Services\Auth;

class User extends MysqlModel
{

   public function createNewUser($first_name, $last_name, $email, $password)
   {
      try {
         $sql = 'INSERT INTO users (first_name, last_name, email, password) VALUES (:first_name, :last_name, :email, :password)';

         $params = [
            ':first_name' => $first_name,
            ':last_name' => $last_name,
            ':email' => $email,
            ':password' => password_hash($password, PASSWORD_BCRYPT)
         ];

         $this->executeQuery($sql, $params);

         $data = [
            'first_name' => $first_name,
            'last_name' => $last_name,
            'email' => $email
         ];

         $auth = new Auth();
         return $auth->generateToken($data);
      } catch (\PDOException $e) {
         throw new \Exception("Error creating user: " . $e->getMessage());
      }
   }

   public function login($email, $password)
   {
      try {
         $sql = 'SELECT first_name, last_name, email, password FROM users WHERE email = :email LIMIT 1';
         $params = [':email' => $email];

         $data = $this->executeQuery($sql, $params);
         if (!$data || count($data) === 0) {
            throw new \Exception('User not found');
         }
         return $this->authenticateUser($password, $data[0]['password'], $data[0]);
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
