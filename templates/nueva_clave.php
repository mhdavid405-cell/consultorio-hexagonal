<?php
// templates/nueva_clave.php
include("config/config.php");

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

            mysqli_query($conexion, "UPDATE usuarios SET password='$nueva' WHERE usuario='$usuario'");

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
<title>Restablecer contraseña</title>
<link rel="stylesheet" href="/public/css/estilo.css">
<link rel="stylesheet" href="/public/vendor/lib/fontawesome-free_v5.15.4/css/all.min.css">
<link rel="stylesheet" href="/public/vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.css">
<script src="/public/vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.js"></script>
<style>
    form {
        width: 400px;
        margin: 30px auto;
        background: #fff;
        padding: 25px;
        border-radius: 10px;
        box-shadow: 0 0 14px rgba(0,0,0,.12);
    }
    input[type="text"], input[type="password"] {
        width: 95%;
        padding: 10px;
        margin-top: 5px;
        margin-bottom: 14px;
        border-radius: 6px;
        border: 1px solid #bbb;
        font-size: 15px;
    }
    input[type="submit"] {
        width: 100%;
        background: #4a90e2;
        color: #fff;
        border: none;
        padding: 12px;
        border-radius: 6px;
        cursor: pointer;
        font-size: 16px;
        font-weight: bold;
    }
    input[type="submit"]:hover {
        background: #2c6bb2;
    }
    .header {
        background: #4a90e2;
        padding: 12px;
        color: #fff;
        text-align: center;
        font-size: 22px;
        font-weight: bold;
    }
    a {
        text-decoration: none;
        color: #4a90e2;
        margin: 15px;
        display: inline-block;
    }
    a:hover {
        color: #2c6bb2;
    }
    h2 {
        text-align: center;
        color: #333;
        margin-top: 20px;
    }
    .help-icon-container {
        display: inline-block;
        position: relative;
        margin-left: 6px;
    }
    .help-icon {
        color: #4a90e2;
        font-size: 16px;
        cursor: pointer;
    }
    .help-icon:hover {
        color: #2c6bb2;
    }
    .help-tooltip {
        visibility: hidden;
        opacity: 0;
        position: absolute;
        top: 22px;
        left: 0;
        background: #333;
        color: #fff;
        padding: 6px 10px;
        border-radius: 6px;
        font-size: 12px;
        white-space: nowrap;
        transition: opacity 0.2s;
        z-index: 20;
    }
    .help-icon-container:hover .help-tooltip {
        visibility: visible;
        opacity: 1;
    }
</style>
</head>
<body>
<div class="header">Restablecer contraseña</div>
<a href="index.php">← Volver al login</a>
<br><br>

<form method="POST">
    Usuario:
    <span class="help-icon-container">
        <i class="fas fa-question-circle help-icon"></i>
        <span class="help-tooltip">Ingresa tu nombre de usuario</span>
    </span>
    <input type="text" name="usuario" required>

    Nueva contraseña:
    <span class="help-icon-container">
        <i class="fas fa-question-circle help-icon"></i>
        <span class="help-tooltip">Ingresa tu nueva contraseña</span>
    </span>
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
