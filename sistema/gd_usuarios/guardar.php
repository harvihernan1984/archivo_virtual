<?php
try {
if(ValidaUsuario()==false){echo "<script type=''> mensaje('Por favor inicie sesion');	</script>"; return false;}
//	if($_POST["nombre"]==""){ $validacion="Debe ingresar el nombre del usuario<br>";}
//	if($_POST["persona"]=="-1"){ $validacion=$validacion."Debe Seleccionar la persona.<br>";}
//	if($_POST["rol"]=="-1"){ $validacion=$validacion."Debe Seleccionar el rol.<br>";}
//	if($validacion==""){
//	$codigo=$_POST["codigo"];
//	$op=$_POST["opcion"];
	
	$modulo=$_POST["opcion_contenido"];
	unset($campos);
    $campos[0]="codigo";
    $campos[1]="opcion_contenido";
    $campos[2]="nombre";
    $campos[3]="clave";
    $campos[4]="clave2";
    $campos[5]="persona";
    $campos[6]="rol";
    $campos[7]="empresa";
    $campos[8]="directorio";
    $campos[9]="opcion";
	if(f_valida_objetos($campos)==false){
		$msg="Aparentemente faltan objetos del sistema:<br>Por favor cierre sision y vuelva a iniciar";
    	echo "<script>mensaje('".$msg."');</script>";
		return false;
	}
	$msg_error="";
	if ($_POST["nombre"]==''){$msg_error="Ingrese la nombre.<br>";}
	if ($_POST["persona"]==''){$msg_error=$msg_error."Seleccione el funcionario.<br>";}
	if ($_POST["rol"]=='-1'){$msg_error=$msg_error."Seleccione el roll.<br>";}
	if ($_POST["empresa"]=='-1'){$msg_error=$msg_error."Seleccione la empresa.<br>";}
	if ($_POST["directorio"]==''){$msg_error=$msg_error."Seleccione el Directorio.<br>";}
	if ($_POST["clave"]!=$_POST["clave2"]){$msg_error=$msg_error."Corrija las claves son diferentes.<br>";}
	if($msg_error==""){
		unset($campos);
		$campos[0]="codigo=codigo";
		$campos[1]="modulo=".$modulo;
		$campos[2]="gd_usuario=secion";
		$campos[3]="gd_empresa_act=secion";
		$campos[4]="nombre=nombre";
		$campos[5]="clave=clave";
		$campos[6]="persona=persona";
		$campos[7]="tipo=tipo";
		$campos[8]="rol=rol";
		$campos[9]="act=chk";
		$campos[10]="empresa=empresa";
		$campos[11]="estado=chk";
		$campos[12]="directorio=directorio";
		$sql="select * from ".f_genera_parametros_v("sis_reg_usuarios",$campos);
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