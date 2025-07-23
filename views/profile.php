<?php
session_start();
if (!isset($_SESSION['usuario'])) {
    header("Location: login.php");
    exit;
}

$usuario = $_SESSION['usuario'];
$usuario_id = $usuario['id'];

require '../config/db.php';

// Lista de géneros disponibles
$generos = [
    'Acción', 'Aventura', 'Comedia', 'Drama', 'Fantasía',
    'Terror', 'Romance', 'Ciencia ficción', 'Suspenso', 'Animación'
];

// Obtener preferencias actuales del usuario
$stmt = $pdo->prepare("SELECT genero FROM preferencias WHERE usuario_id = ?");
$stmt->execute([$usuario_id]);
$preferencias_actuales = $stmt->fetchAll(PDO::FETCH_COLUMN);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Preferencias - PelisApp</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
<?php include '../includes/navbar.php'; ?>

<div class="container mt-5">
    <h2 class="mb-3">Mis preferencias</h2>
    <p class="text-muted">Selecciona tus géneros favoritos para recibir recomendaciones.</p>

    <!-- Mostrar mensaje si existe -->
    <?php if (isset($_SESSION['mensaje'])): ?>
        <div class="alert alert-success"><?= $_SESSION['mensaje']; unset($_SESSION['mensaje']); ?></div>
    <?php endif; ?>

    <!-- Formulario de preferencias -->
    <form action="../controllers/preferences.php" method="POST">
        <div class="row">
            <?php foreach ($generos as $genero): ?>
                <div class="col-md-4">
                    <div class="form-check">
                        <!-- Checkbox marcado si el género ya está en la tabla de preferencias -->
                        <input class="form-check-input" type="checkbox" name="generos[]" value="<?= $genero ?>"
                            <?= in_array($genero, $preferencias_actuales) ? 'checked' : '' ?>>
                        <label class="form-check-label"><?= $genero ?></label>
                    </div>
                </div>
            <?php endforeach; ?>
        </div>
        <button type="submit" name="guardar" class="btn btn-primary mt-4">Guardar preferencias</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
