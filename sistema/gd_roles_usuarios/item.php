<?php 
require_once("conexion.php");
$evento=$_POST["evento_windows"];
$item=$_POST["item_windows"];
$estado="1";
$mostrar="1";
if($evento=='EDIT'){
	$codigo=$item;
	$sql="SELECT  * from sis_rol_usuario where codigo='".$codigo."' ";
	//echo $sql;
	$res=pg_query($conn,$sql);
	//if(pg_num_rows($res)!=0){ 
	if($reg=pg_fetch_array($res)){;
		//$res=mysql_query($sql, $Conn);
		//if($fila = mysql_fetch_array($res, MYSQL_ASSOC)){
			$codigo=$reg["codigo"];
			$nombre=$reg["nombre"];
			$mostrar=$reg["mostrar"];
	}
}

?>
<div class="divdatos_form">
<table width="428" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width='86' align='right'>Nombre :</td>
		<td align='left'>
			<input name='nombre' id='nombre' type='text'  class="txttextoma" value='<?php echo $nombre; ?>' required="required" />	</td>
    </tr>
	<tr>
		<td width='86' align='right'>Nivel :</td>
		<td align='left'>
          	<select name="mostrar" id="mostrar" class="txttextoma" size="1" >
      <?php $sql="select codigo,nombre from sis_configuracion where tipo='TP_ROL' order by nombre";
			$res=pg_query($conn,$sql);
			while ($reg=pg_fetch_array($res))
			{ ?>
      			<option <?php if($reg["codigo"]==$mostrar) { echo "selected='selected'";}?> 
            	value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option>
      <?php } ?>
        </select>
		</td>
    </tr>
	<tr>
		<td width='86' align='right'></td>
		<td width="384" align='left'>
			<input type='hidden' name='codigo' id="codigo" value='<?php	echo $codigo; ?>'>
	  <input type='hidden' name='opcion'  id="opcion" value='<?php echo $op; ?>'>	</td>
    </tr>
</table>
</div>
