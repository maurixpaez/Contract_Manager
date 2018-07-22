<?php
include('conexion.php'); //Conexion a Base de Datos
include('seguridad.php'); // Seguridad de Pagina
include('querys/global_query.php'); // Script querys globales

$idpost= $_GET['idctto'];
$checkok = $_GET['confirma'];



$SQL="SELECT * FROM ctto_contratos WHERE id_contrato = $idpost";
$result = pg_query ($conexion, $SQL) or die("Error en la consulta SQL");
$list_ctto = pg_fetch_array($result, null,PGSQL_ASSOC);

$SQL_view="SELECT * FROM ctto_contratos_view WHERE id_contrato = $idpost";
$result_view = pg_query ($conexion, $SQL_view) or die("Error en la consulta SQL");
$list_ctto_view = pg_fetch_array($result_view, null,PGSQL_ASSOC);

$SQL_porc_view="SELECT porcentaje FROM ctto_porcentaje_trancurrido_view WHERE id_contrato = $idpost";
$porc_view = pg_query ($conexion, $SQL_porc_view) or die("Error en la consulta porcentaje SQL");
$resul_porc_view = pg_fetch_array($porc_view, null,PGSQL_ASSOC);

// Consulta Postgres listado archivos
$id_tienda = $list_ctto['n_tienda'];
$SQL="SELECT * FROM archivos where n_contrato = $id_tienda order by id_archivo asc";
$result_archivos = pg_query ($conexion, $SQL) or die("Error en la consulta SQL");
$list_archivos = pg_fetch_array($result_archivos, null,PGSQL_ASSOC);

// Consulta Postgres contrato archivo
$id_tienda = $list_ctto['n_tienda'];
$SQL="SELECT * FROM archivos where n_contrato = $id_tienda and tipo_contrato = 1";
$result_ctto_tipo = pg_query ($conexion, $SQL) or die("Error en la consulta SQL");
$ctto_archivo = pg_fetch_array($result_ctto_tipo, null,PGSQL_ASSOC);
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
<!-- CSS Script -->

<!-- Para vertical timeline -->
<link rel="stylesheet" href="vertical_timeline/css/style.css"> <!-- Resource style -->
<script src="vertical_timeline/js/modernizr.js"></script> <!-- Modernizr -->

<script src="js/sweetalert2.all.js"></script>

<!-- Include a polyfill for ES6 Promises (optional) for IE11 and Android browser -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/core-js/2.4.1/core.js"></script>

</head>
<body>

<?php	if ($checkok == 1) {  ?>
<script type="text/javascript">
swal({
  title: 'Archivo cargado con exito!!',
  text: 'Desea Continuar...',
  type: 'success',
  confirmButtonText: 'Aceptar'
})
</script>
<?php } ?>

<?php	if ($checkok == 2) {  ?>
<script type="text/javascript">
swal({
  title: 'Archivo Eliminado!!',
  text: 'Presione Aceptar para continuar...',
  type: 'success',
  confirmButtonText: 'Aceptar'
})
</script>
<?php } ?>

<!-- Header nombre del sistema + fecha + cerrar sesion ============================ -->
<?php include "header.php" ?>

<div id="wrapper" class="toggled">

<!-- BARRA MENU IZQUIERDA ========================================================= -->
<?php include "menu.php" ?>

<div id="page-content-wrapper">
<div id="task-page-content-wrapper">

<!-- Titulo de la Pagina + Panel de Usuario Activo -->
		<div id="titulo-task-page-content-wrapper">
			<img src="images/logo-skechers_small.png"> /<a href="contratos.php"> Contratos</a> / Detalle
    <?php include "panel_usuario.php" ?>
		</div>
<!-- Fin Titulo -->

<div id="contenedor-default">
	<h4>Detalle Información Contrato</h4>

	<div class="col-xs-6">
			<div id="box_sw_full" >

<!-- Titulo Contrato -->
				<div id="contenedor-titulo">
					<i class="fa fa-file-text" style="color:#62cb31; margin:8px;"></i> N° <?php echo $list_ctto['id_contrato']; ?> - <?php echo $list_ctto['operador']; ?> / <?php echo $list_ctto['ubicacion']; ?>
					<div id="box_derecha" style="margin-right: 6px;">
						<a class="btn btn-success btn-xs" href="#" role="button"><i class="fa fa-pencil" aria-hidden="true"></i> Update/Edit</a>
						<a class="btn btn-success btn-xs" href="#" role="button"><i class="fa fa-commenting-o" aria-hidden="true"></i> Comentar</a>
					</div>
				</div>

<!-- Detalle del contrato -->
<div class="container">

			<div class="row">

			<div class="col-xs-12 col-md-8" style="padding: 0px 20px 0px 10px; margin-bottom: 0px;">

								<table class="table table-bordered table-striped table-condensed">
									<tbody>
										<tr> <th scope="row" width="30%">Fecha Contrato :</th> <td><?php echo date("d-m-Y", strtotime($list_ctto['fecha_contrato'])); ?></td></tr>
										<tr> <th scope="row" width="30%">Fecha Pago Renta :</th> <td><?php echo date("d-m-Y", strtotime($list_ctto['fecha_pagorenta'])); ?></td></tr>
										<tr> <th scope="row" width="30%">Plazo Contractual :</th> <td><?php echo $list_ctto_view['plazo_contrato_meses']; ?> Meses</td></tr>
										<tr> <th scope="row" width="30%">Fecha Vencimiento :</th> <td><?php echo date("d-m-Y", strtotime($list_ctto['fecha_vencimiento'])); ?></td></tr>
										<tr> <th scope="row" width="30%">Mts2 :</th> <td><?php echo $list_ctto['mt2']; ?> Mt2</td></tr>
										<tr> <th scope="row" width="30%">U.F. x Mt2 :</th> <td><?php echo $list_ctto_view['uf_mt2']; ?> U.F.  /  <strong>Valor U.F al <?php echo date("d-m-Y", strtotime($list_ctto['fecha_contrato'])); ?> :  <?php echo $list_ctto['valor_uf']; ?></strong></td></tr>
										<tr> <th scope="row" width="30%">% Reajuste :</th> <td><?php echo $list_ctto['porc_reajuste']; ?> % <a class="btn btn-default btn-xs" role="button" data-toggle="modal" data-target="#myModal" style="float:right; margin-right: 5px;"><i class="fa fa-signal" aria-hidden="true"></i> Incremento</a></td></tr>
										<tr> <th scope="row" width="30%">Garantía U.F. :</th> <td><?php echo $list_ctto['garantia']; ?> U.F.</td></tr>
										<tr> <th scope="row" width="30%">Vencimiento Garantía :</th> <td><?php echo date("d-m-Y", strtotime($list_ctto['vencimiento_garantia'])); ?></td></tr>
										<tr> <th scope="row" width="30%">Gasto Común :</th> <td><?php echo $list_ctto['gasto_comun']; ?> U.F.</td></tr>
										<tr> <th scope="row" width="30%">Fondo Promoción :</th> <td><?php echo $list_ctto['fondo_promo']; ?> U.F.</td></tr>
										<tr> <th scope="row" width="30%">Gastos Administrativos :</th> <td><?php echo $list_ctto['gastos_admin']; ?> U.F.</td></tr>
										<tr> <th scope="row" width="30%">Valor Diciembre :</th> <td><?php echo $list_ctto['valor_diciembre']; ?> Arriendos</td></tr>
									</tbody>
								</table>

							</div>

			<div class="col-xs-6 col-md-4" style="margin-bottom: 0px;">

								<div class="box_purpura_new">
										<div class="pad-all">
												<p class="text-lg text-semibold" style="font-size: 25px; margin: 0px;"><i class="fa fa-shopping-cart" aria-hidden="true" style="margin-right:8px;"></i> N° Tienda : <?php echo $list_ctto['n_tienda']; ?></p>
												<br>
												<table class="table table-bordered table-condensed" style="margin-bottom: 0px;">
													<tbody>

														<tr> <td scope="row" width="55%">Local (es) :</td> <td><?php echo $list_ctto['n_local']; ?></td></tr>
														<tr> <td scope="row" width="55%">Valor Mínimo Mensual :</td> <td><?php echo $list_ctto['renta_mensual']; ?> U.F.</td></tr>
														<tr> <td scope="row" width="55%">Valor Variable Mensual :</td> <td><?php echo $list_ctto['valor_porc_mens']; ?> %</td></tr>
													</tbody>
												</table>
<br>
												<table class="table table-bordered table-condensed" style="margin-bottom: 0px;">
													<tbody>
														<tr> <td scope="row" width="55%">Status :</td> <td><?php echo $list_ctto_view['status_ctto']; ?></td></tr>
													</tbody>
												</table>

										</div>

								</div>

								<div class="box_verde_new" style="margin-top: 10px;">
										<div class="pad-all">
												<p class="text-lg text-semibold"><i class="fa fa-calendar" aria-hidden="true" style="margin-right:8px;"></i> Quedan <?php echo $list_ctto_view['dias_vence']; ?> dias Vencimiento</p>
												<div class="progress" style="margin-bottom: 2px;">
													<div class="progress-bar progress-bar-info progress-bar-striped" role="progressbar" aria-valuenow="<?php echo $resul_porc_view['porcentaje']; ?>" aria-valuemin="0" aria-valuemax="100" style="width:<?php echo $resul_porc_view['porcentaje']; ?>%; text-align: left; padding-left: 5px;">
														<?php echo $resul_porc_view['porcentaje']; ?> %
													</div>
												</div>
										</div>
								</div>

								<div class="box_rojizo_new" style="margin-top: 10px;">
										<div class="pad-all">
												<p class="text-lg text-semibold" style="font-size: 20px; margin: 0px;"><i class="fa fa-file-pdf-o" aria-hidden="true" style="margin-right:8px;"></i> <a href="archivos/<?php echo $ctto_archivo['archivo']; ?>" target="_blank" style="color: #fff;">Contrato Vigente</a></p>
										</div>
								</div>

			</div>

			</div>

</div>


			</div>
	</div>

</div>


		<div id="contenedor-default">

			<div class="container">

				<div class="row">
					<div class="col-xs-6" style="margin-bottom: 35px;">
					<div id="box_sw_transp_s">



								 <!-- Nav tabs -->
								 <ul class="nav nav-tabs" role="tablist">
									 <li role="presentation" class="active"><a href="#home" aria-controls="home" role="tab" data-toggle="tab"><i class="fa fa-list" aria-hidden="true" style="margin-right:8px; color:#62cb31;"></i> Hitos / Ventas</a></li>
									 <li role="presentation"><a href="#tienda" aria-controls="tienda" role="tab" data-toggle="tab"><i class="fa fa-shopping-cart" aria-hidden="true" style="margin-right:8px; color:#62cb31;"></i> Tienda Info</a></li>
									 <li role="presentation"><a href="#Operador" aria-controls="Operador" role="tab" data-toggle="tab"><i class="fa fa-building" aria-hidden="true" style="margin-right:8px; color:#62cb31;"></i> Operador Info</a></li>
									 <li role="presentation"><a href="#profile" aria-controls="profile" role="tab" data-toggle="tab"><i class="fa fa-hourglass-half" aria-hidden="true" style="margin-right:8px; color:#62cb31;"></i> Bitacora Timeline</a></li>
									 <li role="presentation"><a href="#messages" aria-controls="messages" role="tab" data-toggle="tab"><i class="fa fa-envelope" aria-hidden="true" style="margin-right:8px; color:#62cb31;"></i> Notificaciones</a></li>
									 <li role="presentation"><a href="#Documentos" aria-controls="Documentos" role="tab" data-toggle="tab"><i class="fa fa-paperclip" aria-hidden="true" style="margin-right:8px; color:#62cb31;"></i> Adjuntos / Historico</a></li>
									 
								 </ul>

								 <!-- Tab panes -->
								 <div class="tab-content" style="background-color: #fff; border-left: 1px solid #ddd; border-right: 1px solid #ddd; border-bottom: 1px solid #ddd;">
									 <div role="tabpanel" class="tab-pane fade in active" id="home">
										 <div class="row" style="margin: 0px;">
											 <div class="col-xs-6 col-md-4" style="margin-bottom: 10px;">
												 <div class="box_plomizo_new" style="margin-top: 10px;">
														 <div class="pad-all">
																 <p class="text-lg text-semibold"><i class="fa fa-calendar" aria-hidden="true" style="margin-right:8px;"></i> Inicio del Contrato</p>
																  <h2><strong style="color: #62cb31;"><?php echo date("d-m-Y", strtotime($list_ctto['fecha_contrato'])); ?></strong></h2>
																 Fecha Inicio y firma Contrato
														 </div>
												 </div></div>
											 <div class="col-xs-6 col-md-4" style="margin-bottom: 10px;">
												 <div class="box_plomizo_new" style="margin-top: 10px;">
														 <div class="pad-all">
																 <p class="text-lg text-semibold"><i class="fa fa-calendar" aria-hidden="true" style="margin-right:8px;"></i> Renovación / Cláusula Salida</p>
																 <h2><strong style="color: #62cb31;"><?php echo date("d-m-Y", strtotime($list_ctto_view['fecha_clausula_salida'])); ?></strong></h2>
																 Clausula :  <?php echo $list_ctto['clausula_salida_renov']; ?> meses anticipados.
														 </div>
												 </div></div>
											 <div class="col-xs-6 col-md-4" style="margin-bottom: 10px;">
												 <div class="box_plomizo_new" style="margin-top: 10px;">
														 <div class="pad-all">
																 <p class="text-lg text-semibold"><i class="fa fa-calendar" aria-hidden="true" style="margin-right:8px;"></i> Termino Contrato</p>
																 <h2><strong style="color: #62cb31;"><?php echo date("d-m-Y", strtotime($list_ctto['fecha_vencimiento'])); ?></strong></h2>
																 Faltan <?php echo $list_ctto_view['dias_vence']; ?> dias.
														 </div>
												 </div></div>
										 </div>

										 <div id="box_sw_transp">
			  	 	<div id="box_sw_title">
			  	 		<i class="fa fa-usd" aria-hidden="true" style="margin-right:8px;"></i> Ventas / Pagos Mensuales <div id="mini_box_derecha"> <button type="button" class="btn btn-info btn-xs">Add Registro Mensual</button></div>
			  	 	</div>
			  	 	<div id="box_sw_content">
			  	 		<div class="text_bajada">Registro de pagos y tipo de pagos mensuales</div>
								<table class="table">
									<thead> <tr> <th>No.</th> <th>Mes/Año</th> <th>Venta Mensual</th> <th>Ventas/Mt2</th> <th>Tipo Pago</th> <th>Monto Pago</th> </tr> </thead>
									<tbody>
										<tr> <th scope="row">1</th> <td>Abril-2015</td> <td>25.548.625 CLP</td> <td>224.702 CLP</td> <td><span class="label label-success"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Variable</span></td> <td>1.586.245 CLP</td> </tr>
										<tr> <th scope="row">2</th> <td>Mayo-2015</td> <td>29.788.985 CLP</td> <td>261.996 CLP</td> <td><span class="label label-danger"><i class="fa fa-thumbs-o-down" aria-hidden="true"></i> Mínimo</span></td> <td>2.589.547 CLP</td> </tr>
										<tr> <th scope="row">3</th> <td>Junio-2015</td> <td>31.258.159 CLP</td> <td>274.917 CLP</td> <td><span class="label label-success"><i class="fa fa-thumbs-o-up" aria-hidden="true"></i> Variable</span></td> <td>2.852.365 CLP</td> </tr>
									</tbody>
								</table>
			  	 	</div>
			  	</div>

									 </div>
									 <div role="tabpanel" class="tab-pane fade" id="profile">
										 <section id="cd-timeline" class="cd-container">
											 <div class="cd-timeline-block">
												 <div class="cd-timeline-img">
													 <img src="images/1.png" class="img-circle">
												 </div> <!-- cd-timeline-img -->

												 <div class="cd-timeline-content">
													 <h2 style="color:#62cb31;">Rodrigo Palacios J.</h2>
													 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
													 <a href="#0" class="cd-read-more">Read more</a>
													 <span class="cd-date">03-05-2015</span>
												 </div> <!-- cd-timeline-content -->
											 </div> <!-- cd-timeline-block -->

											 <div class="cd-timeline-block">
												 <div class="cd-timeline-img">
													 <img src="images/2.png" class="img-circle">
												 </div> <!-- cd-timeline-img -->

												 <div class="cd-timeline-content">
													 <h2 style="color:#62cb31;">Alvaro Gonzalez J.</h2>
													 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde?</p>
													 <a href="#0" class="cd-read-more">Read more</a>
													 <span class="cd-date">25-06-2015</span>
												 </div> <!-- cd-timeline-content -->
											 </div> <!-- cd-timeline-block -->

											 <div class="cd-timeline-block">
												 <div class="cd-timeline-img">
													 <img src="images/3.png" class="img-circle">
												 </div> <!-- cd-timeline-img -->

												 <div class="cd-timeline-content">
													  <h2 style="color:#62cb31;">Camilo Gomez J.</h2>
													 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Excepturi, obcaecati, quisquam id molestias eaque asperiores voluptatibus cupiditate error assumenda delectus odit similique earum voluptatem doloremque dolorem ipsam quae rerum quis. Odit, itaque, deserunt corporis vero ipsum nisi eius odio natus ullam provident pariatur temporibus quia eos repellat consequuntur perferendis enim amet quae quasi repudiandae sed quod veniam dolore possimus rem voluptatum eveniet eligendi quis fugiat aliquam sunt similique aut adipisci.</p>
													 <a href="#0" class="cd-read-more">Read more</a>
													 <span class="cd-date">13-11-2015</span>
												 </div> <!-- cd-timeline-content -->
											 </div> <!-- cd-timeline-block -->

											 <div class="cd-timeline-block">
												 <div class="cd-timeline-img">
													 <img src="images/4.png" class="img-circle">
												 </div> <!-- cd-timeline-img -->

												 <div class="cd-timeline-content">
													 <h2 style="color:#62cb31;">Marcos Lopez M.</h2>
													 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum aut hic quasi placeat iure tempora laudantium ipsa ad debitis unde? Iste voluptatibus minus veritatis qui ut.</p>
													 <a href="#0" class="cd-read-more">Read more</a>
													 <span class="cd-date">10-03-2016</span>
												 </div> <!-- cd-timeline-content -->
											 </div> <!-- cd-timeline-block -->

											 <div class="cd-timeline-block">
												 <div class="cd-timeline-img">
													 <img src="images/5.png" class="img-circle">
												 </div> <!-- cd-timeline-img -->

												 <div class="cd-timeline-content">
													  <h2 style="color:#62cb31;">Marcelo Zamora T.</h2>
													 <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Iusto, optio, dolorum provident rerum.</p>
													 <a href="#0" class="cd-read-more">Read more</a>
													 <span class="cd-date">27-05-2016</span>
												 </div> <!-- cd-timeline-content -->
											 </div> <!-- cd-timeline-block -->

											 <div class="cd-timeline-block">
												 <div class="cd-timeline-img">
													 <img src="images/6.png" class="img-circle">
												 </div> <!-- cd-timeline-img -->

												 <div class="cd-timeline-content">
												 <h2 style="color:#62cb31;">Marisol Hidalgo G.</h2>
													 <p>This is the content of the last section</p>
													 <span class="cd-date">18-10-2016</span>
												 </div> <!-- cd-timeline-content -->
											 </div> <!-- cd-timeline-block -->
										 </section> <!-- cd-timeline -->
									 </div>
									 <div role="tabpanel" class="tab-pane fade" id="messages">

										 <div id="box_sw_transp_s">
						<div id="box_sw_title">
							<i class="fa fa-envelope" aria-hidden="true" style="margin-right:8px;"></i> Notificaciones de Eventos
						</div>
						<div id="box_sw_content">
							<div class="text_bajada">Registro de notificaciones enviadas a correos electronicos de los interesados</div>
								<table class="table table-striped">
									<thead> <tr> <th width="10%">#</th> <th width="20%">Fecha Envio</th> <th  width="30%">Asunto Notificacion</th> <th  width="40%">Destinatarios</th> </tr> </thead>
									<tbody>
										<tr> <th scope="row">1</th> <td><strong>05/Noviembre/2016</strong></td> <td>Aviso proxima renovacion de Contrato</td> <td>rpalacios@miempresa.cl , MLeiva@miempresa.cl , contratos@operador.cl</td> </tr>
										<tr> <th scope="row">2</th> <td><strong>10/Febrero/2017</strong></td> <td>Aviso de Proximo termino de Contrato</td> <td>rpalacios@miempresa.cl , MLeiva@miempresa.cl , contratos@operador.cl</td> </tr>
									</tbody>
								</table>
						</div>
					</div>

									 </div>


	 <!-- DETALLE TIENDA -->
									 <div role="tabpanel" class="tab-pane fade" id="tienda">

										 <div id="box_sw_transp_s">
												<div id="box_sw_title">
													<i class="fa fa-shopping-cart" aria-hidden="true" style="margin-right:8px;"></i> Información Tienda
												</div>
												<div id="box_sw_content">
													<div class="text_bajada">Información detalla y ubicación de la tienda del Contrato</div>

                          <div class="container">

                                <div class="row">

                                <div class="col-xs-12 col-md-8">

                                          <table class="table table-bordered table-striped table-condensed">
                                            <tbody>
                                              <tr> <th scope="row" width="30%">Operador :</th> <td>Cencosud Shopping Centers S.A.</td></tr>
                                              <tr> <th scope="row" width="30%">Ubicacion :</th> <td>Mall Costanera Center</td></tr>
                                              <tr> <th scope="row" width="30%">Dirección :</th> <td>Av. Andres Bello 2461</td></tr>
                                              <tr> <th scope="row" width="30%">Local (es) :</th> <td>Local # 4181 - Cuarto Piso</td></tr>
                                              <tr> <th scope="row" width="30%">Comuna :</th> <td>Providencia</td></tr>
                                              <tr> <th scope="row" width="30%">Ciudad :</th> <td>Santiago</td></tr>
                                              <tr> <th scope="row" width="30%">Región :</th> <td>Metropolitana</td></tr>
                                              <tr> <th scope="row" width="30%">Fono :</th> <td> (+562) 2 618 95 26</td></tr>
                                              <tr> <th scope="row" width="30%">Móvil :</th> <td>(+569) 83594347</td></tr>
                                              <tr> <th scope="row" width="30%">Email :</th> <td>store0383@skechers.com</td></tr>
                                              <tr> <th scope="row" width="30%">Jefe/Encargado Contacto :</th> <td>Marcelo Zamorano</td></tr>

                                            </tbody>
                                          </table>

                                        </div>

                                <div class="col-xs-6 col-md-4">

                                          <div class="box_calipso_new">
                                              <div class="pad-all">
                                          <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3330.2013915122634!2d-70.60857878524465!3d-33.41799348078324!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x9662cf69d4854951%3A0x9a87ef2fefaad0df!2sCostanera+Center!5e0!3m2!1ses-419!2scl!4v1474445497671" width="100%" height="300" frameborder="0" style="border:0" allowfullscreen></iframe>
                                              </div>
                                          </div>

                                </div>

                                </div>

                           </div>


												</div>
										 </div>

									 </div>

	 <!-- DETALLE OPERADOR -->
									 <div role="tabpanel" class="tab-pane fade" id="Operador">

										 <div id="box_sw_transp_s">
												<div id="box_sw_title">
													<i class="fa fa-building" aria-hidden="true" style="margin-right:8px;"></i> Informacion Operador
												</div>
												<div id="box_sw_content">
													<div class="text_bajada">Información del Operador del Contrato</div>

                          <table class="table table-bordered table-striped table-condensed">
                            <tbody>
                              <tr> <th scope="row" width="30%">Operador :</th> <td>Cencosud Shopping Centers S.A.</td></tr>
                              <tr> <th scope="row" width="30%">Ejecutivo :</th> <td>Carlos Montes A.</td></tr>
                              <tr> <th scope="row" width="30%">Dirección :</th> <td>Av. Andres Bello 2425, Of. N° 825 Octavo Piso.</td></tr>
                              <tr> <th scope="row" width="30%">Fono :</th> <td> (+562) 2 574 85 96</td></tr>
                              <tr> <th scope="row" width="30%">Móvil :</th> <td>(+569) 85697245</td></tr>
                              <tr> <th scope="row" width="30%">Email :</th> <td>cmontes@cencosud.com</td></tr>

                            </tbody>
                          </table>



												</div>
										 </div>

									 </div>

<!-- DOCUMENTOS ADJUNTOS -->
<div role="tabpanel" class="tab-pane fade" id="Documentos">

	 <div id="box_sw_transp_s">
			<div id="box_sw_title">
				<i class="fa fa-paperclip" aria-hidden="true" style="margin-right:8px;"></i> Documentos del Contrato ( PDF )
				<div id="mini_box_derecha"> <button type="button" class="btn btn-success btn-xs" data-toggle="modal" data-target="#uploadfiles"><i class="fa fa-upload" aria-hidden="true"></i> Subir Archivo</button></div>
			</div>
			<div id="box_sw_content">

			<table class="table">
			  <thead>
			    <tr>
			      <th scope="col">#</th>
			      <th scope="col">Archivo</th>
			     
			      <th scope="col">Fecha</th>
			      <th scope="col">Usuario</th>
			       <th scope="col">Idioma</th>
			     
			      <th scope="col" style="text-align: center;">Eliminar</th>
			    </tr>
			  </thead>
			  <tbody>
			  	 <?php 
			  	 $i = 1;
			  	 do { ?>

			    <tr>
			      <th scope="row"><?php echo $i; ?></th>
			      <td><a href="archivos/<?php echo $list_archivos['archivo']; ?>" target="_blank"><?php echo $list_archivos['nombre_archivo']; ?></a></td>
			      
			      <td><?php echo date("d-m-Y", strtotime($list_archivos['fecha'])); ?></td>
			      <td><?php echo $list_archivos['nombre_usuario']; ?></td>
			      <td><?php echo $list_archivos['idioma']; ?></td>
			    

			   
			      <td style="color: #FF0000; text-align: center;"><a href='#' onclick="eliminar('<?php echo $list_archivos['id_archivo']; ?>','<?php echo $idpost; ?>')">
			      <i class="fa fa-times" aria-hidden="true"></i></a></td>
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
	</div>
</div>



			</div>




		</div>



</div>

<div id="fondo"></div>
</div>
</div>


<!-- Modal CARAGA ARCHIVOS-->
<div class="modal fade" id="uploadfiles" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel"><i class="fa fa-upload" aria-hidden="true"></i> Cargar Archivos al Contrato</h4>
      </div>
      <div class="modal-body">
<!-- <div class="alert alert-danger" role="alert">
	  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		  Atencion : no utilizar espacio en blanco en nombre de Archivos.
	</div> -->
				
						<form action="upload_archivos_script.php" method="post" enctype="multipart/form-data">

			  	 		<div class="form-group">
						<label for="exampleInputEmail1">Archivo</label>	
			  	 	    <input name="fichero" class="form-control" type="file">
						</div>

						<div class="form-group">
						<label for="exampleInputEmail1">Nombre descripcion archivo</label>	
			  	 	    <input name="name_archivo" class="form-control" type="text" placeholder="Nombre Archivo sin espacios" maxlength="30" required="">
						</div>					  

						<div class="form-check">
					    <label class="form-check-label">
					      <input type="checkbox" name="contrato" class="form-check-input" value="1">
					      Marcar si archivo es el Contrato
					    </label>
					    </div><br>

					    <div class="form-group">
					    	Seleccionar idioma del archivo<br>
					    	 <input type="radio" name="idioma" value="Espanol" checked> Español<br>
							 <input type="radio" name="idioma" value="Ingles"> Ingles<br>
					    </div>

					    <br>
					
						<input class="hidden" name="id_rel_ctto" value="<?php echo $list_ctto['n_tienda']; ?>">
						<input class="hidden" name="id_pk_ctto" value="<?php echo $list_ctto['id_contrato']; ?>">

						<button name="submit" type="submit" class="btn btn-primary">Guardar Archivo</button>
						<button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>

						</form>


<br>
      </div>
    
    </div>
  </div>
</div>}
<!-- FIN MODAL CARGA ARCHIVOS -->






<!-- Modal -->
<div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title" id="myModalLabel">Tabla de Incremento Reajuste</h4>
      </div>
      <div class="modal-body">
<strong>Nota : Increase 10% every 36 months</strong><br>
				<table class="table table-bordered table-condensed" style="margin-bottom: 0px;">

					<thead>
						<tr style="background-color: #fff;">
							<th style="text-align:left;">Start Date</th>
							<th style="text-align:left;">End Date</th>
							<th style="text-align:left;">Incremento</th>

						</tr>
					</thead>

					<tbody>

						<tr>
							<td>01-05-2009</td>
							<td>30-04-2012</td>
							<td>186.4478 UF</td>
					  </tr>

						<tr>
							<td>01-05-2012</td>
							<td>30-04-2015</td>
							<td>205.09258 UF</td>
					  </tr>

						<tr>
							<td>01-05-2015</td>
							<td>30-04-2017</td>
							<td>225.601838 UF</td>
					  </tr>

						<tr>
							<td>01-05-2017</td>
							<td>30-04-2019</td>
							<td>248.1620218 UF</td>
					  </tr>

					</tbody>

				</table>
<br>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
        <button type="button" class="btn btn-primary">Editar</button>
      </div>
    </div>
  </div>
</div>

<!-- javascript
==================================================
Ubicar al final del documento para una carga mas rapida -->
<script src="js/jquery.js"></script>
<script src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<script src="vertical_timeline/js/main.js"></script> <!-- Resource jQuery para vertical timeline -->

    <!-- Menu Toggle Script - Para que menu lateral se oculte y aparezca -->
    <script>
    $("#menu-toggle").click(function(e) {
        e.preventDefault();
        $("#wrapper").toggleClass("toggled");
    });
    </script>
<!-- ======================================================= -->


<script language="javascript" type="text/javascript">
  function eliminar(id,ctto)
  {
    if (confirm("¿Realmente desea ELIMINAR Archivo seleccionado?"))
    {
      window.location='delete_archivos_script.php?id_arch='+id+'&cttodel='+ctto;
    }
  }
</script>


</body>
</html>
