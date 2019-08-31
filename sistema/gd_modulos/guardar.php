<?php
try {
if(ValidaUsuario()==false){echo "<script type=''> mensaje('Por favor inicie sesion');	</script>"; return false;}

	
	$modulo=$_POST["opcion_contenido"];
	unset($campos);
    $campos[0]="codigo";
    $campos[1]="nombre";
    $campos[2]="pagina";
    $campos[3]="tipo";
    $campos[4]="padre";
    $campos[5]="referencia";
    $campos[6]="dir_img";
    $campos[7]="orden";
	if(f_valida_objetos($campos)==false){
		$msg="Aparentemente faltan objetos del sistema:<br>Por favor cierre sision y vuelva a iniciar";
    	echo "<script>mensaje('".$msg."');</script>";
		return false;
	}
	$msg_error="";
	if ($_POST["nombre"]==''){$msg_error="Ingrese la nombre.<br>";}
	if ($_POST["orden"]==''){$msg_error=$msg_error."Ingrese orden.<br>";}
	if($msg_error==""){
		unset($campos);
		$campos[0]="codigo=codigo";
		$campos[1]="modulo=".$modulo;
    	$campos[2]="gd_usuario=secion";
		$campos[3]="nombre=nombre";
		$campos[4]="pagina=pagina";
		$campos[5]="tipo=tipo";
		$campos[6]="padre=padre";
		$campos[7]="referencia=referencia";
		$campos[8]="directo=directo";
		$campos[9]="dir_img=dir_img";
		$campos[10]="orden=orden";
		$sql="select * from ".f_genera_parametros_v("sis_reg_modulos",$campos);
		$res=pg_query($conn,$sql);
		$reg=pg_fetch_array($res);
    	$cerrar_ventana="";
    	$cerrar_ventana="$('#principal_windows').window('close');";
    	if($reg["res"]=='NUEVO'){$msg="Registro Ingresado Correctammente";}
        if($reg["res"]=='UPDATE'){$msg="Registro actualizado Correctammente";}
    	if($reg["res"]=='ERROR'){$cerrar_ventana="";$msg="Error : ".$reg["cod"];}                     
        echo "<script>".$cerrar_ventana." mensaje('".$msg."'); MuestraDatos_contenido();</script>";
	}else{
    	$msg="Para continuar realice lo siguiente:<br>".$msg_error;
    	echo "<script>mensaje('".$msg."');</script>";
	}//FIN if($msg_error==""){
} catch (Exception $e) {
    $msg=$e->getMessage();
	echo "<script>mensaje('".$msg."');</script>";
}


?>