<?php

class User {
    private $id;
    private $email;
    private $password;
    private $role;

    public function __construct($id, $email, $password, $role = 'user') {
        $this->id = $id;
        $this->email = $email;
        $this->password = $password;
        $this->role = $role;
    }

    public function getId() {
        return $this->id;
    }

    public function getEmail() {
        return $this->email;
    }

    public function getRole() {
        return $this->role;
    }

    public function isAdmin() {
        return $this->role === 'admin';
    }

    public static function findByEmail($email) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User($row['id'], $row['email'], $row['password'], $row['role']);
        }

        return null;
    }

    public static function findById($id) {
        $db = Database::getConnection();
        $stmt = $db->prepare("SELECT * FROM users WHERE id = ?");
        $stmt->execute([$id]);
        $row = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($row) {
            return new User($row['id'], $row['email'], $row['password'], $row['role']);
        }

        return null;
    }

    public function verifyPassword($password) {
        return password_verify($password, $this->password);
    }
}
