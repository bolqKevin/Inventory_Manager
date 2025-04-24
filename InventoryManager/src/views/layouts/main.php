<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sistema de administración de inventario</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="/assets/css/style.css" rel="stylesheet">

    <!-- Favicon -->
    <!-- <link rel="icon" href="" type="image/x-icon"> -->
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
        <div class="container">
            <a class="navbar-brand" href="#" id="inventory-manager-title">Inventory Manager</a>
            <?php if (\App\Utils\Session::isAuthenticated()): ?>
            <div class="navbar-nav">
                <a class="nav-link" href="/inventory">Inventario</a>
                <?php if (\App\Utils\Session::get('user_role') === 'admin'): ?>
                    <a class="nav-link" href="/users">Usuarios</a>
                <?php endif; ?>
                <a class="nav-link" href="/logout">Cerrar sesión</a>
            </div>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container mt-4">
        <?php echo $content ?? ''; ?>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        function checkAuthentication() {
            return <?php echo \App\Utils\Session::isAuthenticated() ? 'true' : 'false'; ?>;
        }

        document.getElementById('inventory-manager-title').addEventListener('click', function(event) {
            if (checkAuthentication()) {
                window.location.href = '/inventory';
            } else {
                window.location.href = '/login';
            }
        });
    </script>
</body>
</html>
