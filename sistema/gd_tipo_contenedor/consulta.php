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

$limite_reg="OFFSET (".$_POST["txt_pagina_act"] ." -1) * (".$_POST["limite_reg"].") limit  ". $_POST["limite_reg"];

$sql="SELECT (count(*) /  ".$_POST["limite_reg"]." ) + 1 as total_paginas  FROM gd_tipo_contenedor where codigo<>'-1' and 
codigo in(select cod from sis_accesos_rol_usuario ('".$_SESSION["gd_usuario"]."','gd_tipo_contenedor',''))  ".$filtro;

$res=pg_query( $conn,$sql);
$reg=pg_fetch_array($res);
$total_pg=$reg["total_paginas"];


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
height:20px;
}
.divgrid table thead > tr > th{ 
border-bottom:#CCCCCC dotted 1px;
border-right:#CCCCCC dotted 1px;
font-size:9px;
height:20px;
background:#999999;
}
.divgrid table tbody > tr:hover {
background:#CDCDCD;
}
</style>
<div class="divgrid"   >
<table width="1000" border="0" cellpadding="0" cellspacing="0"   id="tabla_opciones"   >
			<thead>
		    <tr id="fila_op_titulo"  >
		  <th width="28"  >E</th>
		  <th width="28"  >B </th>
          <th width="38"  ># </th>
		  <th width="86"  >CODIGO</th>
		  <th width="138"  >NOMBRE</th>
		  <th width="200" >IMAGEN</th>
		  <th width="150" >HIJOS</th>
		  <th width="100" >BORRABLE</th>
          <th width="100" >TIPO EMPRESA</th>
          <th width="100" >EMPRESA PADRE</th>
  	    </tr>
			</thead>
			<tbody>
		<?php 
		$sql="SELECT * FROM gd_tipo_contenedor where codigo<>'-1' and codigo in(select cod from sis_accesos_rol_usuario ('".$_SESSION["gd_usuario"]."','gd_tipo_contenedor',''))  ".$filtro." order by nombre ".$limite_reg;
		//echo $sql;
		$num_reg=0;
		$res=pg_query( $conn,$sql);
		while ($fila = pg_fetch_array($res)) {$num_reg++;
		?>
		<tr id="fila_op" class="fila_tabla"    >
		<td  width="28" >
		<a id="cmd_edit" onclick="editar('<?php echo $fila["codigo"]; ?>')"  href="javascript:void(0)" >
			<div class="action_edit" style="width:25px; height:25px;"></div>
		</a>
		</td>
		<td width="28" >
		<a id="cmd_delete" onclick="borrar()"  href="javascript:void(0)" >
			<div class="action_edit_remove" style="width:25px; height:25px;"></div>
		</a>
		</td>
        <td width="38" align="left" ><?php echo $num_reg; ?> </td>
		<td width="86" ><?php echo $fila["codigo"]; ?></td>
		<td width="138"  ><?php echo $fila["nombre"]; ?></td>
		<td width="200"  ><?php echo $fila["imagen"]; ?></td>
		<td width="150" ><?php echo $fila["hijos"]; ?></td>
		<td  width="100" ><?php echo $fila["borrable"]; ?></td>	
        <td  width="100" ><?php echo $fila["tipo_empresa"]; ?></td>
        <td  width="100" ><?php echo $fila["empresa_padre"]; ?></td>
		</tr>
		<?php }//for($i=1;$i<=20;$i++){ ?>
		</tbody>
  </table>	
  <script>$("#txt_paginas").html(<?php echo "'".$_POST["txt_pagina_act"]." de ".$total_pg."'" ; ?>);$("#txt_total_pagina").attr('value','<?php echo $total_pg; ?>');</script>
 </div>

