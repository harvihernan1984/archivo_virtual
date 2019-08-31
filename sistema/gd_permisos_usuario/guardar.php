<?php
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "Por favor inicie sesion"; return false;}
$campos=explode(",","codigo,usuario,empresa_act,nombre,descripcion,zona,distrito,unidad_operativa");
$valores=explode(",","codigo,secion,secion,nombre,descripcion,zona,distrito,unidad_operativa");
//echo f_genera_parametros("reg_modulos",$campos,$valores,6);
$sql="select * from ".f_genera_parametros("gd_reg_bodega",$campos,$valores,8);
$res=pg_query($conn,$sql);
//if(!){echo "Error"; return false;}
$reg=pg_fetch_array($res);
echo $reg["res"];

?>