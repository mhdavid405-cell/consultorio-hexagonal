<?php
// config/database.php
$isDocker = getenv('MYSQL_HOST') !== false;

if ($isDocker) {
    $db_host = getenv('MYSQL_HOST') ?: 'host.docker.internal';
    $db_user = getenv('MYSQL_USER') ?: 'root';
    $db_pass = getenv('MYSQL_PASSWORD') ?: '235689';
    $db_name = getenv('MYSQL_DATABASE') ?: 'consultorio';
    
    // Usar mysqli con opción MYSQLI_CLIENT_SSL_DONT_VERIFY_SERVER_CERT
    $conexion = mysqli_init();
    mysqli_options($conexion, MYSQLI_OPT_SSL_VERIFY_SERVER_CERT, false);
    mysqli_real_connect($conexion, $db_host, $db_user, $db_pass, $db_name);
    
    if (!$conexion) {
        // Fallback: intentar sin SSL
        $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
    }
} else {
    $db_host = 'localhost';
    $db_user = 'root';
    $db_pass = '235689';
    $db_name = 'consultorio';
    $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_name);
}

if (!$conexion) {
    die("Error al conectar: " . mysqli_connect_error());
}

mysqli_set_charset($conexion, "utf8mb4");
