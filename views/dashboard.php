<?php
session_start(); // Iniciar sesión para acceder a la información del usuario

if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];
$nombre = htmlspecialchars($usuario['nombre']);
$rol = $usuario['rol'];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Dashboard - PelisApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">PelisApp</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navMenu">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navMenu">
      <ul class="navbar-nav me-auto mb-2 mb-lg-0">
        <li class="nav-item">
          <a class="nav-link active" href="dashboard.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="recommendations.php">Recomendaciones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">Mi Perfil</a>
        </li>
        <?php if ($rol === 'admin'): ?>
        <li class="nav-item">
          <a class="nav-link text-warning" href="admin_panel.php">Panel Admin</a>
        </li>
        <?php endif; ?>
      </ul>
      <span class="navbar-text me-3 text-light">
        Bienvenido, <?= $nombre ?> (<?= $rol ?>)
      </span>
      <a class="btn btn-outline-light btn-sm" href="../logout.php">Cerrar sesión</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h1 class="display-6">Hola <?= $nombre ?> 👋</h1>
    <p class="lead">Explora y recibe recomendaciones de películas o series según tus intereses.</p>

    <div class="row">
        <div class="col-md-6">
            <div class="card shadow-sm">
                <div class="card-body">
                    <h5 class="card-title">Ver Recomendaciones</h5>
                    <p class="card-text">Consulta las sugerencias personalizadas para ti.</p>
                    <a href="recommendations.php" class="btn btn-primary">Ir</a>
                </div>
            </div>
        </div>
        <?php if ($rol === 'admin'): ?>
        <div class="col-md-6">
            <div class="card shadow-sm border-warning">
                <div class="card-body">
                    <h5 class="card-title">Gestión de Contenido</h5>
                    <p class="card-text">Agregar, editar o eliminar películas y series.</p>
                    <a href="admin_panel.php" class="btn btn-warning">Panel Admin</a>
                </div>
            </div>
        </div>
        <?php endif; ?>
    </div>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
