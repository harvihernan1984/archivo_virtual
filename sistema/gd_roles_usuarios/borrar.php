<?php
require_once("../../valida.php");
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "<script type=''> alert('Por favor inicie sesion');	</script>"; return false;}
$row=0;
if (isset($_POST["codigo"])) //actualizar registro
{	$sql="delete from usuario where codigo='".$_POST["codigo"]."';";
	if(!$res= pg_query($conn,$sql)){return false;}
	$row=pg_affected_rows($res);
	if($row==0){echo "El registro no puede ser borrado.. \nMantine relacion con otros registros!"; return false;}
}
echo "ok";

?>