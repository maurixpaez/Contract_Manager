<?php
include("conexion.php");

$active_user = $_SESSION['iduser'];

//======== IDENTIFICA USUARIO ==============
$sql_user_sesion = "SELECT * FROM sis_usuarios WHERE id_usuario = '$active_user'";
$query_user_sesion = pg_query($conexion, $sql_user_sesion) or die("Error en la consulta SQL");
$row_sesion = pg_fetch_array($query_user_sesion, null,PGSQL_ASSOC);


?>
