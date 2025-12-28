<?php
require 'vendor/autoload.php';
require 'app/Models/UserModel.php';

$userModel = new \App\Models\UserModel();
$result = $userModel->insert([
    'email' => 'testuser@example.com',
    'password' => password_hash('password123', PASSWORD_DEFAULT),
    'role' => 'pelamar',
    'status' => 'active'
]);

echo "Insert result: ";
var_dump($result);

echo "\nModel errors: ";
var_dump($userModel->errors());

echo "\nDatabase lastQuery: ";
var_dump($userModel->getLastQuery());
?>
