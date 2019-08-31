<?php
//require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "Por favor inicie sesion"; return false;}
/*$campos=explode(",","codigo,usuario,empresa_act,nombre,descripcion,zona,distrito,unidad_operativa");
$valores=explode(",","codigo,secion,secion,nombre,descripcion,zona,distrito,unidad_operativa");
//echo f_genera_parametros("reg_modulos",$campos,$valores,6);
$sql="select * from ".f_genera_parametros("gd_reg_bodega",$campos,$valores,8);
$res=pg_query($conn,$sql);
//if(!){echo "Error"; return false;}
$reg=pg_fetch_array($res);
echo $reg["res"];*/
$separador="";
$codigos="";
if($_POST["op_guardar"]=='ORI'){
		$codigos="";
		foreach( $_POST['codigo_dest_movido'] as $cod_dest ) {
				 $codigos=$codigos. $separador.$cod_dest;
				  $separador="|";
		}
		$padre=$_POST['txt_padre'];
}
if($_POST["op_guardar"]=='DEST'){
		foreach( $_POST['codigo_ori_movido'] as $cod_ori ) {
			$codigos=$codigos. $separador.$cod_ori;
   			$separador="|";
		}
		$padre=$_POST['txt_padre_dest'];
}
	if($_POST['txt_opcion']=="gd_contenedor" &&  $_POST['txt_opcion_dest']=="gd_contenedor" ){
		unset($campos);
		$campos[0]="gd_usuario=secion";
		$campos[1]="gd_empresa=secion";
		$campos[2]="padre=".$padre;
		$campos[3]="codigos=".$codigos;
		$sql="select * from ".f_genera_parametros_v("gd_reg_mover_contenedor",$campos);
		$res=pg_query($conn,$sql);
		//if(!){echo "Error"; return false;}
		$reg=pg_fetch_array($res);
		$msg=$reg["res"];
		echo "<script>mensaje('".$msg."');RefrescaDatos_contenido();RefrescaDatos_contenido_dest();</script>";
	}//  ELSEif($_POST['txt_opcion']=="gd_contenedor" &&  $_POST['txt_opcion_dest']=="gd_contenedor" )
	else{ 
		if($_POST['txt_opcion']=="gd_documento" &&  $_POST['txt_opcion_dest']=="gd_documento" ){
				//$msg="esta tratando de mover documentos";
				unset($campos);
				$campos[0]="gd_usuario=secion";
				$campos[1]="gd_empresa=secion";
				$campos[2]="padre=".$padre;
				$campos[3]="codigos=".$codigos;
				$sql="select * from ".f_genera_parametros_v("gd_reg_mover_documento",$campos);
				$res=pg_query($conn,$sql);
				//if(!){echo "Error"; return false;}
				$reg=pg_fetch_array($res);
				$msg=$reg["res"];
				echo "<script>mensaje('".$msg."');RefrescaDatos_contenido();RefrescaDatos_contenido_dest();</script>";
		} 
		else{ //if($_POST['txt_opcion']=="gd_documento" &&  $_POST['txt_opcion_dest']=="gd_documento" ){
				$msg="Accion no permitida";
				echo "<script>$.messager.alert('Mensaje del Sistema','".$msg."','warning');</script>";
		} //FIN if($_POST['txt_opcion']=="gd_documento" &&  $_POST['txt_opcion_dest']=="gd_documento" ){
	}// FIN if($_POST['txt_opcion']=="gd_contenedor" &&  $_POST['txt_opcion_dest']=="gd_contenedor" )
?>