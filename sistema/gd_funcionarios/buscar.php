<?php
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "Por favor inicie sesion"; return false;}
//consulta todos los empleados
$filtro=$_GET["filtro"];
$noacmitido = array("insert", "into", "delete", "update");
$filtro = str_replace($noacmitido, "", $filtro);

$orden=$_GET["orden"];
if($orden==""){$orden="apellido, nombre";}
$campos[0]="apellido";
$campos[1]="nombre";
$campos[2]="cedula";


if($filtro!=""){$filtro=" and upper(".f_concatena($campos,3).") like upper('%".$filtro."%')";}
?>
<table id='tabla' width='732' align='left' >
<tr class='encabezado' >
	<td valign='top' align='left' width='73' >CODIGO</td>
	<td valign='top' align='left' width='69' >CEDULA</td>
	<td valign='top' align='left' width='313'>NOMBRE</td>
	<td valign='top' align='left' width='257'>DIRECCION</td>
</tr>
<?PHP $sql="SELECT * from persona where 
(empresa is null OR coalesce(empresa,'')='".$_SESSION["empresa_act"]."' OR '".$_SESSION["rol_usuario"]."'='1')".$filtro." order by ".$orden." limit 150; ";
//echo $sql;
$res=pg_query($conn,$sql);
while ($reg=pg_fetch_array($res))
{ 
?> <tr class='registros' onMouseOver="this.style.backgroundColor='#999999'; this.style.cursor='pointer';" 
onMouseOut="this.style.backgroundColor='#f0f0f0';this.style.cursor='default';" ondblclick="res_busca(<?php echo $reg['codigo'];?>,'')">
	<td width='73' align='left' valign='top' > <?php echo $reg['codigo'];?> </td>
	<td width='69' align='left' valign='top' > <?php echo $reg['cedula'];?> </td>
  	<td width='313' align='left' valign='top' > <?php echo $reg['apellido']." ".$reg['nombre'];?> </td>
	<td width='257' align='left' valign='top' > <?php echo $reg['direccion'];?> </td>
</tr>
<?php } ?>
</table>
			
			
