<?php
namespace App\Config;

use PDO;

class Database {
    private static ?PDO $connection = null;

    private static function connect(): PDO {
        if (self::$connection === null) {
            try {
                self::$connection = new PDO(
                    "sqlsrv:Server=DESKTOP-H5C1G1L\\SQLEXPRESS;Database=InventorySystem;TrustServerCertificate=true",
                    null, 
                    null, 
                    [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]
                );
            } catch (PDOException $e) {
                die("Connection failed: " . $e->getMessage());
            }
        }
    
        return self::$connection;
    }
    

    public static function getUsers(): array {
        $stmt = self::connect()->query("SELECT * FROM users");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function addUser(array $user): void {
        $stmt = self::connect()->prepare("INSERT INTO users (email, password, role) VALUES (:email, :password, :role)");
        $stmt->execute([
            ':email' => $user['email'],
            ':password' => $user['password'],
            ':role' => $user['role'] ?? 'user'
        ]);
    }    

    public static function updateUser(int $id, array $data): bool {
        if (!empty($data['password'])) {
            $stmt = self::connect()->prepare(
                "UPDATE users SET email = :email, password = :password, role = :role WHERE id = :id"
            );
            return $stmt->execute([
                ':email' => $data['email'],
                ':password' => $data['password'],
                ':role' => $data['role'],
                ':id' => $id
            ]);
        } else {
            $stmt = self::connect()->prepare(
                "UPDATE users SET email = :email, role = :role WHERE id = :id"
            );
            return $stmt->execute([
                ':email' => $data['email'],
                ':role' => $data['role'],
                ':id' => $id
            ]);
        }
    }
    

    public static function deleteUser(int $id): bool {
        $stmt = self::connect()->prepare("DELETE FROM users WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }

    public static function getUserById(int $id): ?array {
        $stmt = self::connect()->prepare("SELECT * FROM users WHERE id = :id");
        $stmt->bindParam(':id', $id, PDO::PARAM_INT);
        $stmt->execute();
        
        return $stmt->fetch(PDO::FETCH_ASSOC) ?: null;
    }
    

    public static function getInventory(): array {
        $stmt = self::connect()->query("SELECT * FROM inventory");
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getInventoryItem(int $id): ?array {
        $stmt = self::connect()->prepare("SELECT * FROM inventory WHERE id = :id");
        $stmt->execute([':id' => $id]);
        $item = $stmt->fetch(PDO::FETCH_ASSOC);
        return $item ?: null;
    }

    public static function addInventoryItem(array $item): void {
        $stmt = self::connect()->prepare("INSERT INTO inventory (name, quantity, description) VALUES (:name, :quantity, :description)");
        $stmt->execute([
            ':name' => $item['name'],
            ':quantity' => $item['quantity'],
            ':description' => $item['description']
        ]);
    }

    public static function updateInventoryItem(int $id, array $data): bool {
        $stmt = self::connect()->prepare("UPDATE inventory SET name = :name, quantity = :quantity, description = :description WHERE id = :id");
        return $stmt->execute([
            ':name' => $data['name'],
            ':quantity' => $data['quantity'],
            ':description' => $data['description'],
            ':id' => $id
        ]);
    }

    public static function deleteInventoryItem(int $id): bool {
        $stmt = self::connect()->prepare("DELETE FROM inventory WHERE id = :id");
        return $stmt->execute([':id' => $id]);
    }
}
?>
