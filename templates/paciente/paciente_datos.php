<?php
session_start();
if(!isset($_SESSION["usuario"]) || $_SESSION["rol"] != "paciente"){
    header("Location: index.php");
    exit;
}
include("conexion.php");

$id_usuario = $_SESSION["id_usuario"];
$sql = "SELECT * FROM pacientes WHERE id_usuario=$id_usuario";
$r = mysqli_query($conexion, $sql);
$pac = mysqli_fetch_assoc($r);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis datos</title>
    <link rel="stylesheet" href="estilo.css">
</head>
<body>
<div class="header">Mis datos</div>
<a href="menu_paciente.php">Volver</a><br><br>

<?php if($pac){ ?>
<table border="1" cellpadding="5">
<tr><th>Campo</th><th>Valor</th></tr>
<tr><td>Nombre</td><td><?php echo $pac["nombre"]; ?></td></tr>
<tr><td>Apellidos</td><td><?php echo $pac["apellidos"]; ?></td></tr>
<tr><td>Sexo</td><td><?php echo $pac["sexo"]; ?></td></tr>
<tr><td>Fecha de nacimiento</td><td><?php echo $pac["fecha_nacimiento"]; ?></td></tr>

</table>
<?php }else{ ?>
No se encontraron datos de paciente.
<?php } ?>

</body>
</html>
