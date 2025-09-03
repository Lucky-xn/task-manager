<?php

namespace App\Controllers;

use App\Models\User;

$user = new User();

$input = json_decode(file_get_contents('php://input'), true);

if (isset($input['teste']) && $input['teste'] === 'teste') {
   echo json_encode('funcionou');
} else {
   echo json_encode('noo funcionou');
}

// $user->createNewUser('Teste', 'Da Silva', 'teste@exemplo.com', 'senha123');
// echo json_encode($user->login('teste@exemplo.com', 'senha123'));
// echo json_encode(["teste" => ["value" => 'teste']]);