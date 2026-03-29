<?php
session_start();
if (!isset($_SESSION["usuario"])) {
    header("Location: ../index.php");
    exit;
}

include("../conexion.php");

if (!isset($_GET["id"])) {
    echo "Falta el ID de la cita";
    exit;
}

$id = intval($_GET["id"]);

$sql = "SELECT 
            c.*, 
            p.nombre, 
            p.apellidos, 
            p.padecimientos,
            s.nombre AS serv,
            s.precio
        FROM citas c
        JOIN pacientes p ON p.id = c.id_paciente
        JOIN servicios s ON s.id = c.id_servicio
        WHERE c.id = $id";

$r = mysqli_query($conexion, $sql);
if (!$r || mysqli_num_rows($r) == 0) {
    echo "No se encontró la cita";
    exit;
}

$ci = mysqli_fetch_assoc($r);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Atender cita</title>
    <style>
        body{font-family: Arial, sans-serif; margin: 20px;}
        label{display:block; margin-top:10px;}
        input[type="text"], input[type="date"], input[type="time"], textarea{
            width: 100%;
            max-width: 700px;
        }
        .contenedor{
            max-width: 800px;
            margin:auto;
            border:1px solid #ccc;
            padding:20px;
            border-radius:8px;
        }
        .btn{
            padding:8px 16px;
            border:none;
            cursor:pointer;
            margin-top:15px;
            text-decoration:none;
            display:inline-block;
        }
        .btn-guardar{
            background:#2e7d32;
            color:#fff;
        }
        .btn-cancelar{
            background:#b71c1c;
            color:#fff;
            margin-left:10px;
        }
        .info{
            background:#f5f5f5;
            padding:10px;
            border-radius:6px;
            margin-bottom:15px;
        }
    </style>
</head>
<body>
<div class="contenedor">
    <h2>Atender cita</h2>

    <div class="info">
        <p><b>Paciente:</b> <?php echo htmlspecialchars($ci["nombre"]." ".$ci["apellidos"]); ?></p>
        <p><b>Padecimientos:</b> <?php echo htmlspecialchars($ci["padecimientos"]); ?></p>
        <p><b>Servicio:</b> <?php echo htmlspecialchars($ci["serv"]); ?> (<?php echo $ci["precio"]; ?>)</p>
        <p><b>Fecha:</b> <?php echo htmlspecialchars($ci["fecha"]); ?> |
           <b>Hora:</b> <?php echo htmlspecialchars($ci["hora"]); ?></p>
        <p><b>Médico:</b> <?php echo htmlspecialchars($ci["medico"]); ?></p>
        <p><b>Estado actual:</b> <?php echo htmlspecialchars($ci["estado"]); ?></p>
    </div>

    <form action="guardar_atencion.php" method="post">
        <input type="hidden" name="id_cita" value="<?php echo $ci['id']; ?>">

        <label><b>Signos / observaciones físicas:</b></label>
        <textarea name="signos" rows="4" placeholder="Ej. TA, FC, FR, temperatura, hallazgos clínicos..."></textarea>

        <label><b>Diagnóstico:</b></label>
        <textarea name="diagnostico" rows="4" placeholder="Ej. Faringitis aguda, lumbalgia, etc."></textarea>

        <label><b>Tratamiento:</b></label>
        <textarea name="tratamiento" rows="6" placeholder="Medicamentos, dosis, frecuencia, duración, indicaciones..."></textarea>

        <button type="submit" class="btn btn-guardar">Guardar y generar receta</button>
        <a href="lista.php" class="btn btn-cancelar">Cancelar</a>
    </form>
</div>
</body>
</html>
