<?php
include('conexion.php'); //Conexion a Base de Datos
include('seguridad.php'); // Seguridad de Pagina
include('querys/global_query.php'); // Script querys globales

// Consulta Postgres listado contratos
$SQL="SELECT * FROM ctto_contratos";
$result = pg_query ($conexion, $SQL) or die("Error en la consulta SQL");
$list_ctto = pg_fetch_array($result, null,PGSQL_ASSOC);
$registros= pg_num_rows($result);

// Consulta Postgres listado archivos
$id_tienda = $list_ctto['n_tienda'];
$SQL="SELECT * FROM archivos order by id_archivo asc";
$result_archivos = pg_query ($conexion, $SQL) or die("Error en la consulta SQL");
$list_archivos = pg_fetch_array($result_archivos, null,PGSQL_ASSOC);
$reg_archivos = pg_num_rows($result_archivos);

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
<!-- CSS Script -->

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
			<img src="images/logo-skechers_small.png"> / Contratos
    <?php include "panel_usuario.php" ?>
		</div>
<!-- Fin Titulo -->

<div id="contenedor-default">
	<h4>Dashboard Información y Estadísticas</h4>

	<div class="col-xs-6">
			<div id="box_sw_full" >

			<div class="row-fluid show-grid">
              <div class="span6">
              
								
									<div>
                                    <h1 class="font-extra-bold m-t-xl m-b-xs">
                                        <i class="fa fa-shopping-cart" style="color:#62cb31; margin:8px;"></i> <?php echo $registros; ?> Tiendas
                                    </h1>
                                    <small>Registradas al sistema</small>
                                </div>
							

								

              </div>
              <div class="span6">
             
									<div>
                                    <h1 class="font-extra-bold m-t-xl m-b-xs">
                                        <i class="fa fa-file-pdf-o" style="color:#62cb31; margin:8px;"></i> <?php echo $reg_archivos; ?> Archivos
                                    </h1>
                                    <small>Cargados al sistema</small>
                                </div>

												
								

              </div>
            </div>


			</div>
	</div>







		</div>

<div id="contenedor-default">
		<div class="col-xs-6">
				<div id="box_sw_full" >
						<div id="contenedor-titulo">
							<i class="fa fa-list" style="color:#62cb31; margin:8px;"></i> Listado de Tiendas
							<div id="box_derecha"> <a class="btn btn-danger btn-xs" href="contratos_registro.php" role="button"><i class="fa fa-plus" aria-hidden="true"></i> Crear Tienda</a></div>
						</div>
						<div class="container">
						<div class="row">

						  <div class="col-xs-6">
								<table id="lista" class="table table-striped table-bordered" style="margin-bottom: 0px;">
								<thead>
									<tr style="background-color: #fff;">
										<th width="8%" style="text-align:left;">Contrato Tienda</th>
										<th width="8%" style="text-align:left;">Status</th>
										<th width="40%" style="text-align:left;">Operador/Ubicacion</th>
										<th width="10%" style="text-align:left;">Fecha Vencimiento</th>
										<th width="10%" style="text-align:left;">Renta Mensual</th>

										<th width="4%" style="text-align:left;">Detalles</th>
									</tr>
								</thead>
								<tbody>

									<?php do { ?>
									<tr>
											<td><?php echo $list_ctto['n_tienda']; ?></td>
										<td>
											<?php
											$status = $list_ctto['status'];
											switch ($status) {
											    case "1":
											       echo '<span class="label label-danger"><i class="fa fa-exclamation-triangle" aria-hidden="true"></i> Vencido</span>';
											        break;
											    case "2":
											        echo '<span class="label label-success"><i class="fa fa-check" aria-hidden="true"></i> Vigente</span>';
											        break;
											}
											?>												
										</td>

										<td><?php echo $list_ctto['operador']; ?> / <?php echo $list_ctto['ubicacion']; ?></td>
										<td><?php echo date("Y-m-d",strtotime($list_ctto['fecha_vencimiento'])); ?></td>
										<td><?php echo $list_ctto['renta_mensual']; ?> U.F.</td>
									<!--	<td><span class="label label-info">Elaboración</span></td> -->
										<td style="text-align:center;"><a class="btn btn-warning btn-xs" href="contratos_detalle.php?idctto=<?php echo $list_ctto['id_contrato']; ?>" role="button"><i class="fa fa-folder-open" aria-hidden="true"></i> View</a></td>
									</tr>
  								<?php } while ($list_ctto = pg_fetch_array($result, null,PGSQL_ASSOC)); ?>


								</tbody>
								</table>


							</div>
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
