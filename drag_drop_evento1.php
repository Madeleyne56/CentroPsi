<?php
date_default_timezone_set("America/Puebla");
setlocale(LC_ALL,"es_ES");

include('config1.php');
$idEvento         = $_POST['idEvento'];
$start            = $_REQUEST['start'];
$fecha_inicio     = date('Y-m-d H:i', strtotime($start)); // Incluye hora
$end              = $_REQUEST['end']; 
$fecha_fin        = date('Y-m-d H:i', strtotime($end)); // Incluye hora

// Actualización de los eventos con las nuevas fechas y horas
$UpdateProd = ("UPDATE eventoscalendar 
    SET 
        fecha_inicio = '$fecha_inicio',
        fecha_fin = '$fecha_fin'
    WHERE id = '$idEvento'");

$result = mysqli_query($con, $UpdateProd);


?>