<?php
//conecto con la base de datos
include("conexion.php");
session_start();
$myusername = $_POST['usuario'];
$mypassword = sha1($_POST['contrasena']);

$sql_user = "SELECT * FROM sis_usuarios WHERE usuario = '$myusername' AND password = '$mypassword'";
$query_user = pg_query($conexion, $sql_user) or die("Error en la consulta SQL");
$row = pg_fetch_array($query_user, null,PGSQL_ASSOC);

$sql_log = "SELECT id_log FROM sis_log_acceso order by id_log desc";
$query_log = pg_query($conexion, $sql_log) or die("Error en la consulta log SQL");
$log = pg_fetch_array($query_log, null,PGSQL_ASSOC);


//$active = $row['active'];
$count = pg_num_rows($query_user);


if ($count==1)
	{
		if ($row['id_status'] == 1)
		{
   	$_SESSION['login_user']=$myusername;
   	$_SESSION['iduser']=$row['id_usuario'];
   	$_SESSION['name']=$row['nombre'];
   	$_SESSION['username']=$row['usuario'];

		$next_log = $log['id_log'] + 1;
		$user_log = $row['id_usuario'];
	  $fecha_log = date("d-m-Y H:i:s");
		$ip_address = $_SERVER['REMOTE_ADDR'];
		$datos_conexion = $_SERVER['HTTP_USER_AGENT'];

		/* Inserta Registro a log de acceso */
		$insertar = pg_query($conexion, "INSERT INTO sis_log_acceso (
		    id_log,
		    id_usuario,
		    fecha_acceso,
				ip_address,
				datos_conexion
		  )
		  VALUES
		  (
		    '$next_log',
		    '$user_log',
		    '$fecha_log',
				'$ip_address',
				'$datos_conexion'
		  );");

   header("Location: index.php");



	  }
		else
		{
				header("Location: login_deshabilitado.php");
		}
  }
 	else
 	{
 	header("Location: login_error.php");
 	}

?>
