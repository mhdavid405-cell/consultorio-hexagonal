<?php
// templates/pacientes/agregar.php
session_start();
if(!isset($_SESSION["usuario"])){ 
    header("Location: ../../index.php"); 
    exit; 
}

require_once __DIR__ . '/../../config/config.php';
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agregar Paciente</title>
    <link rel="stylesheet" href="/public/css/estilo.css">
    <style>
        form {
            width: 500px;
            margin: 20px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 14px rgba(0,0,0,.12);
        }
        input[type="text"], input[type="number"], input[type="date"], input[type="password"], select {
            width: 95%;
            padding: 10px;
            margin-top: 5px;
            margin-bottom: 14px;
            border-radius: 6px;
            border: 1px solid #bbb;
            font-size: 15px;
        }
        input[type="submit"] {
            width: 100%;
            background: #4a90e2;
            color: #fff;
            border: none;
            padding: 12px;
            border-radius: 6px;
            cursor: pointer;
            font-size: 16px;
            font-weight: bold;
        }
        input[type="submit"]:hover {
            background: #2c6bb2;
        }
        h3 {
            color: #4a90e2;
            margin-top: 20px;
            margin-bottom: 10px;
        }
        .header {
            background: #4a90e2;
            padding: 12px;
            color: #fff;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
        }
        a {
            text-decoration: none;
            color: #4a90e2;
            margin: 15px;
            display: inline-block;
        }
        a:hover {
            color: #2c6bb2;
        }
    </style>
</head>
<body>
<div class="header">Agregar Paciente</div>
<a href="lista.php">← Volver a lista</a>
<br><br>

<form action="guardar.php" method="POST">
    <h3>Datos de acceso del paciente</h3>

    Nombre:
    <input type="text" name="nombre" required>

    Apellidos:
    <input type="text" name="apellidos" required>

    Contraseña:
    <input type="password" name="password" required>

    <h3>Datos personales</h3>

    Sexo:
    <select name="sexo">
        <option value="F">Femenino</option>
        <option value="M">Masculino</option>
    </select>

    Fecha de nacimiento:
    <input type="date" name="fecha_nacimiento">

    Edad:
    <input type="number" name="edad" min="1">

    Peso (kg):
    <input type="number" name="peso" step="any" min="20">

    Altura (cm):
    <input type="number" name="altura" min="1" step="0.01">

    Alergias:
    <input type="text" name="alergias">

    Padecimientos:
    <input type="text" name="padecimientos">

    <br><br>
    <input type="submit" value="Guardar Paciente">
</form>
</body>
</html>
