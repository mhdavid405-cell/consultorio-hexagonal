<?php
// templates/conexion.php

$host = getenv('MYSQL_HOST') ?: 'host.docker.internal';
$user = getenv('MYSQL_USER') ?: 'root';
$pass = getenv('MYSQL_PASSWORD') ?: '';
$db   = getenv('MYSQL_DATABASE') ?: 'consultorio';

$conexion = mysqli_connect($host, $user, $pass, $db);

if (!$conexion) {
    die("Error al conectar a la base de datos: " . mysqli_connect_error());
}