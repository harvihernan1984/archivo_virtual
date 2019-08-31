<?php
//require_once("../../conexion.php");
//consulta todos los empleados
$filtro=$_POST["filtro_busca"];
//echo $filtro;
$noacmitido = array("insert", "into", "delete", "update","'");
$filtro = str_replace($noacmitido, "", $filtro);

$orden=$_GET["orden"];
if($orden==""){$orden="direc";}
$campos[0]="direc";

$empresa=$_POST["empresa"];
$dir_empresa=$empresa;
if($empresa!='-1'){	
	$sql="select directorio from gd_empresa where borrado='N' and codigo='".$empresa."'";
	$res=pg_query($conn,$sql);
	$reg=pg_fetch_array($res);
	$dir_empresa=$reg["directorio"];
}
if($filtro!=""){$filtro=" and upper(direc) like upper('%".$filtro."%')";}
?>
<input type="hidden" name="orden" id="orden" value="<?php echo $orden ?>" />
<div class="divgrid"   >
<table id='tabla' width='732' align='left' >
<thead>
		    <tr id="fila_op_titulo"  >
            <th >ITEM</th>
		  <th >CODIGO</th>
		  <th   >NOMBRE d </th>
  	    </tr>
			</thead>
			<tbody>

<?PHP $sql="select * from get_directorio_padre_all('".$dir_empresa."') where rtipo ='FO' ".$filtro." order by ".$orden." limit 150; ";
//echo $sql;
$i=0;
$res=pg_query($conn,$sql);
while ($reg=pg_fetch_array($res))
{ 
?> <tr class='registros' ondblclick="res_busca_folder('<?php echo $reg['codi'];?>')">
	<td width='73' align='right' valign='top' > <?php echo $i++;?> </td>
    <td width='73' align='right' valign='top' > <?php echo $reg['codi'];?> </td>
	<td align='left' valign='top' > <?php echo $reg['direc'];?> </td>
  	</tr>
<?php } ?>
</tbody>
</table>
 </div>
