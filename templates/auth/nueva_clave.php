<?php
include("conexion.php");

$tipo = "";
$mensaje = "";

if($_SERVER["REQUEST_METHOD"] === "POST"){

    $usuario = trim($_POST["usuario"]);
    $nueva   = md5($_POST["nueva"]);

    if($usuario === "" || $nueva === ""){
        $tipo = "error";
        $mensaje = "Todos los campos son obligatorios.";
    } else {

        $q = "SELECT id FROM usuarios WHERE usuario='$usuario' LIMIT 1";
        $r = mysqli_query($conexion, $q);

        if(mysqli_num_rows($r) == 1){

            mysqli_query(
                $conexion,
                "UPDATE usuarios SET password='$nueva' WHERE usuario='$usuario'"
            );

            $tipo = "success";
            $mensaje = "La contraseña se actualizó correctamente.";

        } else {
            $tipo = "error";
            $mensaje = "El usuario no existe.";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Nueva contraseña</title>

<link rel="stylesheet" href="estilo.css">

<link rel="stylesheet" href="vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.css">
<script src="vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.js"></script>
</head>

<body>

<div class="header">Restablecer contraseña</div>

<a href="index.php">Volver al login</a><br><br>

<form method="POST">

    Usuario:
    <input type="text" name="usuario" required>

    Nueva contraseña:
    <input type="password" name="nueva" required>

    <input type="submit" value="Guardar nueva contraseña">

</form>

<?php if($mensaje != ""){ ?>
<script>
Swal.fire({
    icon: "<?php echo $tipo; ?>",
    title: "<?php echo $tipo == 'success' ? 'Correcto' : 'Error'; ?>",
    text: "<?php echo $mensaje; ?>"
}).then(() => {
    <?php if($tipo == "success"){ ?>
        window.location = "index.php";
    <?php } ?>
});
</script>
<?php } ?>

</body>
</html>
