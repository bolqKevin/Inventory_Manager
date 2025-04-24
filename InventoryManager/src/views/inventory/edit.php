<?php ob_start(); ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Editar producto del inventario</div>
            <div class="card-body">
                <form method="POST" action="/inventory/edit/<?php echo $item['id']; ?>" id="editInventoryForm">
                    <div class="mb-3">
                        <label for="name" class="form-label">Nombre del producto</label>
                        <input type="text" class="form-control" id="name" name="name" value="<?php echo htmlspecialchars($item['name']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="quantity" class="form-label">Cantidad</label>
                        <input type="number" class="form-control" id="quantity" name="quantity" value="<?php echo htmlspecialchars($item['quantity']); ?>" required min="1">
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Descripción</label>
                        <textarea class="form-control" id="description" name="description" rows="3"><?php echo htmlspecialchars($item['description']); ?></textarea>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar producto</button>
                    <a href="/inventory" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>