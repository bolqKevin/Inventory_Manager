<?php ob_start(); ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h2>Usuarios</h2>
    <a href="/users/create" class="btn btn-primary">Añadir usuario</a>
</div>

<div class="table-responsive">
    <table class="table table-striped" id="usersTable">
        <thead>
            <tr>
                <th>Email</th>
                <th>Rol</th>
                <th>Opciones</th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($users as $user): ?>
            <tr id="user-<?php echo $user['id']; ?>">
                <td><?php echo htmlspecialchars($user['email']); ?></td>
                <td><?php echo htmlspecialchars($user['role']); ?></td>
                <td>
                    <a href="/users/edit/<?php echo $user['id']; ?>" class="btn btn-sm btn-warning">Editar</a>
                    <button class="btn btn-sm btn-danger" data-id="<?php echo $user['id']; ?>">Eliminar</button>
                </td>
            </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
</div>

<script src="/assets/js/users.js"></script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
