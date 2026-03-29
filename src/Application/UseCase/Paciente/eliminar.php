<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../index.php");
    exit;
}

include("../conexion.php");

if (!isset($_GET["id"])) {
    header("Location: lista.php");
    exit;
}

$id = intval($_GET["id"]);

$sql = "SELECT id_usuario FROM pacientes WHERE id = $id";
$r   = mysqli_query($conexion, $sql);

if (!$r || mysqli_num_rows($r) == 0) {
    header("Location: lista.php");
    exit;
}

$pac = mysqli_fetch_assoc($r);
$id_usuario = $pac["id_usuario"];

$ok1 = mysqli_query($conexion, "DELETE FROM pacientes WHERE id = $id");

$ok2 = true;
if (!empty($id_usuario)) {
    $ok2 = mysqli_query($conexion, "DELETE FROM usuarios WHERE id = $id_usuario");
}

$ok = ($ok1 && $ok2);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Eliminar Paciente</title>

    <link rel="stylesheet" href="../vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.css">
    <script src="../vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.js"></script>
</head>
<body>

<script>
<?php if($ok){ ?>
    Swal.fire({
        icon: "success",
        title: "Eliminado correctamente",
        text: "El paciente fue eliminado con éxito.",
        confirmButtonText: "Aceptar"
    }).then(() => {
        window.location = "lista.php";
    });
<?php } else { ?>
    Swal.fire({
        icon: "error",
        title: "Error",
        text: "No se pudo eliminar el paciente.",
        confirmButtonText: "Volver"
    }).then(() => {
        window.location = "lista.php";
    });
<?php } ?>
</script>

</body>
</html>
