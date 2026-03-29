<?php
// login.php - Procesa el login
require_once __DIR__ . '/../config/database.php';
require_once __DIR__ . '/../config/paths.php';

session_start();

if ($_SERVER["REQUEST_METHOD"] !== "POST") {
    header("Location: " . BASE_URL);
    exit;
}

$usuario  = $_POST["usuario"] ?? "";
$pass_md5 = md5($_POST["password"] ?? "");
$recordar = isset($_POST["recordar"]);

$sql = "SELECT id, usuario, rol FROM usuarios WHERE usuario='$usuario' AND password='$pass_md5' LIMIT 1";
$r = mysqli_query($conexion, $sql);

if (mysqli_num_rows($r) == 1) {
    $f = mysqli_fetch_assoc($r);
    $_SESSION["usuario"] = $f["usuario"];
    $_SESSION["id_usuario"] = $f["id"];
    $_SESSION["rol"] = $f["rol"];

    if ($recordar) {
        setcookie("usuario", $f["usuario"], time() + (60*60*24*30), "/");
    } else {
        setcookie("usuario", "", time() - 3600, "/");
    }

    $redirect = ($_SESSION["rol"] == "paciente") ? BASE_URL . "menu_paciente" : BASE_URL . "menu";
    header("Location: $redirect");
    exit;
} else {
    ?>
    <!DOCTYPE html>
    <html lang="es">
    <head>
        <meta charset="UTF-8">
        <title>Login</title>
        <link rel="stylesheet" href="<?php echo VENDOR_PATH; ?>lib/sweetalert2_v11.11.1/sweetalert2.min.css">
        <script src="<?php echo VENDOR_PATH; ?>lib/sweetalert2_v11.11.1/sweetalert2.min.js"></script>
    </head>
    <body>
    <script>
        Swal.fire({
            icon: "error",
            title: "Datos incorrectos",
            text: "El usuario o contraseña no coinciden",
            confirmButtonText: "Intentar de nuevo"
        }).then(() => {
            window.location = "<?php echo BASE_URL; ?>";
        });
    </script>
    </body>
    </html>
    <?php
}
