<?php
include("conexion.php");
session_start();
$user_check=$_SESSION['login_user'];
// Busco en la BD el usuario que inicio sesion de acuerdo a la variable
// $user_check que toma los datos del $_SESSION['login_user']
$query_user = pg_query($conexion, "SELECT usuario FROM sis_usuarios WHERE usuario = '$user_check'");
$row = pg_fetch_array($query_user, null,PGSQL_ASSOC);

$login_session=$row['usuario'];
$idu = $_SESSION['iduser'];

// Si en la consulta $query no se encontro nada, $login_session sera NULL, no existe
// y se redirige al index y no permite el acceso a la aplicacion
if (!isset($login_session))
{
    //echo $row['usuario'];
   	header("Location: login.php");
   	exit();
}
?>
