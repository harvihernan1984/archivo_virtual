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
<table width="100%" border="0" cellpadding="0" cellspacing="0"   id="tabla_opciones"   >
			<thead>
		    <tr id="fila_op_titulo"  >
		  <th width="28"  >E</th>
          <th width="28"  >B</th>
          <th width="38"  ># </th>
		  <th width="75"  >RUC</th>
		  <th width="219"  >NOMBRE</th>
		  <th width="111" >ABREVIATURA</th>
		  <th width="201" >DIRECCION</th>
		  <th width="300" >DIRECTORIO</th>
          <th width="40" >TIPO</th>
          <th width="40" >PADRE</th>
  	    </tr>
			</thead>
			<tbody>
		<?php 
         $muestra_borrar=f_valida_acceso_rol('gd_empresa_borra',$conn);
         
		$sql="SELECT gde.*,get_directorio(gde.directorio) as directorio,
        coalesce((select nombre from gd_tipo_contenedor where codigo=gde.tipo),'') as tipo_empresa, 
        coalesce((select nombre from gd_empresa where codigo=gde.empresa_padre ),'') as nombre_padre 
        FROM gd_empresa gde where codigo in(select cod from sis_accesos_rol_usuario ('".$_SESSION["gd_usuario"]."','gd_empresa',''))
        and editable='S' and borrado='N'  ".$filtro." order by nombre ".$limite_reg;
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
         <?php if($muestra_borrar==true){ ?>
		<a id="cmd_delete" onclick="borra_empresa('<?php echo $fila["codigo"]; ?>')" href="javascript:void(0)" >
			<div class="action_edit_remove" style="width:25px; height:25px;"></div>
		</a>
         <?php }// fin if($muestra_borrar==true){ ?>
		</td>
       
        <td width="38" align="left" ><?php echo $num_reg; ?> </td>
		<td width="75" ><?php echo $fila["ruc"]; ?></td>
		<td width="219"  ><?php echo $fila["nombre"]; ?></td>
		<td width="111"  ><?php echo $fila["nomenclatura"]; ?></td>
		<td width="201" ><?php echo $fila["direccion"]; ?></td>
		<td  width="300" ><?php echo $fila["directorio"]; ?></td>
        <td  width="40" ><?php echo $fila["tipo_empresa"]; ?></td>	
        <td  width="40" ><?php echo $fila["nombre_padre"]; ?></td>	
		</tr>
		<?php }//for($i=1;$i<=20;$i++){ ?>
		</tbody>
  </table>	
 </div>

