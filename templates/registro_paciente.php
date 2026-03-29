<?php
// templates/registro_paciente.php
session_start();
include("config/config.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Paciente</title>
    <link rel="stylesheet" href="/public/css/estilo.css">
    <link rel="stylesheet" href="/public/vendor/lib/fontawesome-free_v5.15.4/css/all.min.css">
    <style>
        form {
            width: 500px;
            margin: 20px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 14px rgba(0,0,0,.12);
        }
        input[type="text"], input[type="password"], input[type="date"], select {
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
        h2 {
            text-align: center;
            color: #333;
            margin-top: 20px;
        }
        .help-icon-container {
            display: inline-block;
            position: relative;
            margin-left: 6px;
        }
        .help-icon {
            color: #4a90e2;
            font-size: 18px;
            cursor: pointer;
        }
        .help-icon:hover {
            color: #2c6bb2;
        }
        .help-tooltip {
            visibility: hidden;
            opacity: 0;
            position: absolute;
            top: 22px;
            left: 0;
            background: #333;
            color: #fff;
            padding: 6px 10px;
            border-radius: 6px;
            font-size: 12px;
            white-space: nowrap;
            transition: opacity 0.2s;
            z-index: 20;
        }
        .help-icon-container:hover .help-tooltip {
            visibility: visible;
            opacity: 1;
        }
    </style>
</head>
<body>
<div class="header">Registro de Paciente</div>
<h2>Crear cuenta</h2>

<form action="registro_paciente_guardar.php" method="post">

    Nombre:
    <span class="help-icon-container">
        <i class="fas fa-question-circle help-icon"></i>
        <span class="help-tooltip">Tu primer nombre</span>
    </span>
    <br>
    <input type="text" name="nombre" required><br>

    Apellidos:
    <span class="help-icon-container">
        <i class="fas fa-question-circle help-icon"></i>
        <span class="help-tooltip">Tu primer apellido</span>
    </span>
    <br>
    <input type="text" name="apellidos" required><br>

    Contraseña:<br>
    <input type="password" name="password" required><br>

    Sexo:<br>
    <select name="sexo">
        <option value="F">Femenino</option>
        <option value="M">Masculino</option>
    </select><br>

    Fecha de nacimiento:<br>
    <input type="date" name="fecha_nacimiento"><br><br>

    <input type="submit" value="Crear cuenta">
    <a href="index.php" style="display: block; text-align: center;">Volver al login</a>
</form>

</body>
</html>
