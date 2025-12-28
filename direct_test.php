<?php
// Test UserModel insert
require 'vendor/autoload.php';

// Bootstrap CodeIgniter
$bootPath = rtrim(__DIR__, '/\\') . '/app/Config/Boot/' . strtolower(getenv('CI_ENVIRONMENT') ?: 'development') . '.php';
if (file_exists($bootPath)) {
    require $bootPath;
}

use App\Models\UserModel;
use Config\Database;

$db = Database::connect();
file_put_contents('C:/laragon/tmp/model_test.txt', "Database connected\n", FILE_APPEND);

$userModel = new UserModel();
file_put_contents('C:/laragon/tmp/model_test.txt', "UserModel created\n", FILE_APPEND);

$data = [
    'email' => 'modeltest@test.com',
    'password' => password_hash('password123', PASSWORD_DEFAULT),
    'role' => 'pelamar',
    'status' => 'active'
];

file_put_contents('C:/laragon/tmp/model_test.txt', "About to insert: " . json_encode($data) . "\n", FILE_APPEND);

$result = $userModel->insert($data);

file_put_contents('C:/laragon/tmp/model_test.txt', 
    "Insert result: " . var_export($result, true) . "\n" .
    "Errors: " . json_encode($userModel->errors()) . "\n",
    FILE_APPEND
);

echo "Model insert test done. Check C:/laragon/tmp/model_test.txt";
?>
