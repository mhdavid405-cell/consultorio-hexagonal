<?php
/**
 * config/config.php
 * Configuración global de la aplicación.
 * Todas las credenciales se leen desde variables de entorno.
 * Nunca escribas passwords directamente aquí.
 */
if (!defined("BASE_URL")) {

    // Conexión a base de datos — 100% desde entorno
    $db_host = getenv("MYSQL_HOST") ?: "localhost";
    $db_user = getenv("MYSQL_USER") ?: "root";
    $db_pass = getenv("MYSQL_PASSWORD") ?: "";
    $db_name = getenv("MYSQL_DATABASE") ?: "consultorio";

    $conexion = mysqli_connect($db_host, $db_user, $db_pass, $db_name);

    if (!$conexion) {
        die("Error al conectar a la base de datos: " . mysqli_connect_error());
    }

    mysqli_set_charset($conexion, "utf8mb4");

    // URL base dinámica
    $protocol = isset($_SERVER["HTTPS"]) && $_SERVER["HTTPS"] === "on" ? "https://" : "http://";
    $host = $_SERVER["HTTP_HOST"] ?? "localhost:8080";
    define("BASE_URL", $protocol . $host . "/");
    define("CSS_URL", "/public/css/");
    define("JS_URL", "/public/js/");
    define("VENDOR_URL", "/public/vendor/");
    define("IMAGES_URL", "/public/images/");
}
