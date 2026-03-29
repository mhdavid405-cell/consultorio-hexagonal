<?php
// templates/citas/editar.php
session_start();
if(!isset($_SESSION["usuario"])){ 
    header("Location: ../../index.php"); 
    exit; 
}

require_once __DIR__ . '/../../config/config.php';

$id = $_GET["id"];
$c = mysqli_query($conexion, "SELECT * FROM citas WHERE id=$id");
$ci = mysqli_fetch_assoc($c);

$rp = mysqli_query($conexion, "SELECT id, CONCAT(nombre,' ',apellidos) AS nom FROM pacientes ORDER BY nom ASC");
$rs = mysqli_query($conexion, "SELECT id, nombre FROM servicios ORDER BY nombre ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Editar Cita</title>
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
<div class="header">Editar Cita</div>
<a href="lista.php">← Volver a lista</a>
<br><br>

<form action="actualizar.php" method="POST">
    <input type="hidden" name="id" value="<?php echo $ci['id']; ?>">

    Paciente:
    <select name="id_paciente" required>
        <?php while($p = mysqli_fetch_assoc($rp)){ 
            $sel = ($p['id'] == $ci['id_paciente']) ? 'selected' : '';
            echo "<option value='{$p['id']}' $sel>{$p['nom']}</option>";
        } ?>
    </select>

    Servicio:
    <select name="id_servicio" required>
        <?php while($s = mysqli_fetch_assoc($rs)){ 
            $sel = ($s['id'] == $ci['id_servicio']) ? 'selected' : '';
            echo "<option value='{$s['id']}' $sel>{$s['nombre']}</option>";
        } ?>
    </select>

    Médico:
    <select name="medico" required>
        <option value="Dr Juan Ramirez" <?php if($ci['medico'] == 'Dr Juan Ramirez') echo 'selected'; ?>>Dr Juan Ramirez</option>
        <option value="Dr Saul Salcedo" <?php if($ci['medico'] == 'Dr Saul Salcedo') echo 'selected'; ?>>Dr Saul Salcedo</option>
    </select>

    Fecha:
    <input type="date" name="fecha" value="<?php echo $ci['fecha']; ?>" required>

    Hora:
    <input type="time" name="hora" value="<?php echo $ci['hora']; ?>" required>

    Estado:
    <select name="estado">
        <option <?php if($ci['estado'] == 'Agendada') echo 'selected'; ?>>Agendada</option>
        <option <?php if($ci['estado'] == 'Atendida') echo 'selected'; ?>>Atendida</option>
        <option <?php if($ci['estado'] == 'Cancelada') echo 'selected'; ?>>Cancelada</option>
    </select>

    Notas:
    <textarea name="notas" rows="3"><?php echo $ci['notas']; ?></textarea>

    <input type="submit" value="Actualizar Cita">
</form>
</body>
</html>
