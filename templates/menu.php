<?php
// templates/menu.php
require_once __DIR__ . '/../config/config.php';
session_start();

if(!isset($_SESSION["usuario"])){
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Menú Principal</title>
<link rel="stylesheet" href="/public/css/estilo.css">
<link rel="stylesheet" href="/public/vendor/lib/fontawesome-free_v5.15.4/css/all.min.css">
<style>
body{margin:0;font-family:Arial,Helvetica,sans-serif;background:#f4f7fb;}
.header{background:#4a90e2;padding:12px;color:#fff;text-align:center;font-size:22px;font-weight:bold;}
.layout{display:flex;margin-top:20px;min-height:calc(100vh - 60px);}
.side-menu{width:280px;padding:25px;background:#fff;margin-left:20px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,0.1);}
.title-section{font-size:24px;margin-bottom:20px;color:#333;font-weight:bold;display:flex;align-items:center;gap:10px;padding-bottom:15px;border-bottom:2px solid #4a90e2;}
.menu-btn{display:block;padding:15px 20px;margin-bottom:12px;font-size:16px;font-weight:bold;color:white;border-radius:8px;text-decoration:none;text-align:center;transition:all 0.3s ease;}
.menu-btn:hover{transform:translateX(5px);opacity:0.9;}
.petroleo{background:#006b75;}
.hielo{background:#6fc9ff;}
.content{flex:1;text-align:center;padding:30px;background:#fff;margin-right:20px;border-radius:10px;box-shadow:0 0 10px rgba(0,0,0,0.1);}
.bienvenida{font-size:36px;font-weight:bold;color:#008a9a;margin-bottom:20px;}
.content img{max-width:380px;width:100%;margin-bottom:20px;border-radius:10px;}
</style>
</head>
<body>
<div class="header">Consultorio Médico</div>
<div class="layout">
    <div class="side-menu">
        <div class="title-section">
            <i class="fas fa-bars"></i>
            Menú
        </div>
        <a href="pacientes/lista.php" class="menu-btn petroleo">
            <i class="fas fa-users"></i> Pacientes
        </a>
        <a href="citas/lista.php" class="menu-btn hielo">
            <i class="fas fa-calendar-alt"></i> Citas
        </a>
        <a href="cambiar_clave.php" class="menu-btn petroleo">
            <i class="fas fa-key"></i> Cambiar Contraseña
        </a>
        <a href="logout.php" class="menu-btn hielo">
            <i class="fas fa-sign-out-alt"></i> Cerrar Sesión
        </a>
    </div>
    <div class="content">
        <div class="bienvenida">
            <i class="fas fa-user-md"></i> Bienvenido, <?php echo htmlspecialchars($_SESSION["usuario"]); ?>
        </div>
        <img src="/public/images/calendario.jpg" alt="Calendario">
    </div>
</div>
</body>
</html>
