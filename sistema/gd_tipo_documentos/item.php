<?php 
require_once("conexion.php");
	$codigo="";
	$item="";
	$dispensario="";
	$nombre="";
	$cedula="";
	$direccion="";
	$telefono="";
	$fecha_nac="";
	$historia_clinica="";
	$organizacion="";
// fin definicion variables
$evento=$_POST["evento_windows"];
$item=$_POST["item_windows"];
if($evento=='EDIT'){
	$codigo=$item;
	$sql="select * from gd_tipo_documento where codigo='".$codigo."'  ";
	//echo $sql;
	$res=pg_query($conn,$sql);
	//if(pg_num_rows($res)!=0){ 
	if($reg=pg_fetch_array($res)){;
		//$res=mysql_query($sql, $Conn);
		//if($fila = mysql_fetch_array($res, MYSQL_ASSOC)){
				$codigo=$reg["codigo"];
			$nombre=$reg["nombre"];
			$abreviatura=$reg["abreviatura"];
	}
}
	

?>
<style>
.divgrid{ width:99%; height:99%; overflow:auto;}
.divgrid table{
	 border:#CCCCCC dotted 1px;
}
.divgrid table input{
	 border:none; height:18px; font-size:9px;
}
.divgrid table select{
	 border:none; height:18px; font-size:9px; width:99%;
}
.divgrid  table  tbody > tr > td{
border-bottom:#CCCCCC dotted 1px;
border-right:#CCCCCC dotted 1px;
font-size:9px;
height:14px;
}
.divgrid table thead > tr > th{ 
border-bottom:#CCCCCC dotted 1px;
border-right:#CCCCCC dotted 1px;
font-size:9px;
height:14px;
background:#999999;
}
.divgrid table tbody > tr:hover {
background:#CDCDCD;
}
.divgrid2{ border:#CCCCCC dotted 1px; }

.divgrid2  input{
	 border:#CCCCCC dotted 1px; height:18px; font-size:9px;
}
.divgrid2  select{
	 border:#CCCCCC dotted 1px;height:24px; font-size:9px; width:99%;
}
.divgrid2  td{
border:#CCCCCC dotted 1px;
font-size:9px;
height:14px;
}
.img_boton{
	background-color:#EAEAEA;
	height:14px;
	width:14px;
}
.img_boton:hover {
	background-color:#999999;
}
</style>

<table width="100%"  border="0" cellspacing="0" cellpadding="0" id='tabla'>
  <tr  class="divgrid2">
	  <td width="99"  align="right">Codigo :</td>
	  <td colspan="3" align="left" >
	  	<input type="text" disabled="disabled" name="cod" id="cod" size="10" value="<?php echo $codigo; ?>" /> 		  </td>
  </tr>
  <tr  class="divdatos_form">
	  <td  align="right">Nombre :</td>
	  <td colspan="3" align="left" >
	  <input type="text" name="nombre" id="nombre" maxlength="150" class="txttextoma" value="<?php echo $nombre; ?>" /> </td>
  </tr>
  
  <tr  class="divdatos_form">
    <td  align="right">Abreviatura</td>
    <td colspan="3" align="left" >
	 <input type="text"  name="abreviatura" id="abreviatura" class="txttextoma" maxlength="5"  value="<?php echo $abreviatura; ?>" />
	</td>
  </tr>
  <tr>
    <td colspan="3"  align="center" style="background:#0000CC; color:#FFFFFF;"><strong>ATRIBUTOS</strong></td>
    <td  align="center" style="background:#0000CC; color:#FFFFFF;">
	<a id="cmd_buscar_esta" href='javascript:void(0)' title='Agregar' onClick="addfila_val_item('fila_op');">
			<img src='<?php echo $directorio; ?>/img/botones/edit_add.png' width='20' height='20'  style=" background:#EAEAEA;"
			onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';">	</a>	</td>
  </tr>
  <tr>
	  <td colspan="4"  align="center">
	  <div class="divgrid"   >
   <table id="tabla_opciones" border="0" cellpadding="0" cellspacing="0" width="100%" >
   		<tr id="fila_op_titulo" class="fila_tabla" style="background:#009966" >
		  <td height="20" class="item_tabla">NOMBRE ATRIBUTO</td>
		  <td height="20" class="item_tabla" align="center">Forzar</td>
		  <td width="54" height="20" align="center" class="item_tabla">Orden</td>
			  <td height="20" class="item_tabla">Datos</td>
			  <td class="item_tabla" align="center" > </td>
		  <td class="item_tabla" align="center" > </td>
		</tr>
		<tr id="fila_op" class="fila_tabla" style="height:0px; display:none;" >
		  <td height="20" class="item_tabla"> 
		  <input  class="txttextoma"  name='nombre_val' id='nombre_val' type='text' maxlength='100'  style="width:100%" value='' >
		  <input type="hidden" name='codigo_val' id='codigo_val' value='' >		  </td>
		  <td  class="item_tabla"> 
		 <select  name='obligatorio_val'   id='obligatorio_val' style="width:40px;">
		  <?php $sql="select codigo,nombre from sis_configuracion where tipo='S_N'";
			$res2=pg_query($conn,$sql);
			while ($reg2=pg_fetch_array($res2))
			{ ?>
      			<option value="<?php echo $reg2["codigo"];?>" ><?php echo $reg2["nombre"];?> </option>
      		<?php } ?>
		 </select>		 </td>
		  <td  class="item_tabla" align="center">
		  <input   name='orden_val' id='orden_val' type='text' maxlength='3' size='5' value=''  >
		  </td>
		  <td  class="item_tabla">
		   <select name='tipo_dato_val' id='tipo_dato_val' style="width:90px;">
            <?php $sql="select codigo,nombre from sis_configuracion where tipo='TP_DATOS'";
			$res2=pg_query($conn,$sql);
			while ($reg2=pg_fetch_array($res2))
			{ ?>
      			<option value="<?php echo $reg2["codigo"];?>" ><?php echo $reg2["nombre"];?> </option>
      		<?php } ?>
		 </select>
		  </td>
		  <td class="item_tabla" align="center" >
		  <a id="cmd_guarda_val_item" href='javascript:void(0)' title='Guardar' onClick="guardar_val_item(this.id);">
			<img src='/img/botones/guardar.png' class="img_boton"></a>		  </td>
		  <td class="item_tabla" align="center" >
		  <a id="cmd_borra_val_item" href='javascript:void(0)' title='Borrar' onclick="borra_val_item(this.id)" >
			<img src='img/eliminar.png' class="img_boton"></a>		  </td>
		  </tr>
		<?php 
		
		$sql="SELECT * FROM gd_atributos_documento where  borrado='N' and   tipo_documento='".$codigo."' order by orden";
		$res=pg_query($conn,$sql);
		$i=0;
		while ($reg=pg_fetch_array($res)) 
		{$i++; ?>
		
		<tr id="fila_op<?php echo $i; ?>" class="fila_tabla" >
		  <td width="711" height="20" class="item_tabla">
		  <input  class="txttextoma"  name='nombre_val' id='nombre_val'type='text'maxlength='100' style="width:100%"  
		  value='<?php echo utf8_decode($reg["nombre"]);?>' >
		  <input type="hidden" name='codigo_val' id='codigo_val' value='<?php echo $reg["codigo"];?>' >		  </td>
		  <td width="90" height="20" class="item_tabla">
		  	<select name='obligatorio_val' id='obligatorio_val' style="width:40px;">
            <?php $sql="select codigo,nombre from sis_configuracion where tipo='S_N'";
			$res2=pg_query($conn,$sql);
			while ($reg2=pg_fetch_array($res2))
			{ ?>
      			<option <?php if($reg2["codigo"]==$reg["obligatorio"]) { echo "selected='selected'";}?> 
            	value="<?php echo $reg2["codigo"];?>" ><?php echo $reg2["nombre"];?> </option>
      		<?php } ?>
		 	</select>		  </td>
			<td  class="item_tabla" align="center">
		  <input   name='orden_val' id='orden_val' type='text' maxlength='3' size='5' value='<?php echo $reg["orden"];?>' >
		  </td>
			<td width="90" height="20" class="item_tabla">
			<select name='tipo_dato_val' id='tipo_dato_val' style="width:90px;">
            <?php $sql="select codigo,nombre from sis_configuracion where tipo='TP_DATOS'";
			$res2=pg_query($conn,$sql);
			while ($reg2=pg_fetch_array($res2))
			{ ?>
      			<option <?php if($reg2["codigo"]==$reg["tipo_dato"]) { echo "selected='selected'";}?> 
            	value="<?php echo $reg2["codigo"];?>" ><?php echo $reg2["nombre"];?> </option>
      		<?php } ?>
		 	</select>
			</td>
			<td class="item_tabla" align="center" width="39" >
			<a id="cmd_guarda_val_item<?php echo $i; ?>" href='javascript:void(0)' title='Guardar' onClick="guardar_val_item(this.id);">
			<img src='img/botones/guardar.png' class="img_boton">			</a></td>
		    <td class="item_tabla" align="center" width="39" >
			<a id="cmd_borra_val_item<?php echo $i; ?>" href='javascript:void(0)' title='Borrar' onclick="borra_val_item(this.id)" >
			<img src='img/eliminar.png' class="img_boton"></a></td>
		</tr>
		<?php } ?>
    </table>
	</div>	  </td>
  </tr>
  <tr>
	  <td  align="right"></td>
	  <td colspan="3" align="left" >
	  <input type="hidden" name='num_op' id='num_op' value=<?php echo $i;?> > </td>
  </tr>
  
<tr>
	<td><input name="codigo" id="codigo" type="hidden" value="<?php echo $codigo; ?>" /></td>
	<td width="207"></td>
	<td width="119"></td>
	<td width="65"></td>
</tr>
</table>



