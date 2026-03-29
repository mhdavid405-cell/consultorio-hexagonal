<?php
session_start();
require_once __DIR__ . '/../config/config.php';

$usuarioCookie = isset($_COOKIE["usuario"]) ? $_COOKIE["usuario"] : "";
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultorio Medico - Login</title>
    <link rel="stylesheet" href="/public/css/estilo.css">
    <link rel="stylesheet" href="/public/vendor/lib/fontawesome-free_v5.15.4/css/all.min.css">
    <style>
        .help-icon-container {
            display: inline-block;
            position: relative;
            margin-left: 6px;
        }
        .help-icon {
            color: #4a90e2;
            font-size: 18px;
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
<div class="header">Consultorio Medico</div>
<h2>Iniciar sesion</h2>

<form action="login.php" method="POST">
    Usuario:
    <span class="help-icon-container">
        <i class="fas fa-question-circle help-icon"></i>
        <span class="help-tooltip">Recuerda: tu usuario es tu primer nombre y tu primer apellido</span>
    </span>
    <input type="text" name="usuario" value="<?php echo htmlspecialchars($usuarioCookie); ?>" required>
    Contrasena:
    <input type="password" name="password" required>
    <label><input type="checkbox" name="recordar"> Recordarme</label>
    <input type="submit" value="Entrar">
</form>
<p>
    Eres paciente nuevo? <a href="registro_paciente.php">Crear cuenta de paciente</a>
</p>
<p>
    <a href="nueva_clave.php">Olvidaste tu contrasena?</a>
</p>
</body>
</html>