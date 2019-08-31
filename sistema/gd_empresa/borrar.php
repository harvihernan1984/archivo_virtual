<?php
if(ValidaUsuario()==false){echo "<script>mensaje('Por favor inicie sesion');</script>"; return false;}
$codigo=$_POST["item_contenido"];
$modulo=$_POST["opcion_contenido"];
$sql="update gd_empresa set borrado='S' where codigo='".$codigo."'";
$campos[0]="codigo=".$codigo;
$campos[2]="gd_usuario=secion";
$campos[1]="modulo=".$modulo;
$sql="select * from ".f_genera_parametros_v("gd_borra_empresa",$campos);
$res=pg_query($conn,$sql);
$reg=pg_fetch_array($res);
$cerrar_ventana="$('#principal_windows').window('close');";
if($reg["res"]=='DELETE'){$msg="Registro borrado Correctammente";}
else{$cerrar_ventana="";$msg=$reg["res"];}                     
echo "<script>mensaje('".$msg."');MuestraDatos_contenido();</script>";

?>