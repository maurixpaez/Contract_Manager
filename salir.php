<?php 
session_start();
if (session_destroy())
{
	$_SESSION['login_user'] = NULL;
	$_SESSION['iduser'] = NULL;
	unset($_SESSION['login_user']);
	unset($_SESSION['iduser']);
	header("location: login.php");
}
?> 