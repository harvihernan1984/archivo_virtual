<?php //require_once("../../conexion.php"); 
$txt_filtro=$_POST["txt_buscar"];
$tipo_filtro=$_POST["tipo_filtro"];
$tipo_documentos=$_POST["tipo_documentos"];
$txt_filtro=f_sin_sql($txt_filtro);
unset($campos);
$campos=explode(",",$tipo_filtro);
$filtro="";
	//$filtro=f_genera_filtro($direc,$codigo," and ");
	//$filtro=" AND UPPER(CONCAT(".$tipo_filtro.")) LIKE '%".$txt_filtro."%'";
if($txt_filtro!=""){$filtro=" and upper(".f_concatena($campos).") like upper('%".$txt_filtro."%')";}

$limite_reg="OFFSET (".$_POST["txt_pagina_act"] ." -1) * (".$_POST["limite_reg"].") limit  ". $_POST["limite_reg"];

///FILTRO PARA TIPO DE DOCUMENTO
$filtro_x_tipo="";
if($tipo_documentos!='-1'){$filtro_x_tipo=" and tipo='".$tipo_documentos."'";}
$filtro=$filtro_x_tipo.$filtro;

$sql="SELECT (count(*) /  ".$_POST["limite_reg"]." ) + 1 as total_paginas  FROM gd_documento where borrado='N'  ".$filtro;

$res=pg_query( $conn,$sql);
$reg=pg_fetch_array($res);
$total_pg=$reg["total_paginas"];
//echo $filtro;

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
		  <th width="27"  >E</th>
          <th width="35"  ># </th>
		  <th width="83"  >CODIGO</th>
		  <th width="131"  >ORIGEN</th>
		  <th width="118" >TIPO DE DOCUMENTO</th>
		  <th width="217" >UBICACION</th>
		  <th width="68" >ANEXOS</th>
		  <th width="294" >DATOS</th>
  	    </tr>
			</thead>
			<tbody>
		<?php 
		$sql="select
        tb.codigo,
        get_directorio_documento(tb.contenedor) as directorio,
        tb.origen,
        tb.codificacion,
        (select nombre from gd_tipo_documento where codigo=tb.tipo) as nombre_tipo,
        gd_get_datos_documentos_campos(tb.datos_documento,tb.tipo) as datos,contenedor,
        (select count(*) FROM gd_documento_anexo where documento=tb.codigo and borrado='N') as cantidad_anexos
        from
        	(SELECT codigo,origen,tipo,datos_documento,contenedor,codificacion
            from gd_documento where  borrado='N' ".$filtro."  order by  origen ".$limite_reg.") tb  
        ";
		//echo $sql;
		$num_reg=0;
		$res=pg_query( $conn,$sql);
		while ($fila = pg_fetch_array($res)) {$num_reg++;
		?>
		<tr id="fila_op" class="fila_tabla"    >
		<td  width="27" >
		<a id="cmd_edit" title="Abrir formulario del Documento" onclick="editar_busqueda('<?php echo $fila["codigo"]; ?>','<?php echo $fila["contenedor"]; ?>')"  href="javascript:void(0)" >
			<div class="action_playlist" style="width:36px; height:36px;"></div>
		</a>
		</td>
		<td width="35" align="left" ><?php echo $num_reg; ?> </td>
		<td width="83" ><?php echo $fila["codigo"]; ?></td>
		<td width="131"  ><?php echo utf8_decode(utf8_decode($fila["origen"])); ?></td>
		<td width="118"  ><?php echo utf8_decode($fila["nombre_tipo"]); ?></td>
		<td width="217" ><?php echo utf8_decode($fila["directorio"]); ?></td>
		<td  width="68" ><?php echo utf8_decode($fila["cantidad_anexos"]); ?></td>	
		<td  width="294" ><?php echo $fila["datos"]; ?></td>	
		</tr>
		<?php }//for($i=1;$i<=20;$i++){ ?>
		</tbody>
  </table>	
  <script>$("#txt_paginas").html(<?php echo "'".$_POST["txt_pagina_act"]." de ".$total_pg."'" ; ?>);$("#txt_total_pagina").attr('value','<?php echo $total_pg; ?>');</script>
 </div>

