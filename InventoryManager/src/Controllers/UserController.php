<?php
namespace App\Controllers;

use App\Config\Database;
use App\Utils\Session;

class UserController {
    public function index() {
        if (!Session::isAuthenticated()) {
            header('Location: /login');
            exit;
        }

        $users = Database::getUsers();
        include __DIR__ . '/../views/users/index.php';
    }

    public function create() {
        if (!Session::isAuthenticated()) {
            header('Location: /login');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'user';

            if ($email && $password) {
                Database::addUser([
                    'email' => $email,
                    'password' => password_hash($password, PASSWORD_DEFAULT),
                    'role' => $role
                ]);
                header('Location: /users');
                exit;
            }
        }

        include __DIR__ . '/../views/users/create.php';
    }

    public function edit($id) {
        if (!Session::isAuthenticated()) {
            header('Location: /login');
            exit;
        }

        $user = Database::getUserById($id);
        if (!$user) {
            header('Location: /users');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $email = $_POST['email'] ?? '';
            $password = $_POST['password'] ?? '';
            $role = $_POST['role'] ?? 'user';

            $updateData = [
                'email' => $email,
                'role' => $role
            ];
            if ($password) {
                $updateData['password'] = password_hash($password, PASSWORD_DEFAULT);
            }

            Database::updateUser($id, $updateData);
            header('Location: /users');
            exit;
        }

        include __DIR__ . '/../views/users/edit.php';
    }

    public function delete($id) {
        if (!Session::isAuthenticated()) {
            echo json_encode(['success' => false, 'message' => 'User not authenticated']);
            exit;
        }

        $deleted = Database::deleteUser($id);
        if ($deleted) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete user']);
        }
        exit;
    }
}
