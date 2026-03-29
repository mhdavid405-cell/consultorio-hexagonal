<?php
// templates/citas/eliminar.php
session_start();
if(!isset($_SESSION["usuario"])){ 
    header("Location: ../index.php"); 
    exit; 
}

require_once __DIR__ . '/../../config/config.php';

if(!isset($_GET["id"])){
    header("Location: lista.php");
    exit;
}

$id = intval($_GET["id"]);
$ok = mysqli_query($conexion, "DELETE FROM citas WHERE id=$id");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminando...</title>
    <link rel="stylesheet" href="/public/vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.css">
    <script src="/public/vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.js"></script>
</head>
<body>
<script>
Swal.fire({
    icon: <?php echo $ok ? "'success'" : "'error'"; ?>,
    title: <?php echo $ok ? "'Se eliminó correctamente'" : "'Error'"; ?>,
    text: <?php echo $ok ? "'La cita fue eliminada correctamente.'" : "'No se pudo eliminar la cita.'"; ?>,
    confirmButtonText: "Aceptar"
}).then(() => {
    window.location = "lista.php";
});
</script>
</body>
</html>
