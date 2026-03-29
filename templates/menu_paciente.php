<?php
// templates/menu_paciente.php
error_reporting(E_ALL);
ini_set('display_errors', 1);

session_start();
if(!isset($_SESSION["usuario"]) || $_SESSION["rol"] != "paciente"){
    header("Location: index.php");
    exit;
}

// Ruta correcta: subir un nivel a la raíz y luego a config
require_once __DIR__ . '/../config/config.php';

$id_usuario = $_SESSION["id_usuario"];
$sql = "SELECT * FROM pacientes WHERE id_usuario=$id_usuario";
$r = mysqli_query($conexion, $sql);
$pac = mysqli_fetch_assoc($r);
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Portal del Paciente</title>
<link rel="stylesheet" href="/public/css/estilo.css">
<link rel="stylesheet" href="/public/vendor/lib/fontawesome-free_v5.15.4/css/all.min.css">
<style>
    body {
        margin: 0;
        font-family: Arial, Helvetica, sans-serif;
        background: #f4f7fb;
    }
    .header {
        background: #4a90e2;
        padding: 12px;
        color: #fff;
        text-align: center;
        font-size: 22px;
        font-weight: bold;
    }
    .layout {
        display: flex;
        margin-top: 20px;
        min-height: calc(100vh - 60px);
    }
    .side-menu {
        width: 280px;
        padding: 25px;
        background: #fff;
        margin-left: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .title-section {
        font-size: 24px;
        margin-bottom: 20px;
        color: #333;
        font-weight: bold;
        display: flex;
        align-items: center;
        gap: 10px;
        padding-bottom: 15px;
        border-bottom: 2px solid #4a90e2;
    }
    .menu-btn {
        display: block;
        padding: 15px 20px;
        margin-bottom: 12px;
        font-size: 16px;
        font-weight: bold;
        color: white;
        border-radius: 8px;
        text-decoration: none;
        text-align: center;
        transition: all 0.3s ease;
    }
    .menu-btn:hover {
        transform: translateX(5px);
        opacity: 0.9;
    }
    .petroleo { background: #006b75; }
    .hielo { background: #6fc9ff; }
    .content {
        flex: 1;
        text-align: center;
        padding: 30px;
        background: #fff;
        margin-right: 20px;
        border-radius: 10px;
        box-shadow: 0 0 10px rgba(0,0,0,0.1);
    }
    .bienvenida {
        font-size: 32px;
        font-weight: bold;
        color: #008a9a;
        margin-bottom: 20px;
    }
    .content img {
        max-width: 380px;
        width: 100%;
        margin-bottom: 20px;
        border-radius: 10px;
    }
    .subtitulo {
        font-size: 22px;
        color: #4a90e2;
        margin-top: 20px;
    }
    .logout-btn {
        background: #e74c3c;
    }
    .logout-btn:hover {
        background: #c0392b;
    }
</style>
</head>
<body>
<div class="header">Consultorio Médico</div>

<div class="layout">
    <div class="side-menu">
        <div class="title-section">
            <i class="fas fa-bars"></i>
            Mi menú
        </div>
        <a href="paciente_datos.php" class="menu-btn petroleo">
            <i class="fas fa-user"></i> Mis datos
        </a>
        <a href="paciente_citas.php" class="menu-btn hielo">
            <i class="fas fa-calendar-alt"></i> Mis citas
        </a>
        <a href="logout.php" class="menu-btn logout-btn">
            <i class="fas fa-sign-out-alt"></i> Cerrar sesión
        </a>
    </div>

    <div class="content">
        <div class="bienvenida">
            <i class="fas fa-user-circle"></i> Bienvenido(a)
        </div>
        <div class="bienvenida" style="font-size: 28px; color: #4a90e2;">
            <?php echo $pac ? $pac["nombre"]." ".$pac["apellidos"] : $_SESSION["usuario"]; ?>
        </div>
        <img src="/public/images/paciente.jpg" alt="Paciente" />
        <div class="subtitulo">
            <i class="fas fa-stethoscope"></i> Tu información y tus citas
        </div>
    </div>
</div>
</body>
</html>
