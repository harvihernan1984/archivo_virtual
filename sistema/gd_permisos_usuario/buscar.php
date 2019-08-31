<?php
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "Por favor inicie sesion"; return false;}
//consulta todos los empleados

$efecto_resaltar_fila="onMouseOver="."this.style.backgroundColor='#999999';"." onMouseOut="."this.style.backgroundColor='#f0f0f0';";
$filtro=$_GET["filtro"];
$campos[0]="gd_zona.nombre";
$campos[1]="gd_dt.nombre";
$campos[2]="gd_uo.nombre";
$campos[3]="gd_bo.nombre";
$filtro=str_ireplace("|","%",$filtro);
//echo $filtro;
if($filtro!=""){$filtro=" where upper(".f_concatena($campos,4).") like upper('%".$filtro."%')";}

?>
<style>
.mitable {
    border:2px solid;
    padding:10px 40px; 
    width:300px;
    resize:both;
    overflow:auto;
}

</style>
<table  id='tabla' width='963' align='left' >
<tr class='encabezado' bgcolor="#006666" >
  	<td valign='top' align='left' width='50'>CODIGO</td>
	<td valign='top' align='left' width='70'>ZONA</td>
	<td valign='top' align='left' width='70'>DISTRITO</td>
	<td valign='top' align='left' width='150'>UNIDAD OPERATIVA</td>
	<td valign='top' align='left' width='150'>ARCHIVO (UBICACION)</td>
</tr>
<?php
$sql="SELECT gd_bo.codigo, gd_zona.nombre as nombre_zona,gd_dt.nombre as nombre_distrito,gd_uo.nombre as nombre_uo,gd_bo.nombre  
  FROM gd_bodega gd_bo inner join gd_zona on gd_zona.codigo=gd_bo.zona
  inner join gd_distrito gd_dt on gd_zona.codigo=gd_dt.zona and gd_dt.codigo=gd_bo.distrito
  inner join gd_unidad_operativa gd_uo on gd_uo.zona=gd_zona.codigo and gd_dt.codigo=gd_uo.distrito and gd_uo.codigo=gd_bo.unidad_operativa ".$filtro." order by gd_bo.nombre limit 150; ";
$res=pg_query($conn,$sql);
while ($reg=pg_fetch_array($res))
{ ?>
    <tr class='registros'onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#f0f0f0';" ondblclick="res_busca(<?php echo $reg['codigo'] ?>,'')">
	<td width='50' align='left' valign='top' ><?php echo $reg['codigo']?> </td>
  	<td width='70' align='left' valign='top' ><?php echo $reg['nombre_zona']?> </td>
	<td width='70' align='left' valign='top' ><?php echo $reg['nombre_distrito']?> </td>
	<td width='150' align='left' valign='top' ><?php echo $reg['nombre_uo']?> </td>
	<td width='150' align='left' valign='top' ><?php echo $reg['nombre']?> </td>
</tr>
<?php }?>
</table>
			
			
