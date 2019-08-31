<?php
//require_once("../../conexion.php");
try {
if(ValidaUsuario()==false){echo "<script type=''> mensaje('Por favor inicie sesion');	</script>"; return false;}
	$modulo=$_POST["opcion_contenido"];
	unset($campos);
    $campos[0]="codigo";
    $campos[1]="cedula";
    $campos[2]="apellido";
    $campos[3]="nombre";
    $campos[4]="direccion";
    $campos[5]="telefono";
    $campos[6]="cargo";
    $campos[7]="correo";
	if(f_valida_objetos($campos)==false){
		$msg="Aparentemente faltan objetos del sistema:<br>Por favor cierre sision y vuelva a iniciar";
    	echo "<script>mensaje('".$msg."');</script>";
		return false;
	}
	$msg_error="";
	if ($_POST["cedula"]==''){$msg_error="Ingrese la cedula.<br>";}
	if ($_POST["apellido"]==''){$msg_error=$msg_error."Ingrese El apellido.<br>";}
	if ($_POST["apellido"]==''){$msg_error=$msg_error."Ingrese El Nombre.<br>";}
	if ($_POST["direccion"]==''){$msg_error=$msg_error."Ingrese La direccion.<br>";}
	if ($_POST["telefono"]==''){$msg_error=$msg_error."Ingrese La Telefono.<br>";}
	if ($_POST["correo"]==''){$msg_error=$msg_error."Ingrese La Correo.<br>";}
	if ($_POST["cargo"]==''){$msg_error=$msg_error."Ingrese El Cargo.<br>";}
	if (f_valida_cedula_ruc($_POST["cedula"],'PN')==false){$msg_error=$msg_error."Corrija la Cedula.<br>";}
	if($msg_error==""){
//echo f_genera_parametros("reg_persona",$campos,$valores,14);
		unset($campos);
    	$campos[0]="codigo=codigo";
    	$campos[1]="modulo=".$modulo;
    	$campos[2]="gd_usuario=secion";
    	$campos[3]="gd_empresa_act=secion";
    	$campos[4]="cedula=cedula";
    	$campos[5]="apellido=apellido";
    	$campos[6]="nombre=nombre";
    	$campos[7]="direccion=direccion";
    	$campos[8]="telefono=telefono";
    	$campos[9]="cargo=cargo";
    	$campos[10]="correo=correo";
    	$sql="select * from ".f_genera_parametros_v("gd_reg_persona",$campos);
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