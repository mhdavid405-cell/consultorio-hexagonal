<?php
session_start();
if(!isset($_SESSION["usuario"])){ 
    header("Location: ../index.php"); 
    exit; 
}

include("../conexion.php");

$nombre      = trim($_POST["nombre"]);      
$pass        = $_POST["password"];          
$apellidos   = trim($_POST["apellidos"]);
$sexo        = $_POST["sexo"];
$fnac        = $_POST["fecha_nacimiento"];

$edad        = $_POST["edad"];
$peso        = $_POST["peso"];
$altura      = $_POST["altura"];

$alergias    = $_POST["alergias"];
$pade        = $_POST["padecimientos"];

$ok = false;
$msgError = "";

if($nombre === "" || $pass === ""){
    $msgError = "Faltan nombre o contraseña";
} else {

    $usuario = trim($nombre . " " . $apellidos);

    $q = "SELECT id FROM usuarios WHERE usuario='$usuario'";
    $r = mysqli_query($conexion, $q);

    if(!$r){
        $msgError = "Error al buscar usuario: " . mysqli_error($conexion);
    } elseif(mysqli_num_rows($r) > 0){
        $msgError = "Ya existe un usuario con ese nombre. Cambia el nombre del paciente.";
    } else {

        $pass_md5 = md5($pass);

        $sql_u = "INSERT INTO usuarios (usuario, password, rol)
                  VALUES ('$usuario', '$pass_md5', 'paciente')";

        if(!mysqli_query($conexion, $sql_u)){
            $msgError = "Error al insertar usuario: " . mysqli_error($conexion);
        } else {

            $id_usuario = mysqli_insert_id($conexion);

            $sql_p = "INSERT INTO pacientes (
                        nombre, apellidos, sexo, fecha_nacimiento,
                        alergias, padecimientos,
                        edad, peso, altura,
                        id_usuario
                      ) VALUES (
                        '$nombre',
                        '$apellidos',
                        '$sexo',
                        " . ($fnac != "" ? "'$fnac'" : "NULL") . ",
                        '$alergias',
                        '$pade',
                        " . ($edad !== "" ? "'$edad'" : "NULL") . ",
                        " . ($peso !== "" ? "'$peso'" : "NULL") . ",
                        " . ($altura !== "" ? "'$altura'" : "NULL") . ",
                        $id_usuario
                      )";

            if(!mysqli_query($conexion, $sql_p)){
                $msgError = "Error al insertar paciente: " . mysqli_error($conexion);
            } else {
                $ok = true;
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Guardando...</title>

    <link rel="stylesheet" href="../vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.css">
    <script src="../vendor/lib/sweetalert2_v11.11.1/sweetalert2.min.js"></script>
</head>
<body>

<script>
<?php if($ok){ ?>
    Swal.fire({
        icon: "success",
        title: "Guardado correctamente",
        text: "El paciente se registró con éxito.",
        confirmButtonText: "Aceptar"
    }).then(() => {
        window.location = "lista.php";
    });
<?php } else { ?>
    Swal.fire({
        icon: "error",
        title: "Error",
        text: "<?php echo addslashes($msgError); ?>",
        confirmButtonText: "Volver"
    }).then(() => {
        window.location = "agregar.php";
    });
<?php } ?>
</script>

</body>
</html>

