<?php
require_once("conexion.php");
if(ValidaUsuario()==false){echo "<script type=''> mensaje('Por favor inicie sesion');	</script>"; return false;}
$validacion="";
if($_POST["nombre"]==""){ $validacion="Debe Ingresar el Nombre<br>";}
if($_POST["descripcion"]==""){ $validacion=$validacion."Debe Ingresar el Descripcion<br>";}
if($_POST["tipo"]=="-1"){ $validacion=$validacion."Debe Seleccionar el Tipo<br>";}
if($validacion==""){
//echo f_genera_parametros("reg_persona",$campos,$valores,14);
unset($campos);
	$campos[0]="gd_usuario=secion";
	$campos[1]="gd_empresa_act=secion";
	$campos[2]="codigo=codigo";
	$campos[3]="nombre=nombre";
	$campos[4]="descripcion=descripcion";
	$campos[5]="tipo=tipo";
	$campos[6]="contenedor=contenedor";
	$campos[7]="estado=estado";
	$campos[8]="custodio=custodio";
	$campos[9]="borrado=N";
	$sql="select * from ".f_genera_parametros_v("gd_reg_contenedor",$campos);
	$res=pg_query($conn,$sql);
	//if(!){echo "Error"; return false;}
	$reg=pg_fetch_array($res);
	$msg=$reg["res"];
	if($reg["res"]=='NUEVO'){$msg="Registro Ingresado Correctammente";}
	if($reg["res"]=='UPDATE'){$msg="Registro actualizado Correctammente";}
	echo "<script>$('#principal_windows').window('close');mensaje('".$msg."');RefrescaDatos_contenido();</script>";

}else{
	$msg="Para continuar realice lo siguiente:<br>".$validacion;
	echo "<script>mensaje('".$msg."');</script>";
}


?>