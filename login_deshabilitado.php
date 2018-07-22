
<!--<?php
//include('conexion.php');
//include('seguridad.php');

?> -->
<!DOCTYPE html>
<html lang="es">
<head>
<meta charset="utf-8"/>

<!-- CSS Script -->
<link rel="stylesheet" type="text/css" href="css/login.css" />
<link rel="stylesheet" type="text/css" href="css/estilos.css" />
<link rel="stylesheet" href="bootstrap/css/bootstrap.css" />
<link rel="stylesheet" href="bootstrap/css/bootstrap-responsive.css" />
<link rel="stylesheet" href="css/font-awesome.css">
<!-- CSS Script -->

<script src="js/date_now.js"></script>

<title>Taskin+ | Demo</title>

</head>
<body style="background-color: #f3f3f4; border-top: 4px solid #18a689;">

<div id="wrapper_login">


<div id="page-content-wrapper">
<div id="task-page-content-wrapper">

		<div id="titulo-login-wrapper">

		<div id="titulo-task-derecha">
			<!-- Fecha de dia -->
			<i class="fa fa-calendar" style="margin-right:5px;"></i> <script language="JavaScript" type="text/javascript">
	    document.write(TODAY);
	    </script>
			<!-- -->
		</div>

		</div>

		<div id="contenedor-default">

			<div class="login_box">
				<h4 class="logo-name">TASKIN+</h4>
				<strong>Bienvenidos a Taskin+</strong><br>
					Enterprise Contract Manager and Task Manager - Skechers

				<div class="login_form">
					<form class="m-t" role="form" action="control.php" method="POST">
									<div class="form-group">
											<input name="usuario" type="text" class="form-control" placeholder="Username" required="">
									</div>
									<div class="form-group">
											<input name="contrasena" type="password" class="form-control" placeholder="Password" required="">
									</div>
									<button type="submit" class="btn btn-primary btn-lg btn-block" style="background-color:#18a689; border: none;">Login</button>
					</form>
					<img src="images/logo-skechers.png">
				</div>

				<div class="alert alert-danger" role="alert" style="margin-top:20px;"><i class="fa fa-exclamation-circle"></i> <strong>Usuario Eliminado o Deshabilitado</strong> contactarse con Administrador del Sistema</div>

			</div>

		</div>


</div>




<div id="fondo"></div>
</div>
</div>

<!-- javascript
================================================== -->
<!-- Ubicar al final del documento para una carga mas rapida -->
<script src="js/jquery.js"></script>
<script src="js/jquery.min.js"></script>
<script src="bootstrap/js/bootstrap.min.js"></script>

<!-- ======================================================= -->
</body>

</html>
