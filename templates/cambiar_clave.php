<?php
// templates/cambiar_clave.php
session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
    exit;
}

include("config/config.php");

$tipo = "";
$mensaje = "";
$redirigir = false;

if($_SERVER["REQUEST_METHOD"] === "POST"){
    $usuario = $_SESSION["usuario"];
    $pass_actual = md5($_POST["actual"]);
    $pass_nueva  = md5($_POST["nueva"]);

    $q = "SELECT id FROM usuarios WHERE usuario='$usuario' AND password='$pass_actual' LIMIT 1";
    $r = mysqli_query($conexion, $q);

    if($r && mysqli_num_rows($r) == 1){
        $ok = mysqli_query($conexion, "UPDATE usuarios SET password='$pass_nueva' WHERE usuario='$usuario'");

        if($ok){
            $tipo = "success";
            $mensaje = "Se cambió la contraseña correctamente.";
            $redirigir = true;
        } else {
            $tipo = "error";
            $mensaje = "No se pudo actualizar la contraseña.";
        }
    } else {
        $tipo = "error";
        $mensaje = "La contraseña actual es incorrecta.";
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Cambiar Contraseña</title>
<link rel="stylesheet" href="/public/css/estilo.css">
<link rel="stylesheet" href="/public/vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.css">
<script src="/public/vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.js"></script>
</head>

<body>
<div class="header">Cambiar Contraseña</div>
<a href="menu.php" style="margin:15px; display:inline-block;">← Volver al Menú</a>
<br><br>

<form method="POST" style="width:400px; margin:auto;">
    Contraseña Actual:
    <input type="password" name="actual" required>

    Nueva Contraseña:
    <input type="password" name="nueva" required>

    <input type="submit" value="Actualizar Contraseña">
</form>

<?php if($mensaje != ""){ ?>
<script>
Swal.fire({
    icon: "<?php echo $tipo; ?>",
    title: "<?php echo ($tipo == "success") ? "Correcto" : "Atención"; ?>",
    text: "<?php echo $mensaje; ?>",
    confirmButtonText: "Aceptar"
}).then(() => {
    <?php if($redirigir){ ?>
    window.location = "menu.php";
    <?php } ?>
});
</script>
<?php } ?>

</body>
</html>
