<?php
session_start();
if(!isset($_SESSION["usuario"])) { header("Location: index.php"); exit; }
if($_SESSION["rol"] != "paciente"){ header("Location: menu.php"); exit; }

include("conexion.php");

$id_paciente = $_POST["id_paciente"];
$id_servicio = $_POST["id_servicio"];
$fecha = $_POST["fecha"];
$hora = $_POST["hora"];

$sql = "INSERT INTO citas (id_paciente, id_servicio, medico, fecha, hora, estado)
        VALUES ($id_paciente, $id_servicio, 'Medico de guardia', '$fecha', '$hora', 'Agendada')";

mysqli_query($conexion, $sql);

header("Location: paciente_citas.php");
exit;
?>
