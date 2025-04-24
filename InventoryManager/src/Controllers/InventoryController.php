<?php
namespace App\Controllers;

use App\Config\Database;
use App\Utils\Session;

class InventoryController {
    public function index() {
        if (!Session::isAuthenticated()) {
            header('Location: /login');
            exit;
        }
        
        $inventory = Database::getInventory();
        include __DIR__ . '/../views/inventory/index.php';
    }
    
    public function create() {
        if (!Session::isAuthenticated()) {
            header('Location: /login');
            exit;
        }
        
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $quantity = (int)($_POST['quantity'] ?? 0);
            $description = $_POST['description'] ?? '';
            
            if ($name && $quantity > 0) {
                Database::addInventoryItem([
                    'name' => $name,
                    'quantity' => $quantity,
                    'description' => $description
                ]);
                header('Location: /inventory');
                exit;
            }
        }
        
        include __DIR__ . '/../views/inventory/create.php';
    }

    public function edit($id) {
        if (!Session::isAuthenticated()) {
            header('Location: /login');
            exit;
        }

        $item = Database::getInventoryItem($id);
        if (!$item) {
            header('Location: /inventory');
            exit;
        }

        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $name = $_POST['name'] ?? '';
            $quantity = (int)($_POST['quantity'] ?? 0);
            $description = $_POST['description'] ?? '';

            if ($name && $quantity > 0) {
                Database::updateInventoryItem($id, [
                    'name' => $name,
                    'quantity' => $quantity,
                    'description' => $description
                ]);
                header('Location: /inventory');
                exit;
            }
        }

        include __DIR__ . '/../views/inventory/edit.php';
    }

    public function delete($id) {
        if (!Session::isAuthenticated()) {
            
            echo json_encode(['success' => false, 'message' => 'User not authenticated']);
            exit;
        }
    
        $deleted = Database::deleteInventoryItem($id);
        if ($deleted) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Failed to delete inventory item']);
        }
        exit;
    }
    
}
