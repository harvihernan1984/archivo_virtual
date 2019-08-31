<?php
require_once("../../valida.php");
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "<script type=''> alert('Por favor inicie sesion');	window.location='../vacio.php';</script>"; return false;}
$row=0;
if (isset($_POST["codigo"])) //actualizar registro
{	$sql="delete from persona where codigo='".$_POST["codigo"]."';";
	$res= pg_query($conn,$sql);
	$row=pg_affected_rows($res);
	if($row==0){echo "El registro no puede ser borrado.. \nMantine relacion con otros registros!"; return false;}
}
echo "ok";

?>