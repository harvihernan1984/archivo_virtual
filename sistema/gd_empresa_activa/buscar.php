<?php
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "Por favor inicie sesion"; return false;}
//consulta todos los empleados

$efecto_resaltar_fila="onMouseOver="."this.style.backgroundColor='#999999';"." onMouseOut="."this.style.backgroundColor='#f0f0f0';";
$filtro=$_GET["filtro"];
$campos[0]="nombre";
$campos[1]=" (select nombre from zona where codigo=distrito.zona) ";
if($filtro!=""){$filtro=" where upper(".f_concatena($campos,2).") like upper('%".$filtro."%')";}
?>
<table id='tabla' width='811' align='left' >
<tr class='encabezado' >
  	<td valign='top' align='left' width='66'>CODIGO</td>
	<td valign='top' align='left' width='477'>NOMBRE</td>
	<td valign='top' align='left' width='252'>ZONA</td>
</tr>
<?php
$sql="SELECT codigo, nombre,(select nombre from zona where codigo=distrito.zona) as zona from distrito ".$filtro." order by nombre limit 150; ";
$res=pg_query($conn,$sql);
while ($reg=pg_fetch_array($res))
{ ?>
    <tr class='registros'onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#f0f0f0';" ondblclick="res_busca(<?php echo $reg['codigo'] ?>,'')">
	<td width='66' align='left' valign='top' ><?php echo $reg['codigo']?> </td>
  	<td width='200' align='left' valign='top' ><?php echo $reg['nombre']?> </td>
	<td width='252' align='left' valign='top' ><?php echo $reg['zona']?> </td>
	
</tr>
<?php }?>
</table>
			
			
