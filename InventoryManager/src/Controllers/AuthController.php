<?php
namespace App\Controllers;

use App\Config\Database;
use App\Utils\Session;

class AuthController {
    public function __construct() {
        Session::start();
    }

    public function login() {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';

            $users = Database::getUsers();
            foreach ($users as $user) {
                if ($user['email'] === $email && password_verify($password, $user['password'])) {
                    Session::set('user_id', $user['id']);
                    Session::set('user_email', $user['email']);
                    Session::set('user_role', $user['role']);
                    header('Location: /inventory');
                    exit;
                }
            }

            $error = 'Invalid credentials';
            include __DIR__ . '/../views/auth/login.php';
            return;
        }

        include __DIR__ . '/../views/auth/login.php';
    }

    public function logout() {
        Session::destroy();
        header('Location: /login');
        exit;
    }
}