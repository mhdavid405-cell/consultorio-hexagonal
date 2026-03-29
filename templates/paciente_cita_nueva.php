<?php
// templates/paciente_cita_nueva.php
session_start();
if(!isset($_SESSION["usuario"])) { 
    header("Location: index.php"); 
    exit; 
}
if($_SESSION["rol"] != "paciente"){ 
    header("Location: menu.php"); 
    exit; 
}

require_once __DIR__ . '/../config/config.php';

$id_usuario = $_SESSION["id_usuario"];
$sql_p = "SELECT id, nombre, apellidos FROM pacientes WHERE id_usuario = $id_usuario";
$r_p = mysqli_query($conexion, $sql_p);
$pac = mysqli_fetch_assoc($r_p);
$id_paciente = $pac["id"];

$serv = mysqli_query($conexion, "SELECT id, nombre FROM servicios ORDER BY nombre ASC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Agendar cita</title>
    <link rel="stylesheet" href="/public/css/estilo.css">
    <link rel="stylesheet" href="/public/vendor/lib/fontawesome-free_v5.15.4/css/all.min.css">
    <style>
        .container {
            max-width: 500px;
            margin: 30px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 14px rgba(0,0,0,.12);
        }
        .header {
            background: #4a90e2;
            padding: 12px;
            color: #fff;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
        }
        h2 {
            text-align: center;
            color: #333;
            margin-top: 0;
        }
        label {
            display: block;
            margin-top: 15px;
            margin-bottom: 5px;
            font-weight: bold;
            color: #555;
        }
        select, input[type="date"], input[type="time"] {
            width: 100%;
            padding: 10px;
            margin-bottom: 10px;
            border-radius: 6px;
            border: 1px solid #bbb;
            font-size: 15px;
            box-sizing: border-box;
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
            margin-top: 20px;
        }
        input[type="submit"]:hover {
            background: #2c6bb2;
        }
        a {
            text-decoration: none;
            color: #4a90e2;
            display: inline-block;
            margin-top: 15px;
        }
        a:hover {
            color: #2c6bb2;
        }
        .btn-volver {
            display: inline-block;
            margin: 15px;
        }
        .info-paciente {
            background: #f0f8ff;
            padding: 10px;
            border-radius: 6px;
            margin-bottom: 20px;
            text-align: center;
            color: #4a90e2;
        }
    </style>
</head>
<body>
<div class="header">Agendar nueva cita</div>
<a href="paciente_citas.php" class="btn-volver">← Volver a mis citas</a>

<div class="container">
    <h2><i class="fas fa-calendar-plus"></i> Agendar nueva cita</h2>
    
    <div class="info-paciente">
        <i class="fas fa-user"></i> Paciente: <?php echo htmlspecialchars($pac["nombre"] . " " . $pac["apellidos"]); ?>
    </div>

    <form action="paciente_cita_guardar.php" method="POST">
        <input type="hidden" name="id_paciente" value="<?= $id_paciente ?>">

        <label>Servicio:</label>
        <select name="id_servicio" required>
            <option value="">-- Selecciona un servicio --</option>
            <?php while($s = mysqli_fetch_assoc($serv)) { ?>
                <option value="<?= $s['id'] ?>"><?= htmlspecialchars($s['nombre']) ?></option>
            <?php } ?>
        </select>

        <label>Fecha:</label>
        <input type="date" name="fecha" required>

        <label>Hora:</label>
        <input type="time" name="hora" required>

        <input type="submit" value="Agendar cita">
    </form>
</div>

</body>
</html>
