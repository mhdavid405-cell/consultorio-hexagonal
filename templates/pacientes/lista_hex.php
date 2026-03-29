<?php
// Esta es una versión TEMPORAL para probar la migración
// El archivo original NO se modifica

session_start();
if(!isset($_SESSION["usuario"])){
    header("Location: ../index.php");
    exit;
}

// Verificar si hay datos del repositorio hexagonal
if (isset($_SESSION['pacientes_hex'])) {
    $pacientes = $_SESSION['pacientes_hex'];
    $usandoHexagonal = true;
} else {
    // Si no, usar la consulta original
    include("../conexion.php");
    $sql = "SELECT * FROM pacientes ORDER BY id DESC";
    $r = mysqli_query($conexion, $sql);
    $usandoHexagonal = false;
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="UTF-8">
<title>Pacientes - Versión Hexagonal</title>
<link rel="stylesheet" href="../estilo.css">
</head>
<body>
<div class="header">Pacientes <?php echo $usandoHexagonal ? '✅ Usando Hexagonal' : ''; ?></div>
<a href="../menu.php"> Menú</a> | <a href="agregar.php"> Agregar Paciente</a>

<form method="GET" style="width:90%;margin:15px auto;background:#fff;padding:12px;border-radius:8px">
    Buscar: <input type="text" name="q">
    <input type="submit" value="Buscar">
</form>

<table border="1">
    <tr>
        <th>ID</th>
        <th>Nombre</th>
        <th>Sexo</th>
        <th>Edad</th>
        <th>Peso</th>
        <th>Altura</th>
        <th>Acciones</th>
    </tr>
    
<?php if ($usandoHexagonal): ?>
    <?php foreach($pacientes as $p): ?>
    <tr>
        <td><?php echo $p->id; ?></td>
        <td><?php echo $p->getNombreCompleto(); ?></td>
        <td><?php echo $p->sexo; ?></td>
        <td><?php echo $p->edad; ?></td>
        <td><?php echo $p->peso; ?></td>
        <td><?php echo $p->altura; ?></td>
        <td>
            <a href="editar.php?id=<?php echo $p->id; ?>">Editar</a> |
            <a href="eliminar.php?id=<?php echo $p->id; ?>">Eliminar</a>
        </td>
    </tr>
    <?php endforeach; ?>
<?php else: ?>
    <?php while($f = mysqli_fetch_assoc($r)){ ?>
    <tr>
        <td><?php echo $f["id"]; ?></td>
        <td><?php echo $f["nombre"]." ".$f["apellidos"]; ?></td>
        <td><?php echo $f["sexo"]; ?></td>
        <td><?php echo $f["edad"]; ?></td>
        <td><?php echo $f["peso"]; ?></td>
        <td><?php echo $f["altura"]; ?></td>
        <td>
            <a href="editar.php?id=<?php echo $f["id"]; ?>">Editar</a> |
            <a href="eliminar.php?id=<?php echo $f["id"]; ?>">Eliminar</a>
        </td>
    </tr>
    <?php } ?>
<?php endif; ?>
</table>

</body>
</html>
