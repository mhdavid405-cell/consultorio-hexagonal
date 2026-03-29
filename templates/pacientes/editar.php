<?php
// templates/pacientes/editar.php
session_start();
if(!isset($_SESSION["usuario"])){ 
    header("Location: ../../index.php"); 
    exit; 
}

require_once __DIR__ . '/../../config/config.php';

$id = $_GET["id"];
$r = mysqli_query($conexion, "SELECT * FROM pacientes WHERE id=$id");
$f = mysqli_fetch_assoc($r);

$rp = mysqli_query($conexion, "SELECT id, CONCAT(nombre,' ',apellidos) AS nom FROM pacientes ORDER BY nom ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Paciente</title>
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
        input[type="text"], input[type="number"], input[type="date"], select {
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
<div class="header">Editar Paciente</div>
<a href="lista.php">← Volver a lista</a>
<br><br>

<form action="actualizar.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $f['id']; ?>">

    <h3>Datos personales</h3>

    Nombre:
    <input type="text" name="nombre" value="<?php echo $f['nombre']; ?>" required>

    Apellidos:
    <input type="text" name="apellidos" value="<?php echo $f['apellidos']; ?>" required>

    Sexo:
    <select name="sexo">
        <option <?php if($f['sexo']=='F') echo 'selected'; ?>>F</option>
        <option <?php if($f['sexo']=='M') echo 'selected'; ?>>M</option>
    </select>

    Fecha de nacimiento:
    <input type="date" name="fecha_nacimiento" value="<?php echo $f['fecha_nacimiento']; ?>">

    Edad:
    <input type="number" name="edad" min="1" value="<?php echo $f['edad']; ?>">

    Peso (kg):
    <input type="number" name="peso" step="any" min="20" value="<?php echo $f['peso']; ?>">

    Altura (cm):
    <input type="number" name="altura" min="1" step="0.01" value="<?php echo $f['altura']; ?>">

    Alergias:
    <input type="text" name="alergias" value="<?php echo $f['alergias']; ?>">

    Padecimientos:
    <input type="text" name="padecimientos" value="<?php echo $f['padecimientos']; ?>">

    <input type="submit" value="Actualizar">
</form>

</body>
</html>
