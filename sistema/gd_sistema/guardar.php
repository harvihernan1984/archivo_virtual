<?php
if(ValidaUsuario()==false){echo "<script type=''> mensaje('Por favor inicie sesion');</script>"; return false;}
if(f_valida_acceso_rol('sis_configuracion',$conn)==false){
	echo "<script type=''> mensaje('El usuario no tiene privilegios suficientes...');</script>"; return false;
}
//echo f_valida_acceso_rol('sis_configuracion',$conn);
$sql="SELECT * from sis_configuracion where tipo='CONF'" ;
$res=pg_query($conn,$sql);
$i=0;
while ($reg=pg_fetch_array($res))
{ 	$codigo=$reg["codigo"];
	$obj="obj".$codigo;
	if(isset($_POST[$obj])){
		$sql="update sis_configuracion set valor='".$_POST[$obj]."' where tipo='CONF' and codigo='".$codigo."'";
		$res2=pg_query($conn,$sql);
    	$i++;
    	//echo $sql;
	}
}
$msg="Registro actualizado Correctammente ".$i." configuraciones.";
echo "<script>mensaje('".$msg."');MuestraDatos_contenido();</script>";
?>