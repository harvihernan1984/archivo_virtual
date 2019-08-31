<?php
//require_once("../../conexion.php");
//consulta todos los empleados
$filtro=$_POST["filtro_busca"];
$noacmitido = array("insert", "into", "delete", "update");
$filtro = str_replace($noacmitido, "", $filtro);

$orden=$_GET["orden"];
if($orden==""){$orden="direc";}
$campos[0]="direc";
$empresa=$_POST["empresa"];
$sql="select directorio from gd_empresa where codigo='".$empresa."'";
$res=pg_query($conn,$sql);
$reg=pg_fetch_array($res);
$dir_empresa=$reg["directorio"];

if($filtro!=""){$filtro=" where upper(".f_concatena($campos,1).") like upper('%".$filtro."%')";}
?>
<input type="hidden" name="orden" id="orden" value="<?php echo $orden ?>" />
<div class="divgrid"   >
<table id='tabla' width='732' align='left' >
<thead>
<tr id="fila_op_titulo"  >
		  <th >CODIGO</th>
		  <th   >NOMBRE </th>
  	    </tr>
  </thead>
			<tbody>
<?PHP $sql="select * from get_directorio_padre('".$dir_empresa."') ".$filtro." order by ".$orden." limit 150; ";
//echo $sql;
$res=pg_query($conn,$sql);
while ($reg=pg_fetch_array($res))
{ 
?> <tr ondblclick="res_busca_directorio('<?php echo $reg['codi'];?>')">
	<td width='73' align='left' valign='top' > <?php echo $reg['codi'];?> </td>
	<td align='left' valign='top' > <?php echo $reg['direc'];?> </td>
  	</tr>
<?php } ?>
</tbody>
</table>
 </div>