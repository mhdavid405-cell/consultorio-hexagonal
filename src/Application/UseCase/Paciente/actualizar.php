<?php
session_start();
if(!isset($_SESSION["usuario"])){ 
    header("Location: ../index.php"); 
    exit; 
}

include("../conexion.php");

$id         = $_POST["id"];
$nombre     = $_POST["nombre"];
$apellidos  = $_POST["apellidos"];
$sexo       = $_POST["sexo"];
$fnac       = $_POST["fecha_nacimiento"];

$edad       = $_POST["edad"];
$peso       = $_POST["peso"];
$altura     = $_POST["altura"];

$alergias   = $_POST["alergias"];
$pade       = $_POST["padecimientos"];

$sql = "UPDATE pacientes SET
            nombre = '$nombre',
            apellidos = '$apellidos',
            sexo = '$sexo',
            fecha_nacimiento = '$fnac',
            edad = '$edad',
            peso = '$peso',
            altura = '$altura',
            alergias = '$alergias',
            padecimientos = '$pade'
        WHERE id = $id";

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
<?php if($ok){ ?>
    Swal.fire({
        icon: "success",
        title: "Actualizado correctamente",
        text: "El registro del paciente se guardó con éxito.",
        confirmButtonText: "Aceptar"
    }).then(() => {
        window.location = "lista.php";
    });
<?php } else { ?>
    Swal.fire({
        icon: "error",
        title: "Error al actualizar",
        text: "No se pudo guardar el registro.",
        confirmButtonText: "Volver"
    }).then(() => {
        window.location = "lista.php";
    });
<?php } ?>
</script>

</body>
</html>
