<?php
try {
if(ValidaUsuario()==false){echo "<script>mensaje('Por favor inicie sesion');</script>"; return false;}
	$modulo=$_POST["opcion_contenido"];
	unset($campos);
		$campos[0]="codigo";
		$campos[1]="nombre";
		$campos[2]="ruc";
		$campos[3]="direccion";
		$campos[4]="nomenclatura";
		$campos[5]="directorio";
		$campos[6]="empresa_padre";
		$campos[7]="tipo";
	if(f_valida_objetos($campos)==false){
		$msg="Aparentemente faltan objetos del sistema:<br>Por favor cierre sision y vuelva a iniciar";
		echo "<script>mensaje('".$msg."');</script>";
		return false;
	}
	$msg_error="";
	if ($_POST["nombre"]==''){$msg_error="Ingrese el Nombre.<br>";}
	if ($_POST["ruc"]==''){$msg_error=$msg_error."Ingrese El ruc.<br>";}
	if ($_POST["direccion"]==''){$msg_error=$msg_error."Ingrese La direccion.<br>";}
	//if ($_POST["nomenclatura"]==''){$msg_error=$msg_error."Ingrese La Abreviatura.<br>";}
	if ($_POST["directorio"]==''){$msg_error=$msg_error."Seleccione el Directorio.<br>";}
	if ($_POST["empresa_padre"]=='-1'){$msg_error=$msg_error."Seleccione la Empresa Padre.<br>";}
	if ($_POST["tipo"]=='-1'){$msg_error=$msg_error."Seleccione el Tipo de Empresa.<br>";}
	if (f_valida_cedula_ruc($_POST["ruc"],'PP')==false){$msg_error=$msg_error."Corrija el RUC.<br>";}
	if($msg_error==""){
	//echo f_genera_parametros("reg_persona",$campos,$valores,14);
		unset($campos);
			$campos[0]="codigo=codigo";
			$campos[1]="modulo=".$modulo;
			$campos[2]="gd_usuario=secion";
			$campos[3]="nombre=nombre";
			$campos[4]="ruc=ruc";
			$campos[5]="direccion=direccion";
			$campos[6]="nomenclatura=nomenclatura";
			$campos[7]="directorio=directorio";
    		$campos[8]="empresa_padre=empresa_padre";
    		$campos[9]="tipo=tipo";
			$sql="select * from ".f_genera_parametros_v("gd_reg_empresa",$campos);
			echo $sql;
    		$res=pg_query($conn,$sql);
			$reg=pg_fetch_array($res);
    		$cerrar_ventana="$('#principal_windows').window('close');";
			if($reg["res"]=='NUEVO'){$msg="Registro Ingresado Correctammente";}
			if($reg["res"]=='UPDATE'){$msg="Registro actualizado Correctammente";}
			if($reg["res"]=='ERROR'){$cerrar_ventana="";$msg="Error : ".$reg["cod"];}                     
			echo "<script>".$cerrar_ventana." mensaje('".$msg."');MuestraDatos_contenido();</script>";
		}else{
			$msg="Para continuar realice lo siguiente:<br>".$msg_error;
			echo "<script>mensaje('".$msg."');</script>";
		}//FIN if($msg_error==""){
} catch (Exception $e) {
    $msg=$e->getMessage();
	echo '<script>mensaje("'.$msg.'");</script>';
}
/////////////////////////////////////////********************************************///////////////////////////////////////////
?>