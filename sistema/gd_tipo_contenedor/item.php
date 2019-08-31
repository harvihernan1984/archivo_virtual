<?php 
require_once("conexion.php");
$evento=$_POST["evento_windows"];
$item=$_POST["item_windows"];
if($evento=='EDIT'){
	$codigo=$item;
	$sql="select * from gd_tipo_contenedor where codigo='".$codigo."'  ";
	//echo $sql;
	$res=pg_query($conn,$sql);
	//if(pg_num_rows($res)!=0){ 
	if($reg=pg_fetch_array($res)){;
		//$res=mysql_query($sql, $Conn);
		//if($fila = mysql_fetch_array($res, MYSQL_ASSOC)){
				$codigo=$reg["codigo"];
				$nombre=$reg["nombre"];	
				$imagen=$reg["imagen"];
				$nivel=$reg["nivel"];
				$hijos=$reg["hijos"];
				$borrable=$reg["borrable"];
                $empresa_padre=$reg["empresa_padre"];
                $tipo_empresa=$reg["tipo_empresa"];
	}
}

?>

<div class="divdatos_form">
<table width="428" border="0" cellspacing="0" cellpadding="0">
  <tr>
	  <td width="159"  align="right">Codigo :</td>
    <td width="60" align="left"><input type="text" class="txtcodigo" name="codigo2" id="codigo2" value="<?php echo $codigo; ?>" required="required" /></td>
	  <td width="94" align="right">&nbsp;</td>
	  <td width="140" align="left">&nbsp;</td>
  </tr>
	<tr>
	  <td  align="right">Nombre :</td>
	  <td colspan="3" align="left" ><input type="text" class="txttextoma" name="nombre" id="nombre" maxlength="100"  value="<?php echo $nombre; ?>" required="required"/> </td>
  </tr>
	<tr>
	  <td  align="right">Imagen :</td>
	  <td colspan="3" align="left" ><input type="text" class="txttextomi"  name="imagen" id="imagen" maxlength="100" size="40" value="<?php echo $imagen; ?>" required="required" /> </td>
  </tr>
  <tr>
	  <td  align="right">Borrable :</td>
	  <td colspan="3" align="left" >
      	<select name="borrable" id="borrable" class="txttextoma" size="1" >
      <?php $sql="select codigo,nombre from sis_configuracion where tipo='S_N' order by nombre";
			$res=pg_query($conn,$sql);
			while ($reg=pg_fetch_array($res))
			{ ?>
      			<option <?php if($reg["codigo"]==$borrable) { echo "selected='selected'";}?> 
            	value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option>
      <?php } ?>
        </select>
	  </td>
  </tr>
  <tr>
	  <td  align="right">Tipo Empresa :</td>
	  <td colspan="3" align="left" >
      	<select name="tipo_empresa" id="tipo_empresa" class="txttextoma" size="1" >
      <?php $sql="select codigo,nombre from sis_configuracion where tipo='SI_NO' order by nombre";
			$res=pg_query($conn,$sql);
			while ($reg=pg_fetch_array($res))
			{ ?>
      			<option <?php if($reg["codigo"]==$tipo_empresa) { echo "selected='selected'";}?> 
            	value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option>
      <?php } ?>
      </select>
	  </td>
  </tr>
  <tr>
	  <td  align="right">Empresa padre :</td>
	  <td colspan="3" align="left" >
      	<select name="empresa_padre" id="empresa_padre" class="txttextoma" size="1" >
      <?php $sql="select codigo,nombre from sis_configuracion where tipo='SI_NO' order by nombre";
			$res=pg_query($conn,$sql);
			while ($reg=pg_fetch_array($res))
			{ ?>
      			<option <?php if($reg["codigo"]==$empresa_padre) { echo "selected='selected'";}?> 
            	value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option>
      <?php } ?>
        </select>
	  </td>
  </tr>
<tr>
	  <td  align="right">Hijos :</td>
	  <td colspan="3" align="left" ><input type="text"  name="hijos" id="hijos" maxlength="250" size="40" value="<?php echo $hijos; ?>" /> </td>
  </tr>
<tr>
	<td><input name="codigo" id="codigo" type="hidden" value="<?php echo $codigo; ?>" /></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
</table>
 </div>

