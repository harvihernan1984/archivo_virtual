<?php
$opcion=$_POST["opcion_contenido"];
$evento=$_POST["evento_contenido"];
$item=$_POST["item_contenido"];
if(ValidaUsuario()==false){echo "<script type=''> alert('Por favor inicie sesion');</script>"; return false;}
//consulta todos los empleados

//muestra los datos consultados
//onSubmit='return validar()'

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
 <form id="form_windows" name="form_windows">
		<input type="hidden" id="opcion_windows" name="opcion_windows" value="<?php echo $opcion;?>"/>
		<input type="hidden" id="accion_windows" name="accion_windows" value=""/>
        <input type="hidden" id="evento_windows" name="evento_windows" value="<?php echo $evento;?>"/>
        <input type="hidden" id="item_windows" name="item_windows" value="<?php echo $item;?>"/>
		<input  type="hidden" id="alto_windows" name="alto_windows" value="500"/>
		<input  type="hidden" id="ancho_windows" name="ancho_windows" value="600"/>
<div class="divgrid"   >
<table width="90%" border="0" cellpadding="0" cellspacing="0"   id="tabla_opciones"   >
			<thead>
		    <tr id="fila_op_titulo"  >
		 		 <th width="50%"  >CONFIGURACION</th>
		  		<th width="50%"  >VALOR</th>
		    </tr>
			</thead>
			<tbody>
		<?php 
		$sql="SELECT codigo, nombre, valor, tipo FROM sis_configuracion where tipo='CONF' and codigo in(select cod from sis_accesos_rol_usuario ('".$_SESSION["gd_usuario"]."','sis_configuracion',''))  ";
		//echo $sql;
		$num_reg=0;
		$res=pg_query( $conn,$sql);
		while ($fila = pg_fetch_array($res)) {$num_reg++;
		?>
		<tr id="fila_op" class="fila_tabla"    >
		<td width="50%" align="right"><?php echo $fila["nombre"]; ?></td>
		<td width="50%"  align="left" >
		<input name='obj<?php echo  $fila["codigo"]; ?>' id='obj<?php echo $fila["codigo"]; ?>' type='text' maxlength='300'  style="width:98%;"  value='<?php echo $fila["valor"]; ?>' >
		</td>
		</tr>
		<?php }//for($i=1;$i<=20;$i++){ ?>
		</tbody>
  </table>	
</div>
</form>
 