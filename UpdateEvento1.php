<?php
date_default_timezone_set("America/Mexico_city");
setlocale(LC_ALL, "es_ES");

include('config1.php');

// Validar que se recibieron todos los datos
if (isset($_POST['idEvento']) && isset($_POST['evento']) && isset($_POST['fecha_inicio']) 
    && isset($_POST['fecha_fin']) && isset($_POST['color_evento']) && isset($_POST['observaciones']) 
    && isset($_POST['psicopedagogo']) && isset($_POST['estado'])) {

    // Recibir datos
    $idEvento         = $_POST['idEvento'];
    $evento           = ucwords($_POST['evento']);
    $f_inicio         = $_POST['fecha_inicio'];
    $fecha_inicio     = date('Y-m-d H:i', strtotime($f_inicio));

    $f_fin            = $_POST['fecha_fin'];
    $fecha_fin        = date('Y-m-d H:i', strtotime($f_fin));

    $color_evento     = $_POST['color_evento'];
    $observaciones    = $_POST['observaciones'];
    $psicopedagogo    = $_POST['psicopedagogo'];
    $estado           = $_POST['estado'];

    // Actualizar en la base de datos
    $UpdateProd = ("UPDATE eventoscalendar 
        SET 
            evento = '$evento',
            fecha_inicio = '$fecha_inicio',
            fecha_fin = '$fecha_fin',
            color_evento = '$color_evento',
            observaciones = '$observaciones',
            psicopedagogo = '$psicopedagogo',
            estado = '$estado'
        WHERE id = '$idEvento'");

    $result = mysqli_query($con, $UpdateProd);

   if ($result) {
    // Respuesta exitosa
    echo json_encode(['status' => 'success', 'message' => 'Evento actualizado correctamente']);
    // Agregar este código para que el alert se muestre y luego redirija:
    echo "<script>
        alert('Evento actualizado correctamente');
        window.location.href = 'index1.php';
    </script>";
    exit;
} else {
    // Error en la consulta
    echo json_encode(['status' => 'error', 'message' => 'Error al actualizar el evento: ' . mysqli_error($con)]);
}
} else {
    // Respuesta de error si faltan datos
    echo json_encode(['status' => 'error', 'message' => 'Datos incompletos enviados']);
}
?>

