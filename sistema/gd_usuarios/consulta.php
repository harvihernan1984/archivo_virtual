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

$sql="select (count( us.*) /  ".$_POST["limite_reg"]." ) + 1 as total_paginas	 from sis_usuario us inner join gd_persona pe on us.persona=pe.codigo 
where us.codigo in(select cod from sis_accesos_rol_usuario ('".$_SESSION["gd_usuario"]."','sis_usuario',''))  ".$filtro;
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
		  <th width="26"  >E</th>
          <th width="50"  ># </th>
		  <th width="74"  >CODIGO</th>
		  <th width="300"  >NOMBRE FUNCIONARIO</th>
		  <th width="120" >NOMBRE USUARIO</th>
          <th width="300" >EMPRESA</th>
          <th width="60" >ESTADO</th>
		  </tr>
			</thead>
			<tbody>
		<?php 
		$sql="select us.codigo, us.nombre as usuario, pe.apellido || ' ' || pe.nombre  as nombre , us.estado,
        coalesce((select nombre from gd_empresa where codigo=us.empresa),'') as nombre_empresa 
        from sis_usuario us inner join gd_persona pe on us.persona=pe.codigo 
		where us.codigo in(select cod from sis_accesos_rol_usuario ('".$_SESSION["gd_usuario"]."','sis_usuario','')) 
        ".$filtro." order by  nombre ".$limite_reg;
		//echo $sql;
		$num_reg=0;
		$res=pg_query( $conn,$sql);
		while ($fila = pg_fetch_array($res)) {$num_reg++;
		?>
		<tr id="fila_op" class="fila_tabla"    >
		<td  width="26" >
		<a id="cmd_edit" onclick="editar('<?php echo $fila["codigo"]; ?>')"  href="javascript:void(0)" >
			<div class="action_edit" style="width:25px; height:25px;"></div>
		</a>		</td>
        <td width="50" align="left" ><?php echo $num_reg; ?> </td>
		<td width="74" ><?php echo $fila["codigo"]; ?></td>
		<td width="300"  ><?php echo $fila["nombre"]; ?></td>
		<td width="120"  ><?php echo $fila["usuario"]; ?></td>
        <td width="300"  ><?php echo $fila["nombre_empresa"]; ?></td>
        <td width="60"  ><?php if($fila["estado"]=='1'){echo "Activo";}else{echo "Inactivo";} ?></td>
		</tr>
		<?php }//for($i=1;$i<=20;$i++){ ?>
		</tbody>
  </table>	
  <script>$("#txt_paginas").html(<?php echo "'".$_POST["txt_pagina_act"]." de ".$total_pg."'" ; ?>);$("#txt_total_pagina").attr('value','<?php echo $total_pg; ?>');</script>
</div>

