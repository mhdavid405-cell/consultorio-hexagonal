<?php
// templates/citas/agregar.php
session_start();
if(!isset($_SESSION["usuario"])){ 
    header("Location: ../../index.php"); 
    exit; 
}

require_once __DIR__ . '/../../config/config.php';

$rp = mysqli_query($conexion, "SELECT id, CONCAT(nombre,' ',apellidos) AS nom FROM pacientes ORDER BY nom ASC");
$rs = mysqli_query($conexion, "SELECT id, nombre FROM servicios ORDER BY nombre ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agendar Cita</title>
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
        input[type="text"], input[type="date"], input[type="time"], select, textarea {
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
    </style>
</head>
<body>
<div class="header">Agendar Cita</div>
<a href="lista.php">← Volver a lista</a>
<br><br>

<form action="guardar.php" method="POST">
    Paciente:
    <select name="id_paciente" required>
        <option value="">-- Selecciona --</option>
        <?php while($p=mysqli_fetch_assoc($rp)){ echo "<option value='{$p['id']}'>{$p['nom']}</option>"; } ?>
    </select>

    Servicio:
    <select name="id_servicio" required>
        <option value="">-- Selecciona --</option>
        <?php while($s=mysqli_fetch_assoc($rs)){ echo "<option value='{$s['id']}'>{$s['nombre']}</option>"; } ?>
    </select>

    Médico:
    <select name="medico" required>
        <option value="">-- Selecciona --</option>
        <option value="Dr Juan Ramirez">Dr Juan Ramirez</option>
        <option value="Dr Saul Salcedo">Dr Saul Salcedo</option>
    </select>

    Fecha:
    <input type="date" name="fecha" required>

    Hora:
    <input type="time" name="hora" required>

    Notas:
    <textarea name="notas" rows="3"></textarea>

    <input type="submit" value="Guardar Cita">
</form>
</body>
</html>
