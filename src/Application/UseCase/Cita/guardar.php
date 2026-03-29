<?php
session_start();
if(!isset($_SESSION["usuario"])){ 
    header("Location: ../index.php"); 
    exit; 
}
include("../conexion.php");

$pac = $_POST["id_paciente"];
$ser = $_POST["id_servicio"];
$med = $_POST["medico"];
$f   = $_POST["fecha"];
$h   = $_POST["hora"];
$n   = $_POST["notas"];

$sql = "INSERT INTO citas (id_paciente, id_servicio, medico, fecha, hora, estado, notas)
        VALUES ($pac, $ser, '$med', '$f', '$h', 'Agendada', '$n')";

$ok = mysqli_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Guardando cita...</title>

    <link rel="stylesheet" href="../vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.css">
    <script src="../vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.js"></script>
</head>
<body>

<script>
<?php if($ok){ ?>
    Swal.fire({
        icon: "success",
        title: "Cita guardada",
        text: "La cita se agendó correctamente.",
        confirmButtonText: "Aceptar"
    }).then(() => {
        window.location = "lista.php";
    });
<?php } else { ?>
    Swal.fire({
        icon: "error",
        title: "Error",
        text: "No se pudo guardar la cita.",
        confirmButtonText: "Volver"
    }).then(() => {
        window.location = "agregar.php";
    });
<?php } ?>
</script>

</body>
</html>
