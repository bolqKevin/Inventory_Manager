<?php ob_start(); ?>

<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Editar usuario</div>
            <div class="card-body">
                <form method="POST" action="/users/edit/<?php echo $user['id']; ?>" id="editUserForm">
                    <div class="mb-3">
                        <label for="email" class="form-label">Correo</label>
                        <input type="email" class="form-control" id="email" name="email" value="<?php echo htmlspecialchars($user['email']); ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password" name="password">
                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password">*</button>
                        </div>
                        <small class="form-text text-muted">Deja en blanco si no deseas cambiar la contraseña</small>
                    </div>

                    <div class="mb-3">
                        <label for="password_confirm" class="form-label">Confirmar Contraseña</label>
                        <div class="input-group">
                            <input type="password" class="form-control" id="password_confirm" name="password_confirm">
                            <button type="button" class="btn btn-outline-secondary toggle-password" data-target="password_confirm">*</button>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="role" class="form-label">Rol</label>
                        <select class="form-select" id="role" name="role" required>
                            <option value="user" <?php echo $user['role'] === 'user' ? 'selected' : ''; ?>>Usuario</option>
                            <option value="admin" <?php echo $user['role'] === 'admin' ? 'selected' : ''; ?>>Administrador</option>
                        </select>
                    </div>
                    <button type="submit" class="btn btn-primary">Actualizar usuario</button>
                    <a href="/users" class="btn btn-secondary">Cancelar</a>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', () => {
    const form = document.getElementById('editUserForm');

    // Validations
    if (form) {
        form.addEventListener('submit', (e) => {
            const email = document.getElementById('email').value;
            const password = document.getElementById('password').value;
            const passwordConfirm = document.getElementById('password_confirm').value;

            if (!email) {
                e.preventDefault();
                alert('Por favor llenar todos los campos');
                return;
            }

            if (password && password !== passwordConfirm) {
                e.preventDefault();
                alert('Las contraseñas no coinciden');
                return;
            }

            if (password && password.length < 6) {
                e.preventDefault();
                alert('La contraseña debe tener al menos 6 caracteres');
                return;
            }
        });
    }

    // hide/show toggle
    document.querySelectorAll('.toggle-password').forEach(button => {
        button.addEventListener('click', () => {
            const input = document.getElementById(button.dataset.target);
            if (input) {
                input.type = input.type === 'password' ? 'text' : 'password';
            }
        });
    });
});
</script>

<?php
$content = ob_get_clean();
include __DIR__ . '/../layouts/main.php';
?>
