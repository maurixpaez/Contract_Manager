<?php
include('conexion.php'); //Conexion a Base de Datos
include('seguridad.php'); // Seguridad de Pagina
include('querys/global_query.php'); // Script querys globales

$hoy = date("Y-m-d");

// Consulta Postgres listado archivos
$id_tienda = $list_ctto['n_tienda'];
$SQL="SELECT * FROM archivos order by id_archivo asc";
$result_archivos = pg_query ($conexion, $SQL) or die("Error en la consulta SQL");
$list_archivos = pg_fetch_array($result_archivos, null,PGSQL_ASSOC);

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

<link rel="stylesheet" type="text/css" href="css/dataTables.bootstrap.css"> <!-- CSS dataTable Bootstrap -->

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
		<i class="fa fa-book" style="color:#1ab394; margin-right:8px;"></i> Biblioteca de Archivos
    <?php include "panel_usuario.php" ?>
		</div>
<!-- Fin Titulo -->

		<div id="contenedor-default">

			<div class="row">
				<div class="col-xs-6">
					<div id="box_sw">
			<div id="box_sw_content">
			
					<table id="lista" class="table table-striped table-bordered" style="margin-bottom: 0px;">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">N° Tienda</th>
			      <th scope="col">Ver Archivo</th>
			    </tr>
			  </thead>
			  <tbody>
			  	 <?php 
			  	 $i = 1;
			  	 do { ?>

			    <tr>
			      <th scope="row"><?php echo $i; ?></th>
			      <td><?php echo $list_archivos['n_contrato']; ?></td>
			      <td><i class="fa fa-file-pdf-o" style="color:#1ab394; margin-right:8px;"></i> <a href="archivos/<?php echo $list_archivos['archivo']; ?>" target="_blank"><?php echo $list_archivos['nombre_archivo']; ?></a></td>
			    
			     
			    </tr>
			   <?php 
			   	$i++;
				} while ($list_archivos = pg_fetch_array($result_archivos, null,PGSQL_ASSOC)); ?>
			  </tbody>
			</table>




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
<script src="js/jquery.js"></script>
<script src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

	<!-- datatable JS Script  -->
	<script type="text/javascript" language="javascript" src="datatables/jquery-1.11.1.min.js"></script>
	<script type="text/javascript" language="javascript" src="datatables/jquery.dataTables.min.js"></script>
	<script type="text/javascript" language="javascript" src="datatables/dataTables.bootstrap.js"></script>

	<!-- datatable JS Script  -->



    <!-- Menu Toggle Script - Para que menu lateral se oculte y aparezca -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>

    <!-- Script dataTable  -->
							<script type="text/javascript" language="javascript" class="init">
							$(document).ready(function() {
								$('#lista').dataTable({
									pageLength : 10,
									ordering: true
							} );
							} );
							</script>
<!-- ======================================================= -->
</body>
</html>
