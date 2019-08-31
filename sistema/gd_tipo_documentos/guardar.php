<?php
try {
if(ValidaUsuario()==false){echo  "<script>mensaje('Por favor inicie sesion');</script>";return false;}
	if(!isset($_GET["op"])){ // para registrar los datos del tipo de documento
	//validamos  que todos los objetos existan
		$modulo=$_POST["opcion_contenido"];
		unset($campos);
		$campos[0]="codigo";
		$campos[1]="nombre";
		$campos[2]="abreviatura";
		if(f_valida_objetos($campos)==false){
			$msg="Aparentemente faltan objetos del sistema:<br>Por favor cierre sision y vuelva a iniciar";
			echo "<script>mensaje('".$msg."');</script>";
			return false;
		}
		/// ************************VALIDACION DE DATOS *******************************
		$msg_error="";
		if ($_POST["nombre"]==''){$msg_error="Ingresar el Nombre del  Tipo de Documento.<br>";}
		if ($_POST["abreviatura"]==''){$msg_error=$msg_error."Ingresar el Nombre Abrevitura.<br>";}
		if($msg_error==""){
			unset($campos);
			$campos[0]="codigo=codigo";
			$campos[1]="modulo=".$modulo;
			$campos[2]="gd_usuario=secion";
			$campos[3]="gd_empresa_act=secion";
			$campos[4]="abreviatura=abreviatura";
			$campos[5]="nombre=nombre";
			$sql="select * from ".f_genera_parametros_v("gd_reg_tipo_documento",$campos);
			$res=pg_query($conn,$sql);
			$reg=pg_fetch_array($res);
    		//$cerrar_ventana="$('#principal_windows').window('close');";
			if($reg["res"]=='NUEVO'){
            		$msg="Registro Ingresado Correctammente";
            		$nuevo="$('#codigo').attr('value','".$reg["cod"]."');$('#cod').attr('value','".$reg["cod"]."');";
            	}
			if($reg["res"]=='UPDATE'){$msg="Registro actualizado Correctammente";}
			if($reg["res"]=='ERROR'){$cerrar_ventana="";$msg="Error : ".$reg["cod"];}                     
			echo "<script>".$nuevo." mensaje('".$msg."');MuestraDatos_contenido();</script>";
		}else{
			$msg="Para continuar realice lo siguiente:<br>".$msg_error;
			echo "<script>mensaje('".$msg."');</script>";
		}//FIN if($msg_error==""){
	}
	else{ // if(!isset($_GET["op"])){
		if ( $_GET["op"]=='at'){// para registrar o modificar los atributos
			/// ************************VALIDACION DE DATOS DE LOS ATRIBUTOS*******************************
			$modulo=$_POST["opcion_contenido"];
			unset($campos);
			$campos[0]="item_tributo";
			$campos[1]="nombre_val_atr";
			$campos[2]="orden_val_atr";
        	$campos[3]="codigo_val_atr";
        	$campos[4]="codigo";
        	$campos[5]="obligatorio_val_atr";
        	$campos[6]="tipo_dato_val_atr";
			if(f_valida_objetos($campos)==false){
				$msg="Aparentemente faltan objetos del sistema:<br>Por favor cierre sision y vuelva a iniciar";
				echo "<script>mensaje('".$msg."');</script>";
				return false;
			}
        	$msg_error="";
			if ($_POST["nombre_val"]==''){$msg_error="Ingresar el Nombre del Atributo.<br>";}
			if ($_POST["orden_val"]==''){$msg_error=$msg_error."Ingresar el Orden del Atributo.<br>";}
    		$obj=$_POST["item_tributo"];
			if($msg_error==""){
            	unset($campos);
            	$campos[0]="codigo_val_atr=codigo_val_atr";
            	$campos[1]="modulo=".$modulo;
            	$campos[2]="gd_usuario=secion";
            	$campos[3]="gd_empresa_act=secion";
            	$campos[4]="codigo=codigo";
            	$campos[5]="nombre_val_atr=nombre_val_atr";
            	$campos[6]="obligatorio_val_atr=obligatorio_val_atr";
            	$campos[7]="tipo_dato_val_atr=tipo_dato_val_atr";
            	$campos[8]="orden_val_atr=orden_val_atr";
            	$sql="select * from ".f_genera_parametros_v("gd_reg_atributos_documento",$campos);
            	$res=pg_query($conn,$sql);
            	$reg=pg_fetch_array($res);
    			//$cerrar_ventana="$('#principal_windows').window('close');";
				if($reg["res"]=='NUEVO'){
            		$msg="Registro Ingresado Correctammente";
            		$nuevo="asigan_cod_item('".$obj."','".$cod."');";
            	}
				if($reg["res"]=='UPDATE'){$msg="Registro actualizado Correctammente";}
				if($reg["res"]=='ERROR'){$cerrar_ventana="";$msg="Error : ".$reg["cod"];}                     
				echo "<script>".$nuevo." mensaje('".$msg."');MuestraDatos_contenido();</script>";
			}else{
				$msg="Para continuar realice lo siguiente:<br>".$msg_error;
				echo "<script>mensaje('".$msg."');</script>";
			}//FIN if($msg_error==""){
		} // FIN if ( $_GET["op"]=='at') SE DEBE GUARDAR UN ATRIBUTO
		if ( $_GET["op"]=='bt'){// proceso para borrar los atributos
    		$modulo=$_POST["opcion_contenido"];
			unset($campos);
			$campos[0]="item_tributo";
			if(f_valida_objetos($campos)==false){
				$msg="Aparentemente faltan objetos del sistema:<br>Por favor cierre sision y vuelva a iniciar";
				echo "<script>mensaje('".$msg."');</script>";
				return false;
			}
        	$msg_error="";
			if ($_POST["item_tributo"]==''){$msg_error="Seleccione un atributo.<br>";}
			//if ($_POST["orden_val"]==''){$msg_error=$msg_error."Ingresar el Orden del Atributo.<br>";}
    		//$obj=$_POST["item_tributo"];
			if($msg_error==""){
            	unset($campos);
            	$campos[0]="item_tributo=item_tributo";
            	$campos[1]="gd_usuario=secion";
            	$campos[2]="gd_empresa_act=secion";
            	$sql="select * from ".f_genera_parametros_v("gd_borra_atributo_documento",$campos);
            	$res=pg_query($conn,$sql);
            	$reg=pg_fetch_array($res);
    			//$cerrar_ventana="$('#principal_windows').window('close');";
				if($reg["res"]=='DELETE'){	$msg="Atributo borrado correctamente";}
				if($reg["res"]=='ERROR'){$cerrar_ventana="";$msg="Error : ".$reg["cod"];}                     
				echo "<script>mensaje('".$msg."');</script>";
			}else{
				$msg="Para continuar realice lo siguiente:<br>".$msg_error;
				echo "<script>mensaje('".$msg."');</script>";
			}//FIN if($msg_error==""){
		} // fin if ( $_GET["op"]=='bt'){ SE DEBE BORRAR EL ATRIBUTO
	} // fin if(!isset($_GET["op"])){
} catch (Exception $e) {
    $msg=$e->getMessage();
	echo "<script>mensaje('".$msg."');</script>";
}


?>