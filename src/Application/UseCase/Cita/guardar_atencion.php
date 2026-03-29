<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../index.php");
    exit;
}

include("../conexion.php");

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: lista.php");
    exit;
}

if (!isset($_POST["id_cita"])) {
    die("Falta el ID de la cita");
}

$id_cita = intval($_POST["id_cita"]);
$signos  = mysqli_real_escape_string($conexion, $_POST["signos"] ?? "");
$diag    = mysqli_real_escape_string($conexion, $_POST["diagnostico"] ?? "");
$trat    = mysqli_real_escape_string($conexion, $_POST["tratamiento"] ?? "");

$sql = "INSERT INTO atenciones (id_cita, signos, diagnostico, tratamiento)
        VALUES ($id_cita, '$signos', '$diag', '$trat')";

$ok1 = mysqli_query($conexion, $sql);

$ok2 = mysqli_query($conexion, "UPDATE citas SET estado='Atendida' WHERE id=$id_cita");

$ok = ($ok1 && $ok2);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Atendiendo cita...</title>

    <link rel="stylesheet" href="../vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.css">
    <script src="../vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.js"></script>
</head>
<body>

<script>
const ok = <?php echo $ok ? "true" : "false"; ?>;

if (typeof Swal !== "undefined") {
    Swal.fire({
        icon: ok ? "success" : "error",
        title: ok ? "Se atendió correctamente" : "Error",
        text: ok
            ? "La atención médica se guardó correctamente."
            : "No se pudo guardar la atención.",
        confirmButtonText: "Aceptar"
    }).then(() => {
        window.location = "lista.php";
    });
} else {
    alert(ok
        ? "La atención se guardó correctamente."
        : "No se pudo guardar la atención."
    );
    window.location = "lista.php";
}
</script>

</body>
</html>
