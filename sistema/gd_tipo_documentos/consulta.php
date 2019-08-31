<?php //require_once("../../conexion.php"); 
$txt_filtro=$_POST["txt_buscar"];
$tipo_filtro=$_POST["tipo_filtro"];
$txt_filtro=f_sin_sql($txt_filtro);
unset($campos);
$campos=explode(",",$tipo_filtro);
$filtro="";
	//$filtro=f_genera_filtro($direc,$codigo," and ");
	//$filtro=" AND UPPER(CONCAT(".$tipo_filtro.")) LIKE '%".$txt_filtro."%'";
if($txt_filtro!=""){$filtro=" and upper(".f_concatena($campos).") like upper('%".$txt_filtro."%')";}

$limite_reg=$_POST["limite_reg"];
?>
<style>
.divgrid{ width:99%; height:99%; overflow:auto;}
.divgrid table{
	 border:#CCCCCC dotted 1px;
}
.divgrid  table  tbody > tr > td{
border-bottom:#CCCCCC dotted 1px;
border-right:#CCCCCC dotted 1px;
font-size:9px;
height:18px;
}
.divgrid table thead > tr > th{ 
border-bottom:#CCCCCC dotted 1px;
border-right:#CCCCCC dotted 1px;
font-size:9px;
height:18px;
background:#999999;
}
.divgrid table tbody > tr:hover {
background:#CDCDCD;
}
</style>
<div class="divgrid"   >
<table width="1000" border="0" cellpadding="0" cellspacing="0"   >
			<thead>
		    <tr id="fila_op_titulo"  >
		  <th width="26"  >E</th>
          <th width="46"  ># </th>
		  <th width="58"  >CODIGO</th>
		  <th width="278"  >NOMBRE</th>
		  <th width="564" >CAMPOS</th>
		  </tr>
			</thead>
			<tbody>
		<?php 
		$sql="SELECT *,ARRAY(select nombre from gd_atributos_documento where borrado='N' and tipo_documento=gd_tipo_documento.codigo order by orden) as campos 
		FROM gd_tipo_documento where codigo in(select cod from sis_accesos_rol_usuario ('".$_SESSION["gd_usuario"]."','gd_tipo_documento',''))  ".$filtro." order by nombre ".$limite_reg;
		//echo $sql;
		$num_reg=0;
		$res=pg_query( $conn,$sql);
		while ($fila = pg_fetch_array($res)) {$num_reg++;
		?>
		<tr  class="fila_tabla"    >
		<td  width="26" >
		<a id="cmd_edit" onclick="editar('<?php echo $fila["codigo"]; ?>')"  href="javascript:void(0)" >
			<div class="action_edit" style="width:25px; height:25px;"></div>
		</a>		</td>
        <td width="46" align="left" ><?php echo $num_reg; ?> </td>
		<td width="58" ><?php echo $fila["codigo"]; ?></td>
		<td width="278"  ><?php echo $fila["nombre"]; ?></td>
		<td width="564"  ><?php echo  utf8_decode(str_ireplace('"','',$fila["campos"]));?></td>
		</tr>
		<?php }//for($i=1;$i<=20;$i++){ ?>
		</tbody>
  </table>	
</div>

