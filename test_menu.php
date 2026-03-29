<?php
// test_menu.php - Prueba directa
require_once __DIR__ . '/config/config.php';
session_start();

// Forzar sesión para prueba
$_SESSION["usuario"] = "prueba";
$_SESSION["rol"] = "admin";

echo "<h1>Test de Menú</h1>";
echo "<p>CSS URL: " . CSS_URL . "estilo.css</p>";
echo "<p>Usuario: " . $_SESSION["usuario"] . "</p>";
echo "<link rel='stylesheet' href='" . CSS_URL . "estilo.css'>";
echo "<hr>";
echo "<a href='templates/menu.php'>Ir a menu.php original</a>";
