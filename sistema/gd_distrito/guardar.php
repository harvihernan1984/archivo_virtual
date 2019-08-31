<?php
require_once("conexion.php");
if(ValidaUsuario()==false){echo "<script type=''> mensaje('Por favor inicie sesion');	</script>"; return false;}
$validacion="";
if($_POST["nombre"]==""){ $validacion="Debe Ingresar el Nombre<br>";}
if($validacion==""){
//echo f_genera_parametros("reg_persona",$campos,$valores,14);
unset($campos);
	$campos[0]="codigo=codigo";
	$campos[1]="gd_usuario=secion";
	$campos[2]="gd_empresa_act=secion";
	$campos[3]="nombre=nombre";
	$campos[4]="zona=zona";
	$sql="select * from ".f_genera_parametros_v("gd_reg_distrito",$campos);
	$res=pg_query($conn,$sql);
	//if(!){echo "Error"; return false;}
	$reg=pg_fetch_array($res);
	if($reg["res"]=='NUEVO'){$msg="Registro Ingresado Correctammente";}
	if($reg["res"]=='UPDATE'){$msg="Registro actualizado Correctammente";}
	echo "<script>$('#principal_windows').window('close');mensaje('".$msg."');RefrescaDatos_contenido();</script>";

}else{
	$msg="Para continuar realice lo siguiente:<br>".$validacion;
	echo "<script>mensaje('".$msg."');</script>";
}


?>