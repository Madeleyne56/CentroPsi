<?php
date_default_timezone_set("America/Puebla");
setlocale(LC_ALL,"es_ES");

require("config1.php");
$evento            = ucwords($_REQUEST['evento']);
$f_inicio          = $_REQUEST['fecha_inicio'];
$fecha_inicio      = date('Y-m-d H:i', strtotime($f_inicio));  // Incluye hora

$f_fin             = $_REQUEST['fecha_fin']; 
$seteando_f_final  = date('Y-m-d H:i', strtotime($f_fin)); // Incluye hora
$color_evento      = $_REQUEST['color_evento'];
$observaciones     = $_REQUEST['observaciones'];
$psicopedagogo     = $_REQUEST['psicopedagogo'];
$estado            = $_REQUEST['estado'];  // El nuevo campo de estado

// Insertar nuevo evento con todos los datos
$InsertNuevoEvento = "INSERT INTO eventoscalendar (
    evento, 
    fecha_inicio, 
    fecha_fin, 
    color_evento, 
    observaciones, 
    psicopedagogo, 
    estado
) VALUES (
    '" . $evento . "',
    '" . $fecha_inicio . "',
    '" . $fecha_fin . "',
    '" . $color_evento . "',
    '" . $observaciones . "',
    '" . $psicopedagogo . "',
    '" . $estado . "'
)";

$resultadoNuevoEvento = mysqli_query($con, $InsertNuevoEvento);

header("Location:index1.php?e=1");
?>
