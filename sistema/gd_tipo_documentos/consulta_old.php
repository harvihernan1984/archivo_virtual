<?php
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "Por favor inicie sesion"; return false;}
//consulta todos los empleados

//muestra los datos consultados
//onSubmit='return validar()'
//direc 0=cancelar o buscado, 1=primero, 2=anterior, 3=siguiente, 4=ultimo
$direc=$_GET["direc"];
if($_GET["codigo"]){$codigo=$_GET["codigo"];}
else{$codigo="";}
$filtro=f_genera_filtro($direc,$codigo," where ");
if($direc!="5"){
	$sql="SELECT * FROM gd_tipo_documento ".$filtro ;
	//echo $sql;
	$res=pg_query($conn,$sql);
	if ( $reg=pg_fetch_array($res))
	{ 	$codigo=$reg["codigo"];
		$nombre=$reg["nombre"];
	}
	else{if($direc=="2" ){echo "No hay mas registros"; return false;}
		if($direc=="3" ){echo "No hay mas registros"; return false;}
	}
}

?>
<table width="510"  class="Estilo_tabla" id='tabla'>
  <tr>
	  <td width="106"  align="right">Codigo :</td>
	  <td colspan="3" align="left" >
	  	<input type="text" disabled="disabled" name="cod" id="cod" size="10" value="<?php echo $codigo; ?>" /> 		  </td>
  </tr>
  <tr>
	  <td  align="right">Nombre :</td>
	  <td colspan="3" align="left" ><input type="text" name="nombre" id="nombre" maxlength="150" size="50" value="<?php echo $nombre; ?>" /> </td>
  </tr>
  
  <tr>
    <td  align="right">&nbsp;</td>
    <td colspan="3" align="left" ></td>
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
	  <div style="overflow:auto; height:250px;">
   <table id="tabla_opciones" border="0" cellpadding="0" cellspacing="0" width="476" >
   		<tr id="fila_op_titulo" class="fila_tabla" style="background:#009966" >
		  <td height="20" class="item_tabla">NOMBRE ATRIBUTO</td>
		  <td height="20" class="item_tabla" align="center">Forzar</td>
		  <td height="20" class="item_tabla" align="center">Orden</td>
			  <td height="20" class="item_tabla">Datos</td>
			  <td class="item_tabla" align="center" > </td>
		  <td class="item_tabla" align="center" > </td>
		</tr>
		<tr id="fila_op" class="fila_tabla" style="height:0px; display:none;" >
		  <td height="20" class="item_tabla"> 
		  <input class="txt_celda" name='nombre_val' id='nombre_val'type='text'maxlength='100' size='30' value='' >
		  <input type="hidden" name='codigo_val' id='codigo_val' value='' >		  </td>
		  <td  class="item_tabla"> 
		 <select name='obligatorio_val' id='obligatorio_val' style="width:40px;">
		 <option value="S">SI</option>
		 <option value="N">NO</option>
		 </select>		 </td>
		  <td  class="item_tabla" align="center">
		  <input class="txt_celda" name='orden_val' id='orden_val' type='text' maxlength='3' size='5' value='' >
		  </td>
		  <td  class="item_tabla">
		   <select name='tipo_dato_val' id='tipo_tipo_val' style="width:90px;">
		 <option value="TC">Texto Corto</option>
		 <option value="TL">Texto Largo</option>
		 <option value="FE">Fecha</option>
		 <option value="NU">Numero</option>
		 <option value="DE">Decimal</option>
		 </select>
		  </td>
		  <td class="item_tabla" align="center" >
		  <a id="cmd_guarda_val_item" href='javascript:void(0)' title='Guardar' onClick="guardar_val_item(this.id);">
			<img src='<?php echo $directorio; ?>/img/botones/guardar.png' width='14' height='14'  
			style=" background:#EAEAEA;" onMouseOver="this.style.backgroundColor='#999999';" 
			onMouseOut="this.style.backgroundColor='#EAEAEA';">		  </a>		  </td>
		  <td class="item_tabla" align="center" >
		  <a id="cmd_borra_val_item" href='javascript:void(0)' title='Borrar' onclick="borra_val_item(this.id)" >
			<img src='<?php echo $directorio; ?>/img/eliminar.png' width='14' height='14'  
			style=" background:#EAEAEA;" onMouseOver="this.style.backgroundColor='#999999';" 
			onMouseOut="this.style.backgroundColor='#EAEAEA';">		  </a>		  </td>
		  </tr>
		<?php 
		
		$sql="SELECT * FROM gd_atributos_documento where  tipo_documento='".$codigo."' order by orden";
		$res=pg_query($conn,$sql);
		$i=0;
		while ($reg=pg_fetch_array($res)) 
		{$i++; ?>
		
		<tr id="fila_op<?php echo $i; ?>" class="fila_tabla" >
		  <td width="203" height="20" class="item_tabla">
		  <input class="txt_celda" name='nombre_val' id='nombre_val'type='text'maxlength='100' size='30' 
		  value='<?php echo utf8_decode($reg["nombre"]);?>' >
		  <input type="hidden" name='codigo_val' id='codigo_val' value='<?php echo $reg["codigo"];?>' >		  </td>
		  <td width="38" height="20" class="item_tabla">
		  	<select name='obligatorio_val' id='obligatorio_val' style="width:40px;">
		 	<option <?php if($reg["obligatorio"]=='S'){ echo "selected='selected'";};?>  value="S">SI</option>
			<option <?php if($reg["obligatorio"]=='N'){ echo "selected='selected'";};?>  value="N">NO</option>
		 	</select>		  </td>
			<td  class="item_tabla" align="center">
		  <input class="txt_celda" name='orden_val' id='orden_val' type='text' maxlength='3' size='5' value='<?php echo $reg["orden"];?>' >
		  </td>
			<td width="38" height="20" class="item_tabla">
			<select name='tipo_dato_val' id='tipo_tipo_val' style="width:90px;">
		 <option <?php if($reg["tipo_dato"]=='TC'){ echo "selected='selected'";};?>  value="TC">Texto Corto</option>
		 <option <?php if($reg["tipo_dato"]=='TL'){ echo "selected='selected'";};?> value="TL">Texto Largo</option>
		 <option <?php if($reg["tipo_dato"]=='FE'){ echo "selected='selected'";};?> value="FE">Fecha</option>
		 <option <?php if($reg["tipo_dato"]=='NU'){ echo "selected='selected'";};?>value="NU">Numero</option>
		 <option <?php if($reg["tipo_dato"]=='DE'){ echo "selected='selected'";};?>value="DE">Decimal</option>
		 </select>
			</td>
			<td class="item_tabla" align="center" width="31" >
			<a id="cmd_guarda_val_item<?php echo $i; ?>" href='javascript:void(0)' title='Guardar' onClick="guardar_val_item(this.id);">
			<img src='<?php echo $directorio; ?>/img/botones/guardar.png' width='14' height='14'  style=" background:#EAEAEA;"
			onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';">			</a></td>
		    <td class="item_tabla" align="center" width="32" >
			<a id="cmd_borra_val_item<?php echo $i; ?>" href='javascript:void(0)' title='Borrar' onclick="borra_val_item(this.id)" >
			<img src='<?php echo $directorio; ?>/img/eliminar.png' width='14' height='14'  style=" background:#EAEAEA;"
			onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';"></a></td>
		</tr>
		<?php } ?>
    </table>
	</div>	  </td>
  </tr>
  <tr>
	  <td  align="right"></td>
	  <td colspan="3" align="left" >
	  <form style="visibility:hidden;" id="frm_op" name="frm_op"></form>
	  <input type="hidden" name='num_op' id='num_op' value=<?php echo $i;?> > </td>
  </tr>
  
<tr>
	<td><input name="codigo" id="codigo" type="hidden" value="<?php echo $codigo; ?>" /></td>
	<td width="218"></td>
	<td width="126"></td>
	<td width="40"></td>
</tr>
</table>

			