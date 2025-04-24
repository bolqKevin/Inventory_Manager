<?php ob_start(); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Productos del Inventario</h2>
    <a href="/inventory/create" class="btn btn-primary">Añadir producto</a>
</div>

<div class="table-responsive">
    <table class="table table-striped" id="inventoryTable">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nombre</th>
                <th>Cantidad</th>
                <th>Descripción</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($inventory as $item): ?>
            <tr id="item-<?php echo $item['id']; ?>">
                <td><?php echo htmlspecialchars($item['id']); ?></td>
                <td><?php echo htmlspecialchars($item['name']); ?></td>
                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                <td><?php echo htmlspecialchars($item['description']); ?></td>
                <td>
                <a href="/inventory/edit/<?php echo $item['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                <button class="btn btn-sm btn-danger" data-id="<?php echo $item['id']; ?>">Eliminar</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="/assets/js/inventory.js"></script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
