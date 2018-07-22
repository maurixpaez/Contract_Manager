<?php
// Conectando y seleccionado la base de datos
$conexion = pg_connect("host=localhost dbname=taskinbd user=postgres password=skcair1915")
    or die('No se ha podido conectar: ' . pg_last_error());
?>
