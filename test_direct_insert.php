<?php
require 'vendor/autoload.php';

// Load CodeIgniter
$app = require rtrim(__DIR__, '/\\') . '/public/index.php';

// Get database connection
$db = \Config\Database::connect();

// Try direct insert
$result = $db->table('users')->insert([
    'email' => 'directtest@test.com',
    'password' => password_hash('password123', PASSWORD_DEFAULT),
    'role' => 'pelamar',
    'status' => 'active',
    'created_at' => date('Y-m-d H:i:s'),
    'updated_at' => date('Y-m-d H:i:s')
]);

echo "Direct insert result: ";
var_dump($result);

// Check if user exists
$users = $db->table('users')->where('email', 'directtest@test.com')->get()->getResult();
echo "Users found: ";
var_dump($users);
?>
