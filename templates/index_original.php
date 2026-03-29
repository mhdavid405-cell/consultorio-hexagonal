<?php
$usuarioCookie = "";
if(isset($_COOKIE["usuario"])) $usuarioCookie = $_COOKIE["usuario"];
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Consultorio Médico - Login</title>

    <link rel="stylesheet" href="estilo.css">

        <link rel="stylesheet" href="vendor/lib/fontawesome-free_v5.15.4/css/all.min.css">

    <style>
        .help-icon-container {
            display:inline-block;
            position:relative;
            margin-left:6px;
        }

        .help-icon {
            color:#4a90e2;
            font-size:18px;
            cursor:pointer;
        }

        .help-icon:hover {
            color:#2c6bb2;
        }

        
        .help-tooltip {
            visibility:hidden;
            opacity:0;
            position:absolute;
            top:22px;
            left:0;
            background:#333;
            color:#fff;
            padding:6px 10px;
            border-radius:6px;
            font-size:12px;
            white-space:nowrap;
            transition:opacity 0.2s;
            z-index:20;
        }

        .help-icon-container:hover .help-tooltip {
            visibility:visible;
            opacity:1;
        }
    </style>

</head>
<body>

<div class="header">Consultorio Médico</div>
<h2>Iniciar sesión</h2>

<form action="login.php" method="POST">

    Usuario:

    <span class="help-icon-container">
        <i class="fas fa-question-circle help-icon"></i>
        <span class="help-tooltip">Recuerda: tu usuario es tu  priemr nombre y tu primer apellido</span>
    </span>

    <input type="text" name="usuario" value="<?php echo $usuarioCookie; ?>" required>

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



