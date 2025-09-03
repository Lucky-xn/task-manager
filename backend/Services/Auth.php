<?php

namespace Services;

use Firebase\JWT\JWT;
use Firebase\JWT\Key;

class Auth {

   private $secretKey;
   private $algorithm = 'HS256';

   public function __construct() {
      // Load from $_ENV or fallback to getenv
      $this->secretKey = $_ENV['JWT_SECRET_KEY'] ?? getenv('JWT_SECRET_KEY') ?? '';
      if ($this->secretKey === '') {
         throw new \RuntimeException('JWT secret key not set.');
      }
   }

   public function generateToken($userData) {
      $issuedAt = time();
      $expirationTime = $issuedAt + 3600; // 1 hour

      $payload = [
         'iat' => $issuedAt,
         'exp' => $expirationTime,
         'data' => $userData,
         'first_name' => $userData['first_name'] ?? null,
         'last_name' => $userData['last_name'] ?? null,
         'email' => $userData['email'] ?? null
      ];

      return JWT::encode($payload, $this->secretKey, $this->algorithm);
   }

   public function validateToken($token) {
   try {
      $decoded = JWT::decode($token, new \Firebase\JWT\Key($this->secretKey, $this->algorithm));
         return isset($decoded->data) ? (array)$decoded->data : [];
      } catch (\Throwable $e) {
         return false;
      }
   }
}