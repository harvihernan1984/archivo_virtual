<?php session_start();
//echo "ini";
//return false;
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "<script type=''> mensaje('Por favor inicie sesion');</script>"; return false;}
header( 'Content-type: text/html; charset=iso-8859-1' );
$dir_foto="documentos/gestion_documental";
$destino = $_SERVER['DOCUMENT_ROOT']."/".$directorio2."/".$dir_foto;
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
	//$error = $_FILES['imagen']['error'];		//si apareció algún error en la subida
	$temp   = $_FILES['imagen']['tmp_name'];
	$destino=$destino."/".$nombre.$tipo;
	$nombre=$nombre.$tipo;
	//$nombre=$nombre.$tipo;
	if(strtoupper($ext)=='PDF' || strtoupper($ext)=='JPG' || strtoupper($ext)=='JPEG'  || strtoupper($ext)=='PNG'){
		if(move_uploaded_file($temp, $destino)){ 
			$dir=$destino;$guardo='G';
		}
		else{$error ="Ocurrio un errorr Aqui 1".$_FILES["imagen"]["error"];}
	}else{
	if($codigo==''){	$error ="Archivo invalido, solo se aceptan documentos pdf ...".$nombre_ini;}
	
	}
}//fin if(isset($_FILES['imagen'])){
else{$error =$_FILES["imagen"]["error"];}
$pasa=false;
if($codigo==''){// es nuevo
	if($guardo=='G'){$pasa=true;}
}
else{$pasa=true;}
if($pasa==true){
	$campos=explode(",","codigo,gd_usuario,gd_empresa_act,documento,accion,dir,nombre_doc,referencia,dir_virtual");
	$valores=explode(",",$codigo.",secion,secion,documento,E,".$dir.",".$nombre.",referencia,".$dir_virtual);
	$sql="select * from ".f_genera_parametros("gd_reg_anexo_documento",$campos,$valores,9);
	//echo $sql;
	$res=pg_query($conn,$sql);
	$reg=pg_fetch_array($res);
	if($reg["res"]!="ok"){$error=$error.$reg["res"]; unlink($dir);}
	$codigo= $reg["cod"];
	//echo "paso - ";
}
//echo "paso";
header ("Location: documento.php?empresa=".$empresa."&documento=".$documento."&codigo=".$codigo."&error=".$error);
?>
