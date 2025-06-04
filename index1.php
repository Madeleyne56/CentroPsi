<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Calendario:: </title>
  <link rel="stylesheet" type="text/css" href="css/fullcalendar.min.css">
  <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/icon?family=Material+Icons">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" type="text/css" href="css/bootstrap.min.css">
  <link rel="stylesheet" type="text/css" href="css/home.css">
</head>
<body>

<a href="Inicio2.HTML" style="position: absolute; top: 20px; left: 20px; font-size: 24px; text-decoration: none; color: #333;">
  <i class="fa fa-arrow-left"></i> Inicio
</a>

<?php
include('config1.php');
$SqlEventos   = ("SELECT * FROM eventoscalendar");
$resulEventos = mysqli_query($con, $SqlEventos);
?>

<?php
include('config1.php');

  $SqlEventos   = ("SELECT * FROM eventoscalendar");
  $resulEventos = mysqli_query($con, $SqlEventos);

?>
<div class="mt-5"></div>

<div class="container">
  <div class="row">
    <div class="col msjs">
      <?php
        include('msjs1.php');
      ?>
    </div>
  </div>

<div class="row">
  <div class="col-md-12 mb-3">
  <h3 class="text-center" id="title">CALENDARIO</h3>
  </div>
</div>
</div>

<div id="calendar"></div>

<?php  
  include('modalNuevoEvento.php');
  include('modalUpdateEvento1.php');
?>
 <!-- Botón para abrir modal nuevo evento -->
  <button 
    type="button" 
    class="btn btn-primary rounded-circle"
    style="position: fixed; bottom: 30px; right: 30px; width: 60px; height: 60px; font-size: 28px; box-shadow: 0 2px 6px rgba(0,0,0,0.3);"
    data-bs-toggle="modal" 
    data-bs-target="#exampleModal"
    title="Agregar Nuevo Evento"
  >
    <i class="fa fa-plus" aria-hidden="true"></i>
  </button>
<script src ="js/jquery-3.0.0.min.js"> </script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/moment.min.js"></script> 
<script type="text/javascript" src="js/fullcalendar.min.js"></script>
<script src='locales/es.js'></script>

<script type="text/javascript">
$(document).ready(function() {
  $("#calendar").fullCalendar({
    header: {
      left: "prev,next today",
      center: "title",
      right: "month,agendaWeek,agendaDay"
    },

    locale: 'es',
    defaultView: "month",
    navLinks: true, 
    editable: true,
    eventLimit: true, 
    selectable: true,
    selectHelper: false,

    // Nuevo Evento
    select: function(start, end){
        $("#exampleModal").modal();
        $("input[name=fecha_inicio]").val(start.format('DD-MM-YYYY'));
        
        var valorFechaFin = end.format("DD-MM-YYYY");
        var F_final = moment(valorFechaFin, "DD-MM-YYYY").subtract(1, 'days').format('DD-MM-YYYY'); // Le resto 1 dia
        $('input[name=fecha_fin]').val(F_final);  
    },

    events: [
      <?php
       while($dataEvento = mysqli_fetch_array($resulEventos)){ ?>
          {
          _id: '<?php echo $dataEvento['id']; ?>',
          title: '<?php echo $dataEvento['evento']; ?>',
          start: '<?php echo $dataEvento['fecha_inicio']; ?>',
          end: '<?php echo $dataEvento['fecha_fin']; ?>',
          color: '<?php echo $dataEvento['color_evento']; ?>',
          estado: '<?php echo $dataEvento['estado']; ?>',
          observaciones: '<?php echo $dataEvento['observaciones']; ?>',
          psicopedagogo: '<?php echo $dataEvento['psicopedagogo']; ?>',
          },
      <?php } ?>
    ],

    // Eliminar Evento
    eventRender: function(event, element) {
        element
          .find(".fc-content")
          .prepend("<span id='btnCerrar' class='closeon material-icons'>&#xe5cd;</span>");
        
        // Eliminar evento
        element.find(".closeon").on("click", function() {
            var pregunta = confirm("Deseas Borrar este Evento?");   
            if (pregunta) {
                $("#calendar").fullCalendar("removeEvents", event._id);

                $.ajax({
                    type: "POST",
                    url: 'deleteEvento1.php',
                    data: {id:event._id},
                    success: function(datos) {
                      $(".alert-danger").show();
                      setTimeout(function () {
                        $(".alert-danger").slideUp(500);
                      }, 3000); 
                    }
                });
            }
        });
    },

    // Moviendo Evento Drag - Drop
    eventDrop: function (event, delta) {
        var idEvento = event._id;
        var start = (event.start.format('DD-MM-YYYY'));
        var end = (event.end.format("DD-MM-YYYY"));

        $.ajax({
            url: 'drag_drop_evento1.php',
            data: 'start=' + start + '&end=' + end + '&idEvento=' + idEvento,
            type: "POST",
            success: function (response) {
            }
        });
    },

    // Modificar Evento del Calendario
  eventClick: function(event) {
    var idEvento = event._id;

    // Asignar valores al formulario del modal
    $('input[name=idEvento]').val(idEvento);
    $('input[name=evento]').val(event.title);
    $('input[name=fecha_inicio]').val(event.start.format('YYYY-MM-DDTHH:mm'));
    $('input[name=fecha_fin]').val(
        event.end ? event.end.format('YYYY-MM-DDTHH:mm') : ''
    );

    // Asignar nuevos campos
    $('textarea[name=observaciones]').val(event.observaciones || '');
    $('input[name=psicopedagogo]').val(event.psicopedagogo || '');
    $('select[name=estado]').val(event.estado || '');

    // Seleccionar el color
    $('input[name=color_evento][value="' + event.color + '"]').prop('checked', true);

    // Abrir el modal
    $("#modalUpdateEvento1").modal('show');
},


  });

  // Oculta mensajes de Notificación
  setTimeout(function () {
    $(".alert").slideUp(300);
  }, 3000); 

});
</script>

</body>
</html>
