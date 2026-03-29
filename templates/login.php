<?php
// templates/login.php - Procesa el login
error_reporting(E_ALL);
ini_set('display_errors', 1);

require_once __DIR__ . '/../config/config.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: index.php");
    exit;
}

$usuario  = $_POST["usuario"] ?? "";
$pass_md5 = md5($_POST["password"] ?? "");
$recordar = isset($_POST["recordar"]);

$sql = "SELECT id, usuario, rol FROM usuarios WHERE usuario='$usuario' AND password='$pass_md5' LIMIT 1";
$r = mysqli_query($conexion, $sql);

if (mysqli_num_rows($r) == 1) {
    $f = mysqli_fetch_assoc($r);
    $_SESSION["usuario"]    = $f["usuario"];
    $_SESSION["id_usuario"] = $f["id"];
    $_SESSION["rol"]        = $f["rol"];

    if ($recordar) {
        setcookie("usuario", $f["usuario"], time() + (60*60*24*30), "/");
    } else {
        setcookie("usuario", "", time() - 3600, "/");
    }

    if ($_SESSION["rol"] == "paciente") {
        header("Location: menu_paciente.php");
    } else {
        header("Location: menu.php");
    }
    exit;
} else {
    // Mostrar error con SweetAlert
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Error de inicio de sesión</title>
        <link rel="stylesheet" href="/public/vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.css">
        <script src="/public/vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.js"></script>
        <link rel="stylesheet" href="/public/css/estilo.css">
    </head>
    <body>
    <div class="header">Consultorio Médico</div>
    <script>
        Swal.fire({
            icon: "error",
            title: "Error de inicio de sesión",
            text: "Usuario o contraseña incorrectos. Por favor, verifica tus datos.",
            confirmButtonText: "Intentar de nuevo"
        }).then(() => {
            window.location = "index.php";
        });
    </script>
    </body>
    </html>
    <?php
}
