<?php
// templates/pacientes/actualizar.php
session_start();
if(!isset($_SESSION["usuario"])){ 
    header("Location: ../index.php"); 
    exit; 
}

require_once __DIR__ . '/../../config/config.php';

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

// Verificar si la consulta fue exitosa
if (!$ok) {
    $error = mysqli_error($conexion);
} else {
    $error = "";
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Actualizando...</title>
    <link rel="stylesheet" href="/public/vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.css">
    <script src="/public/vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.js"></script>
</head>
<body>
<script>
<?php if($ok): ?>
Swal.fire({
    icon: "success",
    title: "Actualizado correctamente",
    text: "El registro se actualizó correctamente.",
    confirmButtonText: "Aceptar"
}).then(() => {
    window.location = "lista.php";
});
<?php else: ?>
Swal.fire({
    icon: "error",
    title: "Error al actualizar",
    text: "<?php echo addslashes($error ?: 'No se pudo guardar el registro.'); ?>",
    confirmButtonText: "Aceptar"
}).then(() => {
    window.location = "editar.php?id=<?php echo $id; ?>";
});
<?php endif; ?>
</script>
</body>
</html>
