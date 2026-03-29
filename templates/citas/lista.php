<?php
// templates/citas/lista.php
require_once __DIR__ . '/../../config/config.php';
session_start();

if(!isset($_SESSION["usuario"])){
    header("Location: ../../index.php");
    exit;
}

$sql = "SELECT c.*, p.nombre, p.apellidos, s.nombre AS servicio
        FROM citas c
        JOIN pacientes p ON p.id = c.id_paciente
        JOIN servicios s ON s.id = c.id_servicio
        ORDER BY c.fecha DESC, c.hora DESC";
$result = mysqli_query($conexion, $sql);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Citas</title>
    <link rel="stylesheet" href="/public/css/estilo.css">
    <link rel="stylesheet" href="/public/vendor/lib/fontawesome-free_v5.15.4/css/all.min.css">
    <style>
        .action-icon {
            font-size: 18px;
            padding: 5px;
            cursor: pointer;
            transition: 0.3s;
            margin: 0 3px;
            display: inline-block;
        }
        .icon-edit { color: #3498db; }
        .icon-edit:hover { color: #217dbb; transform: scale(1.2); }
        .icon-atender { color: #16a085; }
        .icon-atender:hover { color: #0e6b5e; transform: scale(1.2); }
        .icon-receta { color: #9b59b6; }
        .icon-receta:hover { color: #6d3f82; transform: scale(1.2); }
        .icon-delete { color: #e74c3c; }
        .icon-delete:hover { color: #c0392b; transform: scale(1.2); }
        table {
            width: 95%;
            margin: auto;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: center;
            vertical-align: middle;
        }
        th {
            background: #4a90e2;
            color: white;
        }
        .header {
            background: #4a90e2;
            padding: 12px;
            color: #fff;
            text-align: center;
            font-size: 22px;
            font-weight: bold;
        }
        a {
            text-decoration: none;
        }
        .btn-link {
            margin: 15px;
            display: inline-block;
            color: #4a90e2;
        }
        .btn-link:hover {
            color: #2c6bb2;
        }
    </style>
</head>
<body>
<div class="header">Lista de Citas</div>
<a href="../menu.php" class="btn-link">← Volver al Menú</a>
<a href="agregar.php" class="btn-link">➕ Agendar Cita</a>
<br><br>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Fecha</th>
        <th>Hora</th>
        <th>Paciente</th>
        <th>Servicio</th>
        <th>Médico</th>
        <th>Estado</th>
        <th>Acciones</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo $row['fecha']; ?></td>
        <td><?php echo $row['hora']; ?></td>
        <td><?php echo htmlspecialchars($row['nombre'] . ' ' . $row['apellidos']); ?></td>
        <td><?php echo $row['servicio']; ?></td>
        <td><?php echo $row['medico']; ?></td>
        <td><?php echo $row['estado']; ?></td>
        <td>
            <a href="editar.php?id=<?php echo $row['id']; ?>" title="Editar">
                <i class="fas fa-edit action-icon icon-edit"></i>
            </a>
            <a href="atender.php?id=<?php echo $row['id']; ?>" title="Atender">
                <i class="fas fa-user-md action-icon icon-atender"></i>
            </a>
            <a href="ticket.php?id=<?php echo $row['id']; ?>" title="Ticket/Receta" target="_blank">
                <i class="fas fa-prescription-bottle-alt action-icon icon-receta"></i>
            </a>
            <a href="eliminar.php?id=<?php echo $row['id']; ?>" title="Eliminar" onclick="return confirm('¿Eliminar cita?');">
                <i class="fas fa-trash-alt action-icon icon-delete"></i>
            </a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
