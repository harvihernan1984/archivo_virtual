<?php session_start();
//echo "ini";
//return false;
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "<script type=''> mensaje('Por favor inicie sesion');</script>"; return false;}
header( 'Content-type: text/html; charset=iso-8859-1' );
$dir_virtual="documentos/gestion_documental";
$max_size=20; // por defecto se aceptan archivos de hasta 20 MB
$tp_ext=".png,.pdf,.jpg"; // son las extenciones admitidas por defecto
$sql="select (select valor from sis_configuracion where codigo='MAX_SIZE' and tipo='CONF') as max_size,
	(select valor from sis_configuracion where codigo='FORMAT_FILE' and tipo='CONF') as tp_ext,
    (select valor from sis_configuracion where codigo='GD_DIR_VIRTUAL' and tipo='CONF') as dir_virtual;";
$res=pg_query($conn,$sql);
if($reg=pg_fetch_array($res)){
	$max_size=$reg["max_size"];
	$tp_ext=$reg["tp_ext"];
	$dir_virtual=$reg["dir_virtual"];
}
$destino = $_SERVER['DOCUMENT_ROOT']."/".$directorio2."/".$dir_virtual;
$pasa_validacion=true;
if (!file_exists($destino)) {$error ="No existe el directorio donde se pretende almacenar el archivo.<br>Por favor contacte al administrador."; $pasa_validacion=false;}
$ind="";//=$_GET["codigo"];
//if($_FILES["imagen"]["error"]==0){// no hay erro archivo subio con exito
$ext="";
$dir="";
$error2="";
//proceso para registrar datos en base de datos
if(isset($_POST["empresa"])){ $empresa=$_POST["empresa"];} else{$error="no emp"; $ind=$_GET["ind2"];}
if(isset($_POST["documento"])){$documento=$_POST["documento"];}else{$error2=$error2."-no doc"; }
if(isset($_POST["codigo"])){$codigo=$_POST["codigo"];}else{$error2=$error2."-no cod";}
$nombre_doc=$_POST["nombre_doc"];
$guardo='N';
///if($codigo_per==''){$codigo_per=$_GET["permi"];}
//$error =$_FILES["imagen"]["error"];
$fojas=1 ; //POR DEFECTO PARA LOS ANEXOS EL NUMERO DE FOJAS ES 1, LOS DEMAS CASOS DEBEN SER EVALUADOS MAS ABAJO
$ext="";
if(isset($_FILES['imagen'])){
	//extraemos la extencion del aerchivo
	$nombre =  $_FILES['imagen']['name']; //nombre con el que lo subió el usuario
	$nombre_ini=$nombre;
	$ultimo_punto=strripos($nombre,".");
	$tipo=substr($nombre,$ultimo_punto,(strlen($nombre) - $ultimo_punto));
	//generamos nuevo nombre
	$randomOrder = rand(1, 99999999);
	$fecha=date("dmY");
	$hora = getdate(time());
	$hora_f= $hora["hours"].$hora["minutes"].$hora["seconds"];	
	$nombre=$_SESSION["gd_usuario"]."-".$fecha."-".$hora_f."-".$documento."-".rand(1, 99999999);
	//EXTRAEMOS LA EXTENCION
	$ext=str_ireplace('.','',$tipo);
	$ext=str_ireplace(' ','',$ext);
	$tamano = $_FILES['imagen']['size'];		//tamaño del archivo en Kb; 1024Kb = 1Mb
	//VALIDAMOS EL TAMANO DEL ARCHIVO SEGUN LO QUE ESTA CONFIGURADO
	$tama=($tamano / 1024) / 1024; // o convertimos en MB
	$tama=truncar($tama, 2);
	//$error = $_FILES['imagen']['error'];		//si apareció algún error en la subida
	$temp   = $_FILES['imagen']['tmp_name'];
	$destino=$destino."/".$nombre.$tipo;
	$nombre=$nombre.$tipo;
	
	if($tama>$max_size){$error ="El archivo tiene un tamano de ".$tama."MB superior a los ".$max_size." MB que estan permitidos."; $pasa_validacion=false;}
	$existe_ext = stripos($tp_ext, $ext);
	if($existe_ext===false){$error ="El archivo tiene una extencion .".$ext." la cual no es admitida."; $pasa_validacion=false;}
	
		//SI ES UN ARCHIVO PDF CALCULAMOS EL NUMERO DE HOJAS DE ANEXOS
    if($pasa_validacion==true){
		//if(strtoupper($ext)=='PDF'){
		//	$fojas=numeroPaginasPdf($temp);
		//}
		//$nombre=$nombre.$tipo;
		//if(strtoupper($ext)=='PDF' || strtoupper($ext)=='JPG' || strtoupper($ext)=='JPEG'  || strtoupper($ext)=='PNG'){
		if(move_uploaded_file($temp, $destino)){ 
			$dir=$destino;$guardo='G';
		}
		else{$error ="Ocurrio un errorr al moneto de mover al archivo al destino real ".$_FILES["imagen"]["error"];}
		//}else{
		//	if($codigo==''){	$error ="Archivo invalido, solo se aceptan documentos (.pdf .jpg .png) ...".$nombre_ini;}
		//}
    }
}//fin if(isset($_FILES['imagen'])){
else{$error =$_FILES["imagen"]["error"];}
$pasa=false;
if($codigo==''){// es nuevo
	if($guardo=='G'){$pasa=true;}
}
else{$pasa=true;}
if($pasa==true){
	$campos=explode(",","codigo,gd_usuario,gd_empresa_act,documento,accion,dir,nombre_doc,referencia,dir_virtual,extencion,fojas");
	$valores=explode(",",$codigo.",secion,secion,documento,E,".$dir.",".$nombre.",referencia,".$dir_virtual.",".$ext.",".$fojas);
	$sql="select * from ".f_genera_parametros("gd_reg_anexo_documento",$campos,$valores,11);
	//echo $sql;
	//$error= $sql; //'hasta _aqui 11';
	$res=pg_query($conn,$sql);
	$reg=pg_fetch_array($res);
	if($reg["res"]!="ok"){$error=$error.$reg["res"]; unlink($dir);}
	$codigo= $reg["cod"];
	//este proceso sirve para calcular las fojas de todos los documentos que se encuentre en el directorio
	//$sql="select dir_fisica_documento from gd_documento_anexo where upper(extencion)='PDF'";
	//$res=pg_query($conn,$sql);
	//while ($reg=pg_fetch_array($res)) {
	//		//ahora preguntamos si exite el directorio
	//		if (file_exists($reg["dir_fisica_documento"])) { //El fichero $nombre_fichero existe";
   //					 $fojas=numeroPaginasPdf($reg["dir_fisica_documento"]);
	//				 $sql="update gd_documento_anexo set fojas=".$fojas." where  dir_fisica_documento='".$reg["dir_fisica_documento"]."'";
	//				 $res2=pg_query($conn,$sql);
	//		}
	//}
	//echo "paso - ";
}
//echo "paso";
header ("Location: documento.php?empresa=".$empresa."&documento=".$documento."&codigo=".$codigo."&error=".$error);
?>
