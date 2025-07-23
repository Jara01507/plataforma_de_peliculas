<?php
// 🔍 Mostrar errores (modo desarrollo)
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

// 🔗 Conexión a la base de datos
require '../config/db.php';

// 🟠 Iniciar sesión PHP
session_start();


// ==========================
// 📝 REGISTRO DE USUARIO
// ==========================
if (isset($_POST['registrar'])) {
    $nombre = trim($_POST['nombre']);
    $correo = trim($_POST['correo']);
    $clave = password_hash($_POST['clave'], PASSWORD_DEFAULT);

    // Validación simple (puedes mejorarla después)
    if (empty($nombre) || empty($correo) || empty($clave)) {
        $_SESSION['error'] = "Todos los campos son obligatorios.";
        header("Location: ../views/register.php");
        exit;
    }

    // Verificar si ya existe el correo
    $stmt = $pdo->prepare("SELECT id FROM usuarios WHERE correo = ?");
    $stmt->execute([$correo]);
    if ($stmt->fetch()) {
        $_SESSION['error'] = "Ese correo ya está registrado.";
        header("Location: ../views/register.php");
        exit;
    }

    // Registrar nuevo usuario
    $stmt = $pdo->prepare("INSERT INTO usuarios (nombre, correo, clave) VALUES (?, ?, ?)");
    $stmt->execute([$nombre, $correo, $clave]);

    $_SESSION['mensaje'] = "Registro exitoso. Ahora puedes iniciar sesión.";
    header("Location: ../views/login.php");
    exit;
}


// ==========================
// 🔐 LOGIN DE USUARIO
// ==========================
if (isset($_POST['login'])) {
    $correo = trim($_POST['correo']);
    $clave = $_POST['clave'];

    // Validación básica
    if (empty($correo) || empty($clave)) {
        $_SESSION['error'] = "Completa todos los campos.";
        header("Location: ../views/login.php");
        exit;
    }

    // Buscar el usuario por correo
    $stmt = $pdo->prepare("SELECT * FROM usuarios WHERE correo = ?");
    $stmt->execute([$correo]);
    $usuario = $stmt->fetch(PDO::FETCH_ASSOC);

    // Verificar contraseña
    if ($usuario && password_verify($clave, $usuario['clave'])) {
        $_SESSION['usuario'] = $usuario;
        header("Location: ../views/dashboard.php");
        exit;
    } else {
        $_SESSION['error'] = "Correo o contraseña incorrectos.";
        header("Location: ../views/login.php");
        exit;
    }
}
