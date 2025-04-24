<?php
namespace App\Models;

use App\Config\Database;

class Inventory {
    private int $id;
    private string $name;
    private int $quantity;
    private string $description;

    public function __construct(string $name = '', int $quantity = 0, string $description = '') {
        $this->name = $name;
        $this->quantity = $quantity;
        $this->description = $description;
    }

    public function save(): bool {
        if (!$this->validate()) {
            return false;
        }

        Database::addInventoryItem([
            'name' => $this->name,
            'quantity' => $this->quantity,
            'description' => $this->description
        ]);

        return true;
    }

    public static function getAll(): array {
        return Database::getInventory();
    }

    public static function findById(int $id): ?Inventory {
        $items = Database::getInventory();
        foreach ($items as $itemData) {
            if ($itemData['id'] === $id) {
                $item = new Inventory();
                $item->id = $itemData['id'];
                $item->name = $itemData['name'];
                $item->quantity = $itemData['quantity'];
                $item->description = $itemData['description'];
                return $item;
            }
        }
        return null;
    }

    private function validate(): bool {
        if (empty($this->name)) {
            return false;
        }
        if ($this->quantity < 0) {
            return false;
        }
        return true;
    }

    public function update(array $data): bool {
        return Database::updateInventoryItem($this->id, $data);
    }

    public function delete(): bool {
        return Database::deleteInventoryItem($this->id);
    }
}
?>
