<?php
session_start();
if(!isset($_SESSION["usuario"])) { header("Location: index.php"); exit; }
if($_SESSION["rol"] != "paciente"){ header("Location: menu.php"); exit; }

include("conexion.php");

$id_usuario = $_SESSION["id_usuario"];

$sql_p = "SELECT id, nombre, apellidos FROM pacientes WHERE id_usuario = $id_usuario";
$r_p = mysqli_query($conexion, $sql_p);
$pac = mysqli_fetch_assoc($r_p);
$id_paciente = $pac["id"];

$serv = mysqli_query($conexion, "SELECT id, nombre FROM servicios ORDER BY nombre ASC");
?>
<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Agendar cita</title>
</head>
<body>
<h2>Agendar nueva cita</h2>

<form action="paciente_cita_guardar.php" method="POST">

<input type="hidden" name="id_paciente" value="<?= $id_paciente ?>">

Servicio:<br>
<select name="id_servicio" required>
<?php while($s = mysqli_fetch_assoc($serv)) { ?>
<option value="<?= $s['id'] ?>"><?= $s['nombre'] ?></option>
<?php } ?>
</select><br><br>

Fecha:<br>
<input type="date" name="fecha" required><br><br>

Hora:<br>
<input type="time" name="hora" required><br><br>

<input type="submit" value="Agendar">
</form>

<br>
<a href="paciente_citas.php">Volver</a>

</body>
</html>
