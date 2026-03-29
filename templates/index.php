<?php
session_start();
require_once __DIR__ . '/../conexion.php';

$usuarioCookie = "";
if(isset($_COOKIE["usuario"])) $usuarioCookie = $_COOKIE["usuario"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultorio Médico - Login</title>
    <link rel="stylesheet" href="/public/css/estilo.css">
    <link rel="stylesheet" href="/public/vendor/lib/fontawesome-free_v5.15.4/css/all.min.css">
</head>
<body>
<div class="header">Consultorio Médico</div>
<h2>Iniciar sesión</h2>

<form action="login.php" method="POST">
    Usuario:
    <input type="text" name="usuario" value="<?php echo htmlspecialchars($usuarioCookie); ?>" required>
    Contraseña:
    <input type="password" name="password" required>
    <label><input type="checkbox" name="recordar"> Recordarme</label>
    <input type="submit" value="Entrar">
</form>
<p>
    ¿Eres paciente nuevo? <a href="registro_paciente.php">Crear cuenta de paciente</a>
</p>
<p>
    <a href="nueva_clave.php">¿Olvidaste tu contraseña?</a>
</p>
</body>
</html>
