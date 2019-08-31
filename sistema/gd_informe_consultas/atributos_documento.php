<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb_hclinica"   >
   	 <?php 
	 			$tipo_doc=$_POST["tipo_doc"];
	 			$sql="SELECT gd_a.codigo,gd_a.nombre,gd_a.obligatorio ,gd_a.tipo_dato
				FROM gd_atributos_documento gd_a inner join  gd_tipo_documento gd_tp   on gd_a.tipo_documento= gd_tp.codigo
				where gd_tp.codigo='".$tipo_doc."'  order by gd_a.orden;";
				$res=pg_query($conn,$sql);
				$fila=0;
				while ($reg=pg_fetch_array($res)) { $fila=$fila+1;?>
				  <tr height="20" style="color:#FF0000">
					 <td width="150" align="right">
					 <input type="hidden" id="objeto<?php echo $fila;?>" name="objeto<?php echo $fila;?>"  value="<?php echo $reg["codigo"];?>" />
					 <input type="hidden" id="tdato<?php echo $fila;?>" name="tdato<?php echo $fila;?>"   value="<?php echo $reg["tipo_dato"];?>" />
					<input type="hidden" id="tforzar<?php echo $fila;?>" name="tforzar<?php echo $fila;?>"   value="<?php echo $reg["obligatorio"];?>" />
					<input type="hidden" id="tnombre<?php echo $fila;?>" name="tnombre<?php echo $fila;?>"   value="<?php echo utf8_decode($reg["nombre"]);?>" />
					<?php if($reg["obligatorio"]=='S') {echo "<span style='color:#FF0000; font-size:12px;'>*</span>";}?>
					<?php echo  "<span style='color:#000000; font-size:10px;'>".utf8_decode($reg["nombre"])." :</span>";?> 
					</td>
					<td width="415" colspan="5" align="left" >
					<?php  if($reg["tipo_dato"]=='TC'){ //TEXTO CORTO?>
					 <input  type="text"id="valor<?php echo $fila;?>" name="valor<?php echo $fila;?>"  size="50" value="<?php echo $reg["dato_val"];?>"  
					 onblur="u_case(this.id)"/>
					 <?php  } //fin texto corto
					 if($reg["tipo_dato"]=='TL'){ //TEXTO largo?>
					<textarea id="valor<?php echo $fila;?>"  name="valor<?php echo $fila;?>"  maxlength="1500" style="width:97%;" rows="1" onblur="u_case(this.id)" ><?php echo $reg["dato_val"];?></textarea>
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