<?php //require_once("../../conexion.php");
$exportando="SI";
ob_start(); 
header("Content-Type: application/vnd.ms-excel");
header("Expires: 0");
header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
header("content-disposition: attachment;filename=reporte".$_SESSION["gd_usuario"].".xls");
header("<META httpequiv='ContentType' content='text/html; charset=UTF-8'>");
header("<?xml version='1.0' encoding='ISO-8859-1' ?> ");
//header("Content-Disposition: attachment; filename=reporte".$_SESSION["usuario"].".xls");   
include('consulta.php');
$datos =ob_get_clean();

if($_SESSION["gd_msg_exportando"]=='NO'){
    	$total_doc=$_SESSION["gd_exportando_numero"];
		$limte_reg_conf=$_SESSION["gd_exportando_limite"];
		echo "<script>mensaje('Por razones de optimizacion del sistema no se puede generar el reporte.<br>El limite maximo de resultados es: ".$limte_reg_conf." y este reporte tiene: ".$total_doc.", Por favor utilice algun filtro.<br>Si aun requiere el reporte comuniquese con el administrador del sistema.');</script>"; return false;
}
$nombre_archivo = 'reporte'.$_SESSION["gd_usuario"].'.xls';
$contenido = $datos;

$carpeta=$_POST["carpeta"];
$dir_temporal="documentos/temp/";
$ubicacion=$dir_temporal.$nombre_archivo;
$ubicacion2=$_SERVER['DOCUMENT_ROOT']."/".$directorio2."/".$ubicacion;
file_exists($ubicacion2);
if (file_exists($ubicacion2)){unlink($ubicacion2);}
fopen($ubicacion2, 'a+');
// Asegurarse primero de que el archivo existe y puede escribirse sobre el.
if (is_writable($ubicacion2)) {

   // En nuestro ejemplo estamos abriendo $nombre_archivo en modo de adicion.
   // El apuntador de archivo se encuentra al final del archivo, asi que
   // alli es donde ira $contenido cuando llamemos fwrite().
   if (!$gestor = fopen($ubicacion2, 'a')) { echo "fallo 1" ;exit; }

   // Escribir $contenido a nuestro arcivo abierto.
   if (fwrite($gestor, $contenido) === FALSE) {echo "fallo 2" ;exit;}
   fclose($gestor);
	echo "<script>window.open('".$ubicacion."', '_blank');</script>";
} else {
   echo "No se puede escribir sobre el archivo ".$ubicacion2;
}
?>
			
			
