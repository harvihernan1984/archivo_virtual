<?php
require_once("conexion.php");
$buscar  = array("'", " insert ", " delete ", " update ", " select "," into ", " or ","'");
$reemplazar = array(" ", " ", " ", " ", " "," "," "," ");
$usuario=f_sin_sql($_POST["usuario"]);
$clave=f_sin_sql($_POST["password"]);
$sql="select codigo,nombre,persona,(select nombre from sis_rol_usuario where codigo=sis_usuario.rol) as nomb_rol,rol,empresa,
	empresa_act,periodo_act, coalesce((select directorio from gd_empresa where codigo=sis_usuario.empresa_act),'') AS directorio_ini,directorio,
	get_directorio(coalesce((select directorio from gd_empresa where codigo=sis_usuario.empresa_act),'')) as dir_raiz,
	get_directorio(directorio) as dir_act_raiz,
	coalesce((select nombre from gd_empresa where codigo=sis_usuario.empresa),'') as nombre_empresa_act
from sis_usuario where estado='1' and upper(nombre)= upper('".$usuario."') and upper(clave)=upper(md5('".$clave."'))";
if(!isset($conn)){echo "<script type=''> alert('No se puede conectar a la base de datos, Vuelva a intentar........  ');window.location='index.php' ; </script>"; return false;}
$res=pg_query($conn,$sql);
if (pg_num_rows( $res)!=0){ 
	$reg=pg_fetch_array($res);
	$sql="select * from gd_persona where codigo='".$reg["persona"]."'";
	$res2=pg_query($conn,$sql);
	$_SESSION["gd_nombre_usuario"]=" ";
	if (pg_num_rows( $res2)!=0){$reg2=pg_fetch_array($res2);$_SESSION["nombre_usuario"]=$reg2["apellido"]." ".$reg2["nombre"];}
	$_SESSION["gd_autenticado"]= "SI";
	$_SESSION["gd_empresa"]= $reg["empresa"];
	$_SESSION["gd_empresa_act"]= $reg["empresa_act"];
	$_SESSION["gd_periodo_act"]= $reg["periodo_act"];
	$_SESSION["gd_nombre_empresa_act"]= $reg["nombre_empresa_act"];
	$_SESSION["gd_usuario"]= $reg["codigo"];
	$_SESSION["gd_directorio_ini"]= $reg["directorio_ini"]; //directorio general del usuarios por la empresa a la que corresponde
	$_SESSION["gd_directorio_raiz"]= $reg["dir_raiz"]; //almacena el nombre del directorio general del usuario
	$_SESSION["gd_directorio_activo"]= $reg["directorio"]; //directorio activo del usuario es decir donde este puede ingresar documentos.
	$_SESSION["gd_directorio_activo_raiz"]= $reg["dir_act_raiz"]; //almacena el nombre del directorio activo del usuario
	$_SESSION["gd_tipo_usuario"]= $reg["tipo"];//indica el tipo de usuario 1=nacional, 2 =Zonal, 3=distrital
	$_SESSION["gd_n_usuario"]= utf8_encode($reg["nombre"]);
	$_SESSION["gd_rol_usuario"]= $reg["nomb_rol"];
	$_SESSION["gd_rol"]= $reg["rol"];
	$_SESSION["gd_nform"]= 1;
	header ("Location: sistema.php");
}
else{
echo "<script type=''>
	alert('Datos Incorrectos');
	window.location='index.php';  
</script>";
}
?>
