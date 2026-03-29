<?php
// templates/paciente_datos.php
session_start();
if(!isset($_SESSION["usuario"]) || $_SESSION["rol"] != "paciente"){
    header("Location: index.php");
    exit;
}

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
    <title>Mis datos</title>
    <link rel="stylesheet" href="/public/css/estilo.css">
    <link rel="stylesheet" href="/public/vendor/lib/fontawesome-free_v5.15.4/css/all.min.css">
    <style>
        .container {
            max-width: 600px;
            margin: 30px auto;
            background: #fff;
            padding: 25px;
            border-radius: 10px;
            box-shadow: 0 0 14px rgba(0,0,0,.12);
        }
        .header {
            background: #4a90e2;
            padding: 12px;
            color: #fff;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
        }
        .data-table {
            width: 100%;
            border-collapse: collapse;
        }
        .data-table th, .data-table td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        .data-table th {
            background: #f5f5f5;
            color: #333;
            width: 40%;
        }
        .data-table td {
            color: #555;
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
        .btn-volver {
            display: inline-block;
            margin: 20px 0;
        }
    </style>
</head>
<body>
<div class="header">Mis datos</div>
<a href="menu_paciente.php" class="btn-volver">← Volver al menú</a>
<br><br>

<div class="container">
    <?php if($pac){ ?>
    <table class="data-table">
        <tr>
            <th>Nombre</th>
            <td><?php echo htmlspecialchars($pac["nombre"]); ?></td>
        </tr>
        <tr>
            <th>Apellidos</th>
            <td><?php echo htmlspecialchars($pac["apellidos"]); ?></td>
        </tr>
        <tr>
            <th>Sexo</th>
            <td><?php echo $pac["sexo"] == 'F' ? 'Femenino' : 'Masculino'; ?></td>
        </tr>
        <tr>
            <th>Fecha de nacimiento</th>
            <td><?php echo $pac["fecha_nacimiento"] ?: 'No registrada'; ?></td>
        </tr>
        <tr>
            <th>Edad</th>
            <td><?php echo $pac["edad"] ?: 'No registrada'; ?></td>
        </tr>
        <tr>
            <th>Peso (kg)</th>
            <td><?php echo $pac["peso"] ?: 'No registrado'; ?></td>
        </tr>
        <tr>
            <th>Altura (cm)</th>
            <td><?php echo $pac["altura"] ?: 'No registrada'; ?></td>
        </tr>
        <tr>
            <th>Alergias</th>
            <td><?php echo htmlspecialchars($pac["alergias"]) ?: 'Ninguna'; ?></td>
        </tr>
        <tr>
            <th>Padecimientos</th>
            <td><?php echo htmlspecialchars($pac["padecimientos"]) ?: 'Ninguno'; ?></td>
        </tr>
    </table>
    <?php }else{ ?>
        <p style="text-align:center; color:#e74c3c;">No se encontraron datos de paciente.</p>
    <?php } ?>
</div>

</body>
</html>
