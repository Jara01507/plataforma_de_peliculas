<?php
session_start();
require '../config/db.php';

if (isset($_POST['guardar']) && isset($_SESSION['usuario'])) {
    $usuario_id = $_SESSION['usuario']['id'];
    $generos_seleccionados = $_POST['generos'] ?? [];

    // Eliminar preferencias anteriores para actualizar con las nuevas
    $stmt = $pdo->prepare("DELETE FROM preferencias WHERE usuario_id = ?");
    $stmt->execute([$usuario_id]);

    // Insertar nuevas preferencias seleccionadas
    $stmt_insert = $pdo->prepare("INSERT INTO preferencias (usuario_id, genero) VALUES (?, ?)");

    foreach ($generos_seleccionados as $genero) {
        $stmt_insert->execute([$usuario_id, htmlspecialchars($genero)]);
    }

    $_SESSION['mensaje'] = "Preferencias actualizadas correctamente.";
    header("Location: ../views/profile.php");
    exit;
} else {
    header("Location: ../views/profile.php");
    exit;
}
