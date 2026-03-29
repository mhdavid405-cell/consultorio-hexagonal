<?php
// templates/paciente_citas.php
session_start();
if(!isset($_SESSION["usuario"]) || $_SESSION["rol"] != "paciente"){
    header("Location: index.php");
    exit;
}

require_once __DIR__ . '/../config/config.php';

$id_usuario = $_SESSION["id_usuario"];
$sql = "SELECT id FROM pacientes WHERE id_usuario=$id_usuario";
$r = mysqli_query($conexion, $sql);
$pac = mysqli_fetch_assoc($r);

if(!$pac){
    echo "<p style='text-align:center; color:#e74c3c;'>No se encontró paciente ligado a este usuario.</p>";
    exit;
}
$id_paciente = $pac["id"];

$sql = "SELECT c.*, s.nombre AS servicio
        FROM citas c
        JOIN servicios s ON s.id=c.id_servicio
        WHERE c.id_paciente=$id_paciente
        ORDER BY c.fecha DESC, c.hora DESC";
$citas = mysqli_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Mis citas</title>
    <link rel="stylesheet" href="/public/css/estilo.css">
    <link rel="stylesheet" href="/public/vendor/lib/fontawesome-free_v5.15.4/css/all.min.css">
    <style>
        .container {
            max-width: 1000px;
            margin: 20px auto;
            background: #fff;
            padding: 20px;
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
        table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        th, td {
            padding: 12px;
            text-align: center;
            border-bottom: 1px solid #ddd;
        }
        th {
            background: #4a90e2;
            color: white;
        }
        tr:hover {
            background: #f5f5f5;
        }
        a {
            text-decoration: none;
            color: #4a90e2;
        }
        a:hover {
            color: #2c6bb2;
        }
        .btn-nueva {
            display: inline-block;
            background: #4a90e2;
            color: white;
            padding: 10px 20px;
            border-radius: 6px;
            margin: 15px 0;
        }
        .btn-nueva:hover {
            background: #2c6bb2;
            color: white;
        }
        .badge {
            padding: 4px 8px;
            border-radius: 6px;
            font-size: 12px;
            font-weight: bold;
        }
        .badge-agendada { background: #f39c12; color: white; }
        .badge-atendida { background: #2ecc71; color: white; }
        .badge-cancelada { background: #e74c3c; color: white; }
        .volver {
            display: inline-block;
            margin: 15px;
        }
        .empty-message {
            text-align: center;
            color: #888;
            padding: 40px;
        }
    </style>
</head>
<body>
<div class="header">Mis citas</div>
<a href="menu_paciente.php" class="volver">← Volver al menú</a>
<a href="paciente_cita_nueva.php" class="btn-nueva">➕ Agendar nueva cita</a>

<div class="container">
    <?php if(mysqli_num_rows($citas) > 0): ?>
    <table>
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Hora</th>
                <th>Médico</th>
                <th>Servicio</th>
                <th>Estado</th>
            </tr>
        </thead>
        <tbody>
            <?php while($f = mysqli_fetch_assoc($citas)): ?>
            <tr>
                <td><?php echo $f["fecha"]; ?></td>
                <td><?php echo $f["hora"]; ?></td>
                <td><?php echo htmlspecialchars($f["medico"]); ?></td>
                <td><?php echo htmlspecialchars($f["servicio"]); ?></td>
                <td>
                    <?php 
                    $estado = $f["estado"];
                    $clase = '';
                    if($estado == 'Agendada') $clase = 'badge-agendada';
                    elseif($estado == 'Atendida') $clase = 'badge-atendida';
                    elseif($estado == 'Cancelada') $clase = 'badge-cancelada';
                    ?>
                    <span class="badge <?php echo $clase; ?>"><?php echo $estado; ?></span>
                </td>
            </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
    <?php else: ?>
        <div class="empty-message">
            <i class="fas fa-calendar-alt fa-3x" style="color: #ccc;"></i>
            <p>No tienes citas agendadas.</p>
            <a href="paciente_cita_nueva.php" class="btn-nueva">Agendar tu primera cita</a>
        </div>
    <?php endif; ?>
</div>

</body>
</html>
