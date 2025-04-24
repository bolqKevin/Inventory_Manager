<?php
require_once 'vendor/autoload.php'; 

use App\Utils\PasswordManager;

if ($argc < 2) {
    echo "Usage: php generate_password.php <password>\n";
    exit(1);
}

$password = $argv[1];  // The password will be passed on the command line

$hashedPassword = PasswordManager::generateHash($password);

echo "Generated hash: \n$hashedPassword\n";
