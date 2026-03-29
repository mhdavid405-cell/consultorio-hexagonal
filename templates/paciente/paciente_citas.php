<?php
session_start();
if(!isset($_SESSION["usuario"]) || $_SESSION["rol"] != "paciente"){
    header("Location: index.php");
    exit;
}
include("conexion.php");

$id_usuario = $_SESSION["id_usuario"];
$sql = "SELECT id FROM pacientes WHERE id_usuario=$id_usuario";
$r = mysqli_query($conexion, $sql);
$pac = mysqli_fetch_assoc($r);

if(!$pac){
    echo "No se encontró paciente ligado a este usuario.";
    exit;
}
$id_paciente = $pac["id"];

$sql = "SELECT c.*, s.nombre AS servicio
        FROM citas c
        JOIN servicios s ON s.id=c.id_servicio
        WHERE c.id_paciente=$id_paciente
        ORDER BY c.fecha DESC, c.hora DESC";
$citas = mysqli_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis citas</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="header">Mis citas</div>
<a href="menu_paciente.php">Volver</a><br><br>

<table border="1" cellpadding="5">
<tr>
    <th>Fecha</th>
    <th>Hora</th>
    <th>Médico</th>
    <th>Servicio</th>
    <th>Estado</th>
</tr>
<?php while($f = mysqli_fetch_assoc($citas)){ ?>
<tr>
    <td><?php echo $f["fecha"]; ?></td>
    <td><?php echo $f["hora"]; ?></td>
    <td><?php echo $f["medico"]; ?></td>
    <td><?php echo $f["servicio"]; ?></td>
    <td><?php echo $f["estado"]; ?></td>
</tr>
<?php } ?>
</table>

</body>
</html>

