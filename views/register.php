<?php include '../config/db.php'; session_start(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro - PelisApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container mt-5">
    <h2 class="mb-4">Registro de Usuario</h2>
    <form method="POST" action="../controllers/auth.php">
        <div class="mb-3">
            <label for="nombre" class="form-label">Nombre completo</label>
            <input type="text" class="form-control" name="nombre" required>
        </div>
        <div class="mb-3">
            <label for="correo" class="form-label">Correo electrónico</label>
            <input type="email" class="form-control" name="correo" required>
        </div>
        <div class="mb-3">
            <label for="clave" class="form-label">Contraseña</label>
            <input type="password" class="form-control" name="clave" required>
        </div>
        <button type="submit" name="registrar" class="btn btn-primary">Registrarse</button>
        <a href="login.php" class="btn btn-link">¿Ya tienes cuenta? Inicia sesión</a>
    </form>
</div>
</body>
</html>
