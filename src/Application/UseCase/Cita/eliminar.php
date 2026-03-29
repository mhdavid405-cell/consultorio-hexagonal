<?php
session_start();
if(!isset($_SESSION["usuario"])){ 
    header("Location: ../index.php"); 
    exit; 
}
include("../conexion.php");

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

    <link rel="stylesheet" href="../vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.css">
    <script src="../vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.js"></script>
</head>
<body>

<script>
const ok = <?php echo $ok ? "true" : "false"; ?>;

if (typeof Swal !== "undefined") {
    Swal.fire({
        icon: ok ? "success" : "error",
        title: ok ? "Se eliminó correctamente" : "Error",
        text: ok
            ? "La cita fue eliminada correctamente."
            : "No se pudo eliminar la cita.",
        confirmButtonText: "Aceptar"
    }).then(() => {
        window.location = "lista.php";
    });
} else {
    alert(ok
        ? "La cita fue eliminada correctamente."
        : "No se pudo eliminar la cita."
    );
    window.location = "lista.php";
}
</script>

</body>
</html>
