<?php
try {
if(ValidaUsuario()==false){echo "<script type=''> mensaje('Por favor inicie sesion');	</script>"; return false;}
	$modulo=$_POST["opcion_contenido"];
	unset($campos);
		$campos[0]="codigo";
		$campos[1]="nombre";
		$campos[2]="mostrar";
	if(f_valida_objetos($campos)==false){
		$msg="Aparentemente faltan objetos del sistema:<br>Por favor cierre sision y vuelva a iniciar";
		echo "<script>mensaje('".$msg."');</script>";
		return false;
	}
	$msg_error="";
	if($_POST["nombre"]==""){ $msg_error="Debe ingresar el nombre del usuario<br>";}
	if($_POST["mostrar"]==""){ $msg_error=$msg_error."Debe Seleccionar la persona.<br>";}
	if($msg_error==""){
		unset($campos);
		$campos[0]="codigo=codigo";
		$campos[1]="gd_usuario=secion";
		$campos[2]="gd_empresa_act=secion";
		$campos[3]="nombre=nombre";
		$campos[4]="mostrar=mostrar";
		$sql="select * from ".f_genera_parametros_v("sis_reg_rol_usuarios",$campos);
		$res=pg_query($conn,$sql);
		$reg=pg_fetch_array($res);
    	$cerrar_ventana="";
    	//$cerrar_ventana="$('#principal_windows').window('close');";
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
	echo "<script>mensaje('".$msg."');</script>";
}

?>