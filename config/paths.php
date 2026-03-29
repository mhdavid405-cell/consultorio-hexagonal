<?php
// config/paths.php - Configuración de rutas globales

// Detectar automáticamente la URL base
$protocol = isset($_SERVER['HTTPS']) && $_SERVER['HTTPS'] === 'on' ? 'https://' : 'http://';
$host = $_SERVER['HTTP_HOST'] ?? 'localhost:8080';
$base_url = $protocol . $host . '/';

define('BASE_URL', $base_url);
define('CSS_PATH', BASE_URL . 'public/css/');
define('JS_PATH', BASE_URL . 'public/js/');
define('VENDOR_PATH', BASE_URL . 'public/vendor/');
define('IMAGES_PATH', BASE_URL . 'public/images/');
