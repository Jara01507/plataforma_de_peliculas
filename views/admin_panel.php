<?php
session_start();

// Redirigir si no hay usuario o si no es admin
if (!isset($_SESSION['usuario']) || $_SESSION['usuario']['rol'] !== 'admin') {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];
$nombre = htmlspecialchars($usuario['nombre']);
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Panel Admin - PelisApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-expand-lg navbar-dark bg-dark">
  <div class="container-fluid">
    <a class="navbar-brand" href="#">PelisApp</a>
    <div class="collapse navbar-collapse">
      <ul class="navbar-nav me-auto">
        <li class="nav-item">
          <a class="nav-link" href="dashboard.php">Inicio</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="recommendations.php">Recomendaciones</a>
        </li>
        <li class="nav-item">
          <a class="nav-link" href="profile.php">Mi Perfil</a>
        </li>
        <li class="nav-item">
          <a class="nav-link active text-warning" href="admin_panel.php">Panel Admin</a>
        </li>
      </ul>
      <span class="navbar-text text-light me-3">
        Bienvenido, <?= $nombre ?> (Admin)
      </span>
      <a href="../logout.php" class="btn btn-outline-light btn-sm">Cerrar sesión</a>
    </div>
  </div>
</nav>

<div class="container mt-5">
    <h2>Gestión de Contenido 🎬</h2>

    <!-- Mensajes de éxito o error -->
    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-success"><?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></div>
    <?php elseif (isset($_SESSION['error'])): ?>
        <div class="alert alert-danger"><?= $_SESSION['error']; unset($_SESSION['error']); ?></div>
    <?php endif; ?>

    <!-- Formulario para agregar contenido -->
    <div class="card mb-4 shadow-sm">
        <div class="card-header">Agregar nueva película o serie</div>
        <div class="card-body">
            <form method="POST" action="../controllers/admin.php">
                <div class="mb-3">
                    <label class="form-label">Título</label>
                    <input type="text" class="form-control" name="titulo" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Género</label>
                    <input type="text" class="form-control" name="genero" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Año</label>
                    <input type="number" class="form-control" name="anio" required>
                </div>
                <div class="mb-3">
                    <label class="form-label">Tipo</label>
                    <select class="form-select" name="tipo" required>
                        <option value="pelicula">Película</option>
                        <option value="serie">Serie</option>
                    </select>
                </div>
                <button type="submit" name="agregar" class="btn btn-primary">Agregar</button>
            </form>
        </div>
    </div>

    <!-- Tabla con contenido actual -->
    <div class="card shadow-sm">
        <div class="card-header">Catálogo actual</div>
        <div class="card-body">
            <?php
            // Obtener contenido desde la base de datos
            require '../config/db.php';
            $stmt = $pdo->query("SELECT * FROM contenido ORDER BY id DESC");
            $resultados = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <?php if ($resultados): ?>
                <table class="table table-bordered table-striped">
                    <thead>
                        <tr>
                            <th>Título</th>
                            <th>Género</th>
                            <th>Año</th>
                            <th>Tipo</th>
                            <th>Acción</th>
                        </tr>
                    </thead>
                    <tbody>
                    <?php foreach ($resultados as $fila): ?>
                        <tr>
                            <td><?= htmlspecialchars($fila['titulo']) ?></td>
                            <td><?= htmlspecialchars($fila['genero']) ?></td>
                            <td><?= htmlspecialchars($fila['anio']) ?></td>
                            <td><?= htmlspecialchars($fila['tipo']) ?></td>
                            <td>
                                <form method="POST" action="../controllers/admin.php" class="d-inline">
                                    <input type="hidden" name="id" value="<?= $fila['id'] ?>">
                                    <button type="submit" name="eliminar" class="btn btn-sm btn-danger">Eliminar</button>
                                </form>
                            </td>
                        </tr>
                    <?php endforeach; ?>
                    </tbody>
                </table>
            <?php else: ?>
                <p class="text-muted">No hay contenido registrado aún.</p>
            <?php endif; ?>
        </div>
    </div>
</div>
</body>
</html>
