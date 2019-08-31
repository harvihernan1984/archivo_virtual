<?php
//require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "Por favor inicie sesion"; return false;}
//consulta todos los empleados
if($_GET["orden"]=="usuario"){
$filtro=$_GET["filtro"];
$noacmitido = array("insert", "into", "delete", "update");
$filtro = str_replace($noacmitido, "", $filtro);

$orden=$_GET["ordenado"];
if($orden==""){$orden="u.nombre";}
$campos[0]="u.nombre";
$campos[1]="p.apellido";
$campos[2]="p.nombre";


if($filtro!=""){$filtro=" and upper(".f_concatena($campos,3).") like upper('%".$filtro."%')";}
?>
<input type="hidden" name="ordenado" id="ordenado" value="<?php echo $orden ?>" />
<table id='tabla' width='864' align='left' >
<tr class='encabezado' >
	<td valign='top' align='left' width='91' >CODIGO</td>
	<td valign='top' align='left' width='180'>NOMBRE</td>
	<td valign='top' align='left' width='577'>RESPONSABLE</td>
</tr>
<?PHP $sql="SELECT u.codigo as codigo,u.nombre as nombre, p.apellido || ' ' || p.nombre as responsable 
		from usuario as u join persona as p on p.codigo=u.persona 
		where (u.empresa='".$_SESSION["empresa_act"]."' or 
		(select usuario from persona where codigo=(SELECT persona from usuario where codigo='".$_SESSION["usuario"]."'))='-1')  
		".$filtro." order by ".$orden." limit 150; ";
//echo $sql;
$res=pg_query($conn,$sql);
while ($reg=pg_fetch_array($res))
{ 
?> <tr class='registros' onMouseOver="this.style.backgroundColor='#999999'; this.style.cursor='pointer';" 
onMouseOut="this.style.backgroundColor='#f0f0f0';this.style.cursor='default';" ondblclick="res_busca(<?php echo $reg['codigo'];?>,'')">
	<td width='91' align='left' valign='top' > <?php echo $reg['codigo'];?> </td>
  	<td width='180' align='left' valign='top' > <?php echo $reg['nombre'];?> </td>
	<td width='577' align='left' valign='top' > <?php echo $reg['responsable'];?> </td>
</tr>
<?php } ?>
</table>
<?php } //fin if($_GET["orden"]=="activos")
else{
	if($_GET["orden"]=="persona"){
		include("buscar.php");
	}
}
?>				
			
