<!-- SCRIPT PHP SUBE ARCHIVOS A SERVIDOR ===================== -->
<?php
include('conexion.php');
include('seguridad.php');
include('querys/global_query.php'); // Script querys globales

// arreglo de documentos saca el ultimo ID

$SQL="SELECT id_archivo FROM archivos ORDER BY id_archivo DESC";
$result_ctto_tipo = pg_query ($conexion, $SQL) or die("Error en la consulta SQL");
$ctto_archivo = pg_fetch_array($result_ctto_tipo, null,PGSQL_ASSOC);
if (empty($ctto_archivo['id_archivo'])) { $ctto_archivo['id_archivo'] = 0;}
if (empty($_POST['contrato'])) { $_POST['contrato'] = 0;}
$id_doc_next = $ctto_archivo['id_archivo'] + 1;

#echo $id_doc_next;

if (isset($_POST['submit'])) 
{   
if(is_uploaded_file($_FILES['fichero']['tmp_name'])) 
{ 


// me verifica que haya sido cargado el archivo  
$ruta_destino = "archivos/"; 
$namefinal= $_POST["id_rel_ctto"]."_".$id_doc_next.".pdf";// asigna nuevo nombre al archivo para que no se repita en la carpeta 
$uploadfile= $ruta_destino . $namefinal;  

if(move_uploaded_file($_FILES['fichero']['tmp_name'],$uploadfile)) 
{ // se coloca en su lugar final  

	#echo "El fichero es válido y se subió con éxito.\n";
            
		    $nombre_archivo  = $_POST["name_archivo"]; 
           	$id_relac = $_POST['id_rel_ctto'];
         	$tipo_ctto = $_POST['contrato'];
           	$name_arch = $namefinal;
           	$tamano = $_FILES['fichero']['size'];
           	$type = $_FILES['fichero']['type'];
           	$usuario = $_SESSION['iduser'];
           	$nombre_usuario = $row_sesion['nombre'];
           	$fecha = date("d-m-Y H:i:s");
           	$idioma = $_POST['idioma'];


   //         	echo $id_doc_next;
			// echo	$id_relac;
			// echo	$name_arch;
			// echo	$tipo_ctto;
			// echo	$tamano;
		 //    echo $type;
			// echo	$nombre_archivo;

	        $insertar = pg_query($conexion, "INSERT INTO archivos(
            id_archivo, n_contrato, archivo, tipo_contrato, tamano, tipo_archivo, 
            nombre_archivo,fecha,usuario,nombre_usuario,idioma)
            VALUES
			(
			'$id_doc_next',
			'$id_relac',
			'$name_arch',
			'$tipo_ctto',
			'$tamano',
			'$type',
			'$nombre_archivo',
			'$fecha',
			'$usuario',
			'$nombre_usuario',
			'$idioma'
			);");

	    ?>
												
			<script language="javascript" type="text/javascript">
			  
			      window.location="contratos_detalle.php?idctto=<?php echo $_POST["id_pk_ctto"]; ?>&confirma=1";
			                                              
			</script> 

			<?php
							                               
	        } 
	        else 
	        {
	        	Echo "Error al cargar el archivo";
	        } 
	      
	    }  
		} 
		?>
		<!-- FIN SCRIPT PHP SUBE ARCHIVOS A SERVIDOR ===================== -->