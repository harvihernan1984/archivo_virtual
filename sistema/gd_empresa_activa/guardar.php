<?php
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "Por favor inicie sesion"; return false;}

$empresa=$_POST["empresa"];
$periodo=$_POST["periodo"];
$sql="UPDATE usuario SET empresa_act='".$empresa."', periodo_act='".$periodo."' where codigo='".$_SESSION["usuario"]."' " ;
//echo f_genera_parametros("reg_modulos",$campos,$valores,4);
$_SESSION["empresa_act"]=$empresa;
$_SESSION["periodo_act"]=$periodo;
$res=pg_query($conn,$sql);
$sql="select nombre from atf_empresa where codigo='".$empresa."'";
$res=pg_query($conn,$sql);
//if(!){echo "Error"; return false;}
$reg=pg_fetch_array($res);
$nomb_empresa=$reg["nombre"];
$_SESSION["nombre_empresa_act"]=$nomb_empresa;
echo "
<script type=''>
	$('#empresa_actual').html('Empresa Actual : ".$nomb_empresa."');
	mensage('Datos Almacenados');
</script>
";

?>