<?php

namespace App\Controllers;

use App\Models\User;

$user = new User();

// $user->createNewUser('Teste', 'Da Silva', 'teste@exemplo.com', 'senha123');
echo json_encode($user->login('teste@exemplo.com', 'senha123'));