<!-- SCRIPT PHP ELIMINA ARCHIVOS EN SERVIDOR ===================== -->
<?php
include('conexion.php');
include('seguridad.php');


$id_borrar =  $_GET["id_arch"];
$id_cttoback =  $_GET["cttodel"];


$SQL="SELECT archivo FROM archivos where id_archivo = $id_borrar";
$result_ctto_tipo = pg_query ($conexion, $SQL) or die("Error en la consulta SQL");
$ctto_archivo = pg_fetch_array($result_ctto_tipo, null,PGSQL_ASSOC);

$ruta = "archivos/".$ctto_archivo['archivo'];

unlink($ruta);

$eliminar = pg_query($conexion, "DELETE FROM archivos WHERE id_archivo = $id_borrar;");

// echo $ruta;
// echo $id_borrar;
// echo $ctto_archivo['archivo'];


?>
<script language="javascript" type="text/javascript">
			  
window.location="contratos_detalle.php?idctto=<?php echo $id_cttoback; ?>&confirma=2";
			                                              
</script> 