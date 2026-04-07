<?php
/**
 * conexion.php
 * Punto único de conexión a la base de datos.
 * Lee siempre desde variables de entorno — nunca hardcodea credenciales.
 * Copia .env.example a .env y ajusta tus valores antes de correr el proyecto.
 */

$db_host = getenv('MYSQL_HOST') ?: 'localhost';
$db_user = getenv('MYSQL_USER') ?: 'root';
$db_pass = getenv('MYSQL_PASSWORD') ?: '';
$db_name = getenv('MYSQL_DATABASE') ?: 'consultorio';

$conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

if (!$conexion) {
    http_response_code(503);
    die('Error de conexión a la base de datos: ' . mysqli_connect_error());
}

mysqli_set_charset($conexion, 'utf8mb4');
