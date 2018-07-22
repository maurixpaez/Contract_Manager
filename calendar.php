<?php
include('conexion.php'); //Conexion a Base de Datos
include('seguridad.php'); // Seguridad de Pagina
include('querys/global_query.php'); // Script querys globales

$hoy = date("Y-m-d");

// Consulta Postgres listado contratos
$SQL="SELECT * FROM vw_fecha_vencientos";
$result = pg_query ($conexion, $SQL) or die("Error en la consulta SQL");
$list_ctto = pg_fetch_array($result, null,PGSQL_ASSOC);


// Consulta Postgres listado contratos
$SQL_g="SELECT * FROM vw_vencimientos_garantias";
$resultg = pg_query ($conexion, $SQL_g) or die("Error en la consulta SQL");
$list_garan = pg_fetch_array($resultg, null,PGSQL_ASSOC);


?>

<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>
<title>Taskin+ | Demo</title>

<!-- CSS Script -->
<link rel="stylesheet" type="text/css" href="css/estilos.css" />
<link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" href="css/font-awesome.css">

<link href='fullcalendar/fullcalendar.css' rel='stylesheet' />
<link href='fullcalendar/fullcalendar.print.css' rel='stylesheet' media='print' />

<style>
#calendar {
		max-width: 100%;
		margin: 0 auto;
	}
	</style>
<!-- CSS Script -->

<script src='fullcalendar/moment.min.js'></script>
<script src="js/jquery.min.js"></script>
<script src='fullcalendar/fullcalendar.min.js'></script>
<script src='fullcalendar/es.js'></script>
<script>

	$(document).ready(function() {


		$('#calendar').fullCalendar({
			header: {
				left: 'prev,next today',
				center: 'title',
				right: ''
			},
			defaultDate: '<?php echo $hoy; ?>',
			businessHours: true, // display business hours
			editable: true,  //$list_ctto
			events: [
				 <?php do { 

			 	$dates = strtotime($list_ctto['fecha_vencimiento']);
		        $anio = date("Y",$dates);
		        $month = date("m",$dates);
		        $day = date("d",$dates);
		        $mt = $month;

		        $start_date = $anio."-".$mt."-".$day;

			 	?>
				{
					title: 'Vencimiento Ctto.<?php echo $list_ctto['n_tienda']; ?>',
					start: '<?php echo $start_date; ?>',
					color: '#FF0000',
					url: 'contratos_detalle.php?idctto=<?php echo $list_ctto['id_contrato']; ?>',
				},
			<?php } while ($list_ctto = pg_fetch_array($result, null,PGSQL_ASSOC)); ?>

			 <?php do { 

			 	$dates = strtotime($list_garan['vencimiento_garantia']);
		        $anio = date("Y",$dates);
		        $month = date("m",$dates);
		        $day = date("d",$dates);
		        $mt = $month;

		        $start_date_g = $anio."-".$mt."-".$day;

			 	?>
				{
					title: 'Vence Garantia Ctto.<?php echo $list_garan['n_tienda']; ?>',
					start: '<?php echo $start_date_g; ?>',
					color: '#FF9900',
					url: 'contratos_detalle.php?idctto=<?php echo $list_garan['id_contrato']; ?>',
				},
			<?php } while ($list_garan = pg_fetch_array($resultg, null,PGSQL_ASSOC)); ?>
			]
		});

	});

</script>

</head>
<body>

<!-- Header nombre del sistema + fecha + cerrar sesion ============================ -->
<?php include "header.php" ?>

<div id="wrapper" class="toggled">

<!-- BARRA MENU IZQUIERDA ========================================================= -->
<?php include "menu.php" ?>

<div id="page-content-wrapper">
<div id="task-page-content-wrapper">

<!-- Titulo de la Pagina + Panel de Usuario Activo -->
		<div id="titulo-task-page-content-wrapper">
		<i class="fa fa-calendar" style="color:#1ab394; margin-right:8px;"></i> Calendario de Eventos
    <?php include "panel_usuario.php" ?>
		</div>
<!-- Fin Titulo -->

		<div id="contenedor-default">

			<div class="row">
				<div class="col-xs-6">
					<div id="box_sw">
			<div id="box_sw_content">
			<div id='calendar'></div>
						</div>
					</div>
				</div>

			</div>




		</div>

</div>

<div id="fondo"></div>
</div>
</div>

<!-- javascript
==================================================
Ubicar al final del documento para una carga mas rapida -->


<script src="bootstrap/js/bootstrap.min.js"></script>



    <!-- Menu Toggle Script - Para que menu lateral se oculte y aparezca -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
<!-- ======================================================= -->
</body>
</html>
