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
}
?>
