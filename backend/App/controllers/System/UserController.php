<?php

use App\Models\UserModel;

$user = new UserModel();

$input = json_decode(file_get_contents('php://input'), true);

if ($input['type'] === 'register') {
  echo json_encode(['token' => $user->createNewUser($input)]);
} else if ($input['type'] === 'login') {
   echo json_encode(['token' => $user->login($input)]);
} else {
    echo json_encode(['error' => 'Invalid request type']);
}