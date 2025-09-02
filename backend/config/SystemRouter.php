<?php

class SystemRouter {

   private $routes = [];

   public function addRoute($method, $path, $handler, $private = false, $permissions = [])
   {
      $controllerPath = __DIR__ . './../app/controllers/' . $handler . '.php';

      if (file_exists($controllerPath)) {
         $this->routes[] = [
            'method' => $method,
            'path' => $path,
            'handler' => $handler,
            'private' => $private,
            'permissions' => $permissions
         ];
      } else {
         throw new Exception("Controller not found");
      }
   }

   public function getRoutes()
   {
      return $this->routes;
   }

   public function run() {
      $requestMethod = $_SERVER['REQUEST_METHOD'];
      $requestPath = $_SERVER['REQUEST_URI'];

      foreach ($this->routes as $route) {
         if ($route['method'] === $requestMethod && $route['path'] === $requestPath) {
            // Call the appropriate handler
            return call_user_func($route['handler']);
         }
      }

      // If no route matched, return a 404 response
      http_response_code(404);
      echo json_encode(['error' => 'Not Found']);
   }

}