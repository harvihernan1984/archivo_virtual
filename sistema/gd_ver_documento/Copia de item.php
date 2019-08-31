<?php
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
$txt_directorio=$_POST["txt_directorio"];
$padre=$_POST["txt_padre"];
if ($padre==""){$padre=$_SESSION["gd_directorio_ini"];}
unset($campos);
$campos=explode("|",$txt_directorio);//
unset($codigos);
for($i=0;$i<count($campos);$i++){
	$datos=explode(";",$campos[$i]);
	$codigos[$i]=$datos[1];
}
//$codigos[0]=zona,[1]=distrito,[2]=uni_ope,[3]=gd_bodega,[4]=contenerdor1,[5]=contenedor2,[n]=contenedorN 
for($i=0;$i<count($codigos);$i++){
		$contenedor=$codigos[$i];
}
if($evento=='EDIT'){
	$codigo=$item;
	$sql="SELECT * FROM gd_documento where contenedor='".$contenedor."' and codigo='".$codigo."' " ;
	//echo $sql;
	$res=pg_query($conn,$sql);
	if ( $reg=pg_fetch_array($res))
	{ 	//datos del establecimiento
		$codigo_docu=$reg["codigo"];
		$contenedor=$reg["contenedor"];	
		$tipo_doc=$reg["tipo"];	
	}
}
else{$codigo="";}	

?>
<style>
.td_cabcera{ background:#0000FF; font-weight:bold; font-size:10px; color:#FFFFFF; text-align:center;}
.td_cabcera_d{ background:#0000FF; font-weight:bold; font-size:10px; color:#FFFFFF; text-align:right;}
.td_cabcera_i{ background:#0000FF; font-weight:bold; font-size:10px; color:#FFFFFF; text-align:left;}
</style>
<style>
.divgrid{ width:99%; height:99%; overflow:auto;}
.divgrid table{
	 border:#CCCCCC dotted 1px;
}
.divgrid table input{
	 height:18px; font-size:9px; border:#999999 solid 1px;
}
.divgrid table select{
	 border:none; height:24px; font-size:9px; width:99%;
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
</style>

	 <table width="566" border="0" cellpadding="0" cellspacing="0" class="tb_hclinica"   >
  <tr>
    <td align="right">&nbsp;</td>
    <td  align="left">&nbsp;</td>
    <td  align="left">&nbsp;</td>
    <td  align="left"><input name="contenedor" id="contenedor" type="hidden" value="<?php echo $contenedor; ?>" /></td>
  </tr>
  <tr>
    <td colspan="2" align="right">
	 <span style='color:#000000; font-size:10px;'>Los campos con ( </span><span style='color:#FF0000; font-size:12px;'>*</span>
<span style='color:#000000; font-size:10px;'> ) son obligatorios.</span>
	</td>
    <td  align="left">&nbsp;</td>
    <td  align="left">&nbsp;</td>
    </tr>
  <tr height="20">
    <td  align="right" width="140">Tipo Documento  : </td>
    <td  align="left">
	<?php if($tipo_doc=="") {?>
	<select name="tipo_doc" id="tipo_doc" style="width:300px" size="1"  onchange="mostrar_atributos();">
      <option value="-1">-- Seleccione Tipo de Documento---</option>
      <?php $sql="select codigo,nombre from gd_tipo_documento  order by nombre";
				$res=pg_query($conn,$sql);
				while ($reg=pg_fetch_array($res))
				{ ?>
      <option <?php if($reg["codigo"]==$tipo_doc) { echo "selected='selected'";}?> value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option>
      <?php } ?>
    </select>
	<?php }  //FINif($tipo_doc=="")?>
	<?php if($tipo_doc!="") { 
			$sql="select codigo,nombre from gd_tipo_documento where codigo='".$tipo_doc."'  order by nombre";
			$res=pg_query($conn,$sql);
			if ($reg=pg_fetch_array($res)){ $nombre_tipo_documento=$reg["nombre"];}
	?>
			<input type="hidden" name="tipo_doc" id="tipo_doc" value="<?php echo $tipo_doc;?>" />
			<input type="text" disabled="disabled" size="40" value="<?php echo $nombre_tipo_documento; ?>" />
	<?php }?>
	</td>
    <td  align="left">&nbsp;</td>
    <td  align="left">&nbsp;</td>
    </tr>
    <tr>
      <td align="right" height="5"></td>
      <td align="left"></td>
      <td align="left"></td>
      <td align="left"></td>
	   </tr>
    </table>	
	 <div id="atributos_documento" class="divgrid">
 <table width="565" border="0" cellpadding="0" cellspacing="0" class="tb_hclinica"   >
    	 <?php 
	 			$sql="SELECT gd_at.codigo,gd_at.nombre,gd_at.obligatorio,gd_val.dato_atr,gd_val.dato_val ,gd_at.tipo_dato,gd_at.obligatorio
				FROM gd_atributos_documento gd_at inner join  gd_tipo_documento gd_tp   on gd_at.tipo_documento= gd_tp.codigo
				left join (select (string_to_array(val.campo,';'))[1] as dato_atr,(string_to_array(val.campo,';'))[2] as dato_val 
				from (SELECT unnest(string_to_array(datos_documento,'|')) as campo from gd_documento where 
				empresa='".$_SESSION["gd_empresa_act"]."' and contenedor='".$contenedor."' and codigo='".$codigo_docu."') val) gd_val 
				on  gd_val.dato_atr =gd_at.codigo where gd_tp.codigo='".$tipo_doc."'  order by gd_at.orden;";
				$res=pg_query($conn,$sql);
				$fila=0;
				while ($reg=pg_fetch_array($res)) { $fila=$fila+1;?>
				  <tr height="20" style="color:#FF0000">
					 <td width="167" align="right">
					 <input type="hidden" id="objeto<?php echo $fila;?>" name="objeto<?php echo $fila;?>"  value="<?php echo $reg["codigo"];?>" />
					 <input type="hidden" id="tdato<?php echo $fila;?>" name="tdato<?php echo $fila;?>"   value="<?php echo $reg["tipo_dato"];?>" />
					<input type="hidden" id="tforzar<?php echo $fila;?>" name="tforzar<?php echo $fila;?>"   value="<?php echo $reg["obligatorio"];?>" />
					<input type="hidden" id="tnombre<?php echo $fila;?>" name="tnombre<?php echo $fila;?>"   value="<?php echo utf8_decode($reg["nombre"]);?>" />
					<?php if($reg["obligatorio"]=='S') {echo "<span style='color:#FF0000; font-size:12px;'>*</span>";}?>
					<?php echo  "<span style='color:#000000; font-size:10px;'>".utf8_decode($reg["nombre"])." :</span>";?> 
					</td>
					<td width="396" colspan="5" align="left" >
					<?php  if($reg["tipo_dato"]=='TC'){ //TEXTO CORTO?>
					 <input  type="text"id="valor<?php echo $fila;?>" name="valor<?php echo $fila;?>"  size="50" value="<?php echo $reg["dato_val"];?>"  
					 onblur="u_case(this.id)"/>
					 <?php  } //fin texto corto
					 if($reg["tipo_dato"]=='TL'){ //TEXTO largo?>
					<textarea id="valor<?php echo $fila;?>"  name="valor<?php echo $fila;?>"  maxlength="1500" style="width:90%;" rows="1" onblur="u_case(this.id)" ><?php echo $reg["dato_val"];?></textarea>
					<?php  } //FIN TEXTO LARGO
					 if($reg["tipo_dato"]=='FE'){ //TEXTO largo?>
					 <input  type="text"id="fecha_val<?php echo $fila;?>" name="fecha_val<?php echo $fila;?>"  size="20" value="<?php echo $reg["dato_val"];?>" onblur="u_case(this.id)" />
					  <?php } // FIN TEXTO FECHA
					  if($reg["tipo_dato"]=='NU'){ //NUMERO ENTERO?>
					 <input  type="text"id="valor<?php echo $fila;?>" name="valor<?php echo $fila;?>"  size="20" value="<?php echo $reg["dato_val"];?>" onKeyPress="return soloInt(event)"  />
					  <?php } // FIN NUMERO ENTERO
					   if($reg["tipo_dato"]=='DE'){ //NUMERO DECIMAL?>
					 <input  type="text"id="valor<?php echo $fila;?>" name="valor<?php echo $fila;?>"  size="20" value="<?php echo $reg["dato_val"];?>" onKeyPress="return soloDec(event)"  />
					  <?php } // FIN NUMERO DECIMAL?>
					</td>
				 </tr>
	 		<?php } ?>
</table>
 <input type="hidden" id="num_atributos" name="num_atributos"   value="<?php echo $fila;?>" />
 <br />

 </div>
<input type="hidden" id="codigo_docu" name="codigo_docu"   value="<?php echo $codigo_docu;?>" />
<a id="cmd_nuevo_obj" href='javascript:void(0)' title='Add Anexo' onClick="Addanexo();">
					<div align="left" style="width:100px;height:24px;background:#EAEAEA;border-radius:5px; border:#AAAAAA solid;border-width:2px;" 
                    			onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';" >
                    				<img src='img/botones/48px-Crystal_Clear_action_tab_new.png' width='24' height='24' >
                    				<span style="color:#0000AA;  position:relative; left:0px; top:-8px; font-size:10px;">Add Anexo</span>
                    			</div>
				</a>
<div id="div_anexo<?php echo $num_anexos;?>">
					<iframe  name="iframe" id="iframe" width="99%" frameborder="0" scrolling="no" style=" height:26px;border:none; overflow:hidden;" 
					src="<?php echo $directorio."/gestion_documental/archivo/documento.php?
					empresa=".$_SESSION["gd_empresa_act"]."&documento=".$codigo_docu."&codigo=".$reg["codigo"]."&error="; ?>" /></div>
<div id="anexos_documento" style="width:auto; height:100px; border:#999999 dashed 1px; overflow:auto;" >
<?php $sql="select codigo from gd_documento_anexo where documento='".$codigo_docu."' and empresa='".$_SESSION["gd_empresa_act"]."' order by codigo";
				$res=pg_query($conn,$sql);
				$num_anexos=0;
				while ($reg=pg_fetch_array($res) or $num_anexos==0)	{$num_anexos++;
				?><div id="div_anexo<?php echo $num_anexos;?>">
					<iframe  name="iframe" id="iframe" width="99%" frameborder="0" scrolling="no" style=" height:26px;border:none; overflow:hidden;" 
					src="<?php echo $directorio."/gestion_documental/archivo/documento.php?
					empresa=".$_SESSION["gd_empresa_act"]."&documento=".$codigo_docu."&codigo=".$reg["codigo"]."&error="; ?>" /></div>
  <?php }?>
</div>
<input type="hidden" id="num_anexos" name="num_anexos"   value="<?php echo $num_anexos;?>" />

	 