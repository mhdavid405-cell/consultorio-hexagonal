<?php
session_start();
include("conexion.php");

$nombre      = trim($_POST["nombre"]);
$apellidos   = trim($_POST["apellidos"]);
$usuario     = trim($nombre . " " . $apellidos);
$pass        = $_POST["password"];

$sexo        = $_POST["sexo"];
$fecha_nac   = $_POST["fecha_nacimiento"];

$ok = false;
$msg = "";

$q = "SELECT id FROM usuarios WHERE usuario='$usuario'";
$r = mysqli_query($conexion, $q);

if ($r && mysqli_num_rows($r) > 0) {
    $ok = false;
    $msg = "Ya existe un usuario con ese nombre. Intenta otro.";
} else {

    $pass_md5 = md5($pass);

    $sql_u = "INSERT INTO usuarios (usuario, password, rol)
              VALUES ('$usuario', '$pass_md5', 'paciente')";
    $ok1 = mysqli_query($conexion, $sql_u);

    if(!$ok1){
        $ok = false;
        $msg = "Error al crear usuario.";
    } else {

        $id_usuario = mysqli_insert_id($conexion);

        $sql_p = "INSERT INTO pacientes (
                    nombre, apellidos, sexo, fecha_nacimiento, id_usuario
                  ) VALUES (
                    '$nombre', '$apellidos', '$sexo', " .
                    ($fecha_nac != "" ? "'$fecha_nac'" : "NULL") . ",
                    $id_usuario
                  )";

        $ok2 = mysqli_query($conexion, $sql_p);

        if(!$ok2){
            $ok = false;
            $msg = "Error al crear paciente.";
        } else {
            $ok = true;
            $msg = "Tu cuenta se creó correctamente.";

            $_SESSION["usuario"] = $usuario;
            $_SESSION["id_usuario"] = $id_usuario;
            $_SESSION["rol"] = "paciente";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Registro</title>

    <link rel="stylesheet" href="vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.css">
    <script src="vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.js"></script>
</head>
<body>

<script>
const ok = <?php echo $ok ? "true" : "false"; ?>;
const msg = <?php echo json_encode($msg); ?>;

if (typeof Swal !== "undefined") {
    Swal.fire({
        icon: ok ? "success" : "error",
        title: ok ? "Se creó correctamente" : "Error",
        text: msg,
        confirmButtonText: "Aceptar"
    }).then(() => {
        window.location = ok ? "menu_paciente.php" : "registro_paciente.php";
    });
} else {
    alert(msg);
    window.location = ok ? "menu_paciente.php" : "registro_paciente.php";
}
</script>

</body>
</html>
