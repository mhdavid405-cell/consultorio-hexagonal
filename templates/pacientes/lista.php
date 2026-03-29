<?php
// templates/pacientes/lista.php
require_once __DIR__ . '/../../config/config.php';
session_start();

if(!isset($_SESSION["usuario"])){
    header("Location: ../../index.php");
    exit;
}

$result = mysqli_query($conexion, "SELECT * FROM pacientes ORDER BY id DESC");
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Lista de Pacientes</title>
    <link rel="stylesheet" href="/public/css/estilo.css">
    <link rel="stylesheet" href="/public/vendor/lib/fontawesome-free_v5.15.4/css/all.min.css">
    <style>
        .action-icon {
            font-size: 18px;
            padding: 5px;
            cursor: pointer;
            transition: 0.3s;
            margin: 0 5px;
        }
        .icon-edit { color: #3498db; }
        .icon-edit:hover { color: #217dbb; transform: scale(1.2); }
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
    </style>
</head>
<body>
<div class="header">Lista de Pacientes</div>
<a href="../menu.php" style="margin:15px; display:inline-block;">← Volver al Menú</a>
<a href="agregar.php" style="margin:15px;">➕ Agregar Paciente</a>
<br><br>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Apellidos</th>
        <th>Sexo</th>
        <th>Edad</th>
        <th>Acciones</th>
    </tr>
    <?php while($row = mysqli_fetch_assoc($result)): ?>
    <tr>
        <td><?php echo $row['id']; ?></td>
        <td><?php echo htmlspecialchars($row['nombre']); ?></td>
        <td><?php echo htmlspecialchars($row['apellidos']); ?></td>
        <td><?php echo $row['sexo']; ?></td>
        <td><?php echo $row['edad']; ?></td>
        <td>
            <a href="editar.php?id=<?php echo $row['id']; ?>" title="Editar">
                <i class="fas fa-edit action-icon icon-edit"></i>
            </a>
            <a href="eliminar.php?id=<?php echo $row['id']; ?>" title="Eliminar" onclick="return confirm('¿Eliminar paciente?');">
                <i class="fas fa-trash-alt action-icon icon-delete"></i>
            </a>
        </td>
    </tr>
    <?php endwhile; ?>
</table>
</body>
</html>
