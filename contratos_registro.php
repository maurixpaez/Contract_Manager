<?php
include('conexion.php'); //Conexion a Base de Datos
include('seguridad.php'); // Seguridad de Pagina
include('querys/global_query.php'); // Script querys globales
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
		<img src="images/logo-skechers_small.png"> /<a href="contratos.php"> Contratos</a> / Registro
    <?php include "panel_usuario.php" ?>
		</div>
<!-- Fin Titulo -->

<div id="contenedor-default">
	<h4>Formulario de Registro</h4>

	<div class="col-xs-6">
			<div id="box_sw_full" >

<!-- Titulo Contrato -->
				<div id="contenedor-titulo">
					<i class="fa fa-file-text" style="color:#62cb31; margin:8px;"></i> Creación de nuevo contrato
				</div>

<!-- Detalle del contrato -->
<div class="container">

	<div class="alert alert-danger" role="alert">
	  <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
		  Atencion : Utilizar punto para separar decimales (EJ: 258.25), <strong>NO</strong> utilizar punto como separador de miles (Ej: 48625).
	</div>

<div class="row">

<form method="POST" action="querys/users_add.php">
<div class="col-xs-12 col-md-8" style="padding: 0px 20px 0px 10px; margin-bottom: 0px;">



					<div class="form-group">
					<label for="exampleInputEmail1">N° Tienda (*)</label>
					<input type="text" class="form-control" id="ntienda" name="ntienda" placeholder="Numero de Tienda" maxlength="6" required="">
					</div>

					<div class="form-group">
					<label for="exampleInputPassword1">Operador (*)</label>
					<input type="text" class="form-control" id="operador" name="operador" placeholder="Nombre del Operador del Contrato" maxlength="60" required="">
					</div>

					<div class="form-group">
					<label for="exampleInputEmail1">N° Local</label>
					<input type="text" class="form-control" id="nlocal" name="nlocal" placeholder="Numero de Local" maxlength="60">
					</div>

					<div class="form-group">
					<label for="exampleInputPassword1">Mt2 (*)</label>
					<input type="text" class="form-control" id="mt2" name="mt2" placeholder="Cantidad de Mt2." maxlength="10">
					<p class="help-block" style="color:#ef5350;">Utilizar punto para separar decimales.</p>
					</div>

					<div class="form-group">
					<label for="exampleInputEmail1">Ubicacion</label>
					<input type="text" class="form-control" id="ubicacion" name="ubicacion" placeholder="Ej: Mall Marina Arauco" maxlength="60">
					</div>

					<div class="form-group">
					<label for="exampleInputEmail1">Comuna</label>
					<input type="text" class="form-control" id="comuna" name="comuna" placeholder="Comuna Ej: Maipu" maxlength="60">
					</div>

					<div class="form-group">
					<label for="exampleInputEmail1">Ciudad</label>
					<input type="text" class="form-control" id="ciudad" name="ciudad" placeholder="Ciudad Ej: Santiago" maxlength="60">
					</div>

</div>

<div class="col-xs-6 col-md-4" style="margin-bottom: 0px;">

	<div class="form-group">
	<label for="exampleInputEmail1">Fecha Contrato (*)</label>
	<input type="text" class="form-control" id="fecha_contrato" name="fecha_contrato" placeholder="Fecha del Contrato" maxlength="10" required="">
	</div>

	<div class="form-group">
	<label for="exampleInputPassword1">Fecha Pago Renta</label>
	<input type="text" class="form-control" id="fecha_renta" name="fecha_renta" placeholder="Fecha pago renta" maxlength="10">
	</div>

	<div class="form-group">
	<label for="exampleInputEmail1">Plazo Contractual ( Meses )</label>
	<input type="text" class="form-control" id="plazo_contractual" name="plazo_contractual" placeholder="Plazo en meses del contrato" maxlength="4">
	</div>

	<div class="form-group">
	<label for="exampleInputPassword1">Valor Minimo Mensual UF</label>
	<input type="text" class="form-control" id="renta_mensual" name="renta_mensual" placeholder="Ej: 284.25" maxlength="10">
		<p class="help-block" style="color:#ef5350;">Utilizar punto para separar decimales.</p>
	</div>

	<div class="form-group">
	<label for="exampleInputEmail1">Valor Variable Mensual %</label>
	<input type="text" class="form-control" id="valor_variable" name="valor_variable" placeholder="Ej: 8.50" maxlength="10">
	</div>

	<div class="form-group">
	<label for="exampleInputEmail1">Clausula Salida Renovacion ( Meses )</label>
	<input type="text" class="form-control" id="clausula_salida" name="clausula_salida" placeholder="Meses antes del vencimiento Ej: 6" maxlength="4">
	</div>

	<div class="form-group">
	<label for="exampleInputPassword1">Fecha Vencimiento</label>
	<input type="text" class="form-control" id="fecha_vencimiento" name="fecha_vencimiento" placeholder="Fecha de venimiento del contrato" maxlength="10">
	</div>

</div>

</div>

<br><br> <!-- Bloque inferior -->

<div class="row">
			<div class="col-xs-6 col-md-4" style="margin-bottom: 0px;">
				<div class="form-group">
				<label for="exampleInputEmail1">Garantia UF</label>
				<input type="text" class="form-control" id="garantia" name="garantia" placeholder="Utilizar punto Ej: 285.25" maxlength="10">
				</div>

				<div class="form-group">
				<label for="exampleInputEmail1">Tipo de Garantia</label>
				<input type="text" class="form-control" id="tipo_garantia" name="tipo_garantia" placeholder="Tipo de garantia" maxlength="20">
				</div>

				<div class="form-group">
				<label for="exampleInputPassword1">Vencimiento Garantia</label>
				<input type="text" class="form-control" id="vencimiento_garantia" name="vencimiento_garantia" placeholder="Fecha de venimiento de garantia" maxlength="10">
				</div>
			</div>

			<div class="col-xs-6 col-md-4" style="margin-bottom: 0px;">
				<div class="form-group">
				<label for="exampleInputEmail1">Valor Diciembre (Arriendos)</label>
				<input type="text" class="form-control" id="valor_dic" name="valor_dic" placeholder="Cantidad de arriendos" maxlength="20">
				</div>

				<div class="form-group">
				<label for="exampleInputEmail1">Fondo Promocion UF</label>
				<input type="text" class="form-control" id="fondo_promo" name="fondo_promo" placeholder="Valor en UF" maxlength="20">
				</div>

				<div class="form-group">
				<label for="exampleInputPassword1">Gasto Comun UF</label>
				<input type="text" class="form-control" id="gasto_comun" name="gasto_comun" placeholder="Gasto Comun en UF" maxlength="20">
				</div>
			</div>

			<div class="col-xs-6 col-md-4" style="margin-bottom: 0px;">
				<div class="form-group">
				<label for="exampleInputEmail1">Gastos Administrativos UF</label>
				<input type="text" class="form-control" id="gastos_admin" name="gastos_admin" placeholder="Gastos administrativos en UF" maxlength="20">
				</div>

				<div class="form-group">
				<label for="exampleInputEmail1">Valor UF fecha Contrato</label>
				<input type="text" class="form-control" id="valor_uf" name="valor_uf" placeholder="UF al dia de contrato" maxlength="4">
				</div>

				<div class="form-group">
				<label for="exampleInputPassword1">Porcentaje Reajuste</label>
				<input type="text" class="form-control" id="porc_reajuste" name="porc_reajuste" placeholder="Porcentaje de Reajuste" maxlength="10">
				</div>
			</div>

</div>

<button type="submit" class="btn btn-success"><i class="fa fa-floppy-o" aria-hidden="true"></i> Guardar</button>

</form>
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
