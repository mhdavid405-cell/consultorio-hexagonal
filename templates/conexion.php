<?php
// templates/conexion.php

$conexion = mysqli_connect("localhost", "root", "235689", "consultorio");

if (!$conexion) {
    die("Error al conectar a la base de datos");
}

