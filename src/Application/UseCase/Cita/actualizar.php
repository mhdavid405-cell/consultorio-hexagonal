<?php
session_start();
if(!isset($_SESSION["usuario"])){ header("Location: ../index.php"); exit; }
include("../conexion.php");

if($_SERVER["REQUEST_METHOD"] !== "POST"){
    header("Location: lista.php");
    exit;
}

$id  = $_POST["id"];
$pac = $_POST["id_paciente"];
$ser = $_POST["id_servicio"];
$med = $_POST["medico"];
$f   = $_POST["fecha"];
$h   = $_POST["hora"];
$e   = $_POST["estado"];
$n   = $_POST["notas"];

$sql = "UPDATE citas SET 
            id_paciente=$pac, 
            id_servicio=$ser, 
            medico='$med', 
            fecha='$f', 
            hora='$h', 
            estado='$e', 
            notas='$n' 
        WHERE id=$id";

$ok = mysqli_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizando...</title>

    <link rel="stylesheet" href="../vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.css">
    <script src="../vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.js"></script>
</head>
<body>

<script>
const ok = <?php echo $ok ? "true" : "false"; ?>;

if (typeof Swal !== "undefined") {
    Swal.fire({
        icon: ok ? "success" : "error",
        title: ok ? "Actualizada correctamente" : "Error",
        text: ok ? "La cita se actualizó correctamente." : "No se pudo actualizar la cita.",
        confirmButtonText: "Aceptar"
    }).then(() => {
        window.location = "lista.php";
    });
} else {
    alert(ok ? "La cita se actualizó correctamente." : "No se pudo actualizar la cita.");
    window.location = "lista.php";
}
</script>

</body>
</html>
