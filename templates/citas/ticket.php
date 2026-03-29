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
            s.precio,
            a.signos,
            a.diagnostico,
            a.tratamiento
        FROM citas c
        JOIN pacientes p ON p.id = c.id_paciente
        JOIN servicios s ON s.id = c.id_servicio
        LEFT JOIN atenciones a ON a.id_cita = c.id
        WHERE c.id = $id
        ORDER BY a.id DESC
        LIMIT 1";

$r = mysqli_query($conexion, $sql);
if (!$r || mysqli_num_rows($r) == 0) {
    echo "No se encontró la cita o la receta";
    exit;
}

$ci = mysqli_fetch_assoc($r);
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Receta Médica</title>

    <link rel="stylesheet" href="../estilo.css">

    <style>
        body{font-family:Arial, sans-serif;margin:20px;background:#fff;}
        .ticket{
            width:480px;
            margin:auto;
            border:1px solid #333;
            padding:20px;
            border-radius:8px;
            background:#fff;
        }
        h3{text-align:center;margin-top:0;margin-bottom:5px;}
        hr{border:none;border-top:1px solid #333;margin:10px 0;}
        .campo{
            margin-bottom:8px;
            font-size:14px;
        }
        .etiqueta{
            font-weight:bold;
        }
        textarea{
            width:100%;
            border:1px solid #999;
            border-radius:4px;
            padding:5px;
            font-family:inherit;
            font-size:14px;
            resize:none;
            background:#fff;
        }
        .pie{
            margin-top:20px;
            text-align:center;
            font-size:13px;
        }
        .encabezado-consultorio{
            text-align:center;
            font-size:12px;
            margin-bottom:5px;
        }

        @media print{
            body{margin:0;background:#fff;}
            .ticket{border:1px solid #333;}
        }
    </style>
</head>
<body onload="window.print()">

<div class="ticket">
    <h3>Consultorio Médico</h3>

    <div class="encabezado-consultorio">
        Dr(a). ___________________________<br>
        Cédula: __________________________<br>
        Dirección: _______________________<br>
        Tel: _____________________________
    </div>

    <hr>

    <div class="campo">
        <span class="etiqueta">Fecha:</span>
        <?php echo htmlspecialchars($ci["fecha"]); ?>
    </div>

    <div class="campo">
        <span class="etiqueta">Paciente:</span>
        <?php echo htmlspecialchars($ci["nombre"]." ".$ci["apellidos"]); ?>
    </div>

    <div class="campo">
        <span class="etiqueta">Padecimientos conocidos:</span>
        <?php echo htmlspecialchars($ci["padecimientos"]); ?>
    </div>

    <div class="campo">
        <span class="etiqueta">Motivo de la consulta / Servicio:</span>
        <?php echo htmlspecialchars($ci["serv"]); ?>
    </div>

    <div class="campo">
        <span class="etiqueta">Signos y observaciones:</span><br>
        <textarea rows="3" readonly><?php echo isset($ci["signos"]) ? htmlspecialchars($ci["signos"]) : ""; ?></textarea>
    </div>

    <div class="campo">
        <span class="etiqueta">Diagnóstico:</span><br>
        <textarea rows="4" readonly><?php echo isset($ci["diagnostico"]) ? htmlspecialchars($ci["diagnostico"]) : ""; ?></textarea>
    </div>

    <div class="campo">
        <span class="etiqueta">Tratamiento:</span><br>
        <textarea rows="6" readonly><?php echo isset($ci["tratamiento"]) ? htmlspecialchars($ci["tratamiento"]) : ""; ?></textarea>
    </div>

    <div class="pie">
        ___________________________<br>
        Firma y sello del médico
    </div>
</div>

</body>
</html>
