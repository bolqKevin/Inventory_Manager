<?php
namespace App\Utils;

class PasswordManager {
    // Method for generating a password hash
    public static function generateHash(string $password): string {
        return password_hash($password, PASSWORD_BCRYPT);
    }

    // Method to check if the entered password is valid
    public static function verifyPassword(string $password, string $hash): bool {
        return password_verify($password, $hash);
    }
}
