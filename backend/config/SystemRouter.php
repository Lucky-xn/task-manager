<?php

namespace Config;

/**
 * Classe responsável por gerenciar as rotas do sistema.
 * Permite adicionar rotas, obter todas as rotas e executar a rota correspondente à requisição.
 */


/**
 * TODO Fazer um middleware que verifique o token da requisição e as permissões do usuário.
 */

class SystemRouter
{
   private $routes = [];

   public function addRoute($method, $request, $handler, $private = false, $permissions = [])
   {
      $controllerHandler = __DIR__ . '/../app/controllers/' . $handler . '.php';

      if (!file_exists($controllerHandler)) {
         throw new \Exception("Controller $handler not found");
      }

      $this->routes[] = [
         'method' => $method,
         'request' => $request,
         'handler' => $controllerHandler,
         'private' => $private,
         'permissions' => $permissions
      ];
   }

   public function run()
   {
      $requestMethod = $_SERVER['REQUEST_METHOD'] ?? 'GET';
      $requestUri = $_SERVER['REQUEST_URI'] ?? '/';
      $requestPath = parse_url($requestUri, PHP_URL_PATH);

      foreach ($this->routes as $route) {
         if ($route['method'] === $requestMethod && $route['request'] === $requestPath) {
            include_once $route['handler'];
            return;
         }
      }

      http_response_code(404);
      header('Content-Type: application/json');
      echo json_encode(['error' => 'Not Found']);
   }
}
