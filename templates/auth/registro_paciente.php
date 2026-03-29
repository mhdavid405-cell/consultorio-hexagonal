<?php
session_start();
include("conexion.php");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro de Paciente</title>
    <link rel="stylesheet" href="estilo.css">

    <link rel="stylesheet" href="vendor/lib/fontawesome-free_v5.15.4/css/all.min.css">

    <style>
        .help-icon-container{
            display:inline-block;
            position:relative;
            margin-left:6px;
        }
        .help-icon{
            color:#4a90e2;
            font-size:18px;
            cursor:pointer;
        }
        .help-icon:hover{
            color:#2c6bb2;
        }
        .help-tooltip{
            visibility:hidden;
            opacity:0;
            position:absolute;
            top:22px;
            left:0;
            background:#333;
            color:#fff;
            padding:6px 10px;
            border-radius:6px;
            font-size:12px;
            white-space:nowrap;
            transition:opacity .2s;
            z-index:20;
        }
        .help-icon-container:hover .help-tooltip{
            visibility:visible;
            opacity:1;
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
    <a href="index.php">Volver al login</a>
</form>

</body>
</html>


