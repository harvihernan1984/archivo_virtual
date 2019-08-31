<?php
if(ValidaUsuario()==false){echo "<script type=''> mensaje('Por favor inicie sesion');</script>"; return false;}
if($_POST["clave"]!=$_POST["clave2"]){echo "Error: las claves son diferentes.!"; return false;}
$campos=explode(",","codigo,nombre,clave,clave3,persona");
$valores=explode(",","codigo,nombre,clave,clave3,persona");
$sql="select * from ".f_genera_parametros("sis_reg_usuario_clave",$campos,$valores,5);
$res=pg_query($conn,$sql);
$reg=pg_fetch_array($res);
if($reg["res"]=='UPDATE'){$msg="Registro actualizado Correctammente";}
else{$msg=$reg["res"];}
echo "<script>mensaje('".$msg."');MuestraDatos_contenido();</script>";

?>
