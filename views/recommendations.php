<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

require '../config/db.php';
$usuario_id = $_SESSION['usuario']['id'];
$nombre = $_SESSION['usuario']['nombre'];

// 1. Obtener preferencias del usuario
$stmt = $pdo->prepare("SELECT genero FROM preferencias WHERE usuario_id = ?");
$stmt->execute([$usuario_id]);
$generos = $stmt->fetchAll(PDO::FETCH_COLUMN);

// 2. Si no tiene preferencias, se muestra un aviso
if (empty($generos)) {
    $recomendaciones = [];
} else {
    // 3. Buscar contenido que coincida con alguno de los géneros preferidos
    $placeholders = rtrim(str_repeat('?,', count($generos)), ',');
    $query = "SELECT * FROM contenido WHERE genero IN ($placeholders)";
    $stmt = $pdo->prepare($query);
    $stmt->execute($generos);
    $recomendaciones = $stmt->fetchAll();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Recomendaciones - PelisApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../includes/navbar.php'; ?>

<div class="container mt-5">
    <h2 class="mb-4">Recomendaciones para <?= htmlspecialchars($nombre) ?></h2>

    <?php if (empty($generos)): ?>
        <div class="alert alert-info">
            Aún no has seleccionado tus géneros favoritos.
            <a href="profile.php" class="alert-link">Hazlo aquí</a> para recibir recomendaciones.
        </div>
    <?php elseif (empty($recomendaciones)): ?>
        <div class="alert alert-warning">
            No hay contenido disponible que coincida con tus preferencias por ahora.
        </div>
    <?php else: ?>
        <div class="row">
            <?php foreach ($recomendaciones as $item): ?>
                <div class="col-md-4 mb-4">
                    <div class="card h-100 shadow-sm">
                        <!-- Si tiene imagen, la muestra -->
                        <?php if (!empty($item['imagen'])): ?>
                            <img src="../assets/img/<?= $item['imagen'] ?>" class="card-img-top" alt="<?= $item['titulo'] ?>">
                        <?php endif; ?>
                        <div class="card-body">
                            <h5 class="card-title"><?= htmlspecialchars($item['titulo']) ?></h5>
                            <p class="card-text"><?= htmlspecialchars($item['descripcion']) ?></p>
                            <span class="badge bg-secondary"><?= $item['genero'] ?></span>
                            <span class="badge bg-dark"><?= $item['tipo'] ?></span>
                        </div>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
    <?php endif; ?>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
