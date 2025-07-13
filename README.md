# 🎬 Plataforma de Recomendación de Películas/Series  
**Proyecto Final - Desarrollo de Software VII**  
**Universidad Tecnológica de Panamá – Facultad de Ingeniería de Sistemas Computacionales**

---

## 🧠 Objetivo General

Desarrollar una aplicación web dinámica utilizando **PHP** acerca de una **plataforma de recomendación de películas/series**.  
La aplicación permitirá a los usuarios:
- Registrarse,
- Iniciar sesión,
- Explorar películas o series,
- Recibir recomendaciones personalizadas según sus intereses,  
utilizando **cookies, sesiones y webservices con XML/JSON**.

---

## ✅ Requisitos

### 🔐 Autenticación de Usuarios
- Registro e inicio de sesión de usuarios.
- Roles: usuario estándar y administrador.

### 🧠 Manejo de Sesiones y Cookies
- Mantener sesión iniciada con cookies.
- Personalización de experiencia (tema, nombre del usuario, últimas vistas, etc.).
- Diferenciar la experiencia del usuario según su rol.

### 🗃️ Base de Datos
- Almacenar usuarios, películas/series, calificaciones o preferencias.
- Relaciones entre tablas: usuarios, contenido, géneros, etc.

### 📋 Registro de Preferencias
- Selección de géneros favoritos mediante checkboxes.
- Las preferencias se usan para filtrar recomendaciones.

### 🤖 Sistema de Recomendaciones
- Mostrar contenido basado en los géneros favoritos o el historial de navegación del usuario.

### 🛠️ Funciones del Administrador
- Agregar, editar o eliminar películas/series.
- Ver resumen del comportamiento de los usuarios (por ejemplo, géneros más visitados).

---

## 🌐 Consumo de Webservices
- Usar al menos un archivo **XML o JSON** para alimentar o intercambiar información con la app (ej.: cargar contenido o exportar datos).

---

## 🔐 Seguridad
- Validación y sanitización de formularios (**XSS**, **SQLi**, fuerza bruta).
- Estructura organizada de carpetas para restringir el acceso a archivos sensibles.

---

## 🖥️ Interfaz
- Diseño amigable, organizado por secciones (inicio, recomendaciones, perfil, etc.).
- Personalización visual básica por usuario (tema claro/oscuro con cookies).
