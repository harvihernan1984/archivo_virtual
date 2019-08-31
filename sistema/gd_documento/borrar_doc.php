<?php session_start(); 
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "Por favor inicie sesion"; return false;}
$codigo=$_GET["cod1"];
////validamos si este usuario puede eliminar el registro
$sql="select count(*) as vpasa_validacion from usuario where codigo='".$_SESSION["usuario"]."' and empresa='".$_SESSION["empresa_act"]."';";
$res= pg_query($conn,$sql);
if( $reg=pg_fetch_array($res)){
	$validacion=$reg["vpasa_validacion"];
	if($validacion>0){
		///ahora estraemos el directorio actual del docuemnto
		$sql="select dir_fisica_documento as dir from gd_documento where  codigo='".$codigo."' and empresa='".$_SESSION["empresa_act"]."';";
		$res= pg_query($conn,$sql);
		if( $reg=pg_fetch_array($res)){
			$dir=$reg["dir"];
			if(file_exists($dir))
			{	if(unlink($dir)){
					$update="UPDATE gd_documento SET dir_fisica_documento='' ,nombre_doc=''; referencia_doc='';
					where codigo='".$codigo."' and empresa='".$_SESSION["empresa_act"]."' ";
					$r= pg_query($conn,$update);
					echo "ok"; return true;
					}
				else{echo "Documento no puede ser borrado.";} 
			}
			else{echo "El archivo no existe.";} 
		}
		else{echo "El documento no existe o no tiene los privilegios para borrarlo.";} 
		///// FIN  ////// ahora estraemos el directorio actual del docuemnto
	}else{echo "No tiene los privilegios para borrar el archivo.";} 
}//
else{echo "El documento no existe o no tiene los privilegios para borrarlo.";} 

	
	

//echo "<script type=''> alert('Datos Borrados........  '); <script>";


?>