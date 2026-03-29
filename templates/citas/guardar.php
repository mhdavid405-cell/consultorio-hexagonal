<?php
// templates/citas/guardar.php
session_start();
if(!isset($_SESSION["usuario"])){ 
    header("Location: ../index.php"); 
    exit; 
}

require_once __DIR__ . '/../../config/config.php';

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
    <link rel="stylesheet" href="/public/vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.css">
    <script src="/public/vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.js"></script>
</head>
<body>
<script>
Swal.fire({
    icon: <?php echo $ok ? "'success'" : "'error'"; ?>,
    title: <?php echo $ok ? "'Cita guardada'" : "'Error'"; ?>,
    text: <?php echo $ok ? "'La cita se agendó correctamente.'" : "'No se pudo guardar la cita.'"; ?>,
    confirmButtonText: "Aceptar"
}).then(() => {
    window.location = <?php echo $ok ? "'lista.php'" : "'agregar.php'"; ?>;
});
</script>
</body>
</html>
