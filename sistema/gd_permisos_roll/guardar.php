<?php

if(ValidaUsuario()==false){echo "<script type=''> alert('Por favor inicie sesion');</script>"; return false;}
$codigo=$_POST["codigo"];
if ($codigo<>"") //actualizar registro
{	$sql="select codigo from sis_modulos where tipo='I' ";
	$res=pg_query($conn,$sql);	
	while($reg=pg_fetch_array($res)){
		$campos=explode(",","gd_usuario,codigo,mod".$reg["codigo"].",acceso".$reg["codigo"]);
		$valores=explode(",","secion,codigo,mod".$reg["codigo"].",chk");
		$sql="select * from ".f_genera_parametros("sis_reg_permiso_roll",$campos,$valores,4);
		$res2=pg_query($conn,$sql);
		//if(!){echo "Error"; return false;}
	}
}
$msg="Registro actualizado Correctammente";
echo "<script>mensaje('".$msg."');</script>";


?>