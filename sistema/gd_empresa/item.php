<?php 
require_once("conexion.php");
	$codigo="";
	$nombre="";
	$ruc="";
	$direccion="";
	$nomenclatura="";
	$directorio="";
	
// fin definicion variables
$evento=$_POST["evento_windows"];
$item=$_POST["item_windows"];
if($evento=='EDIT'){
	$codigo=$item;
	$sql="select * ,get_directorio(directorio) as nombre_directorio from gd_empresa where codigo='".$codigo."'  ";
	//echo $sql;
	$res=pg_query($conn,$sql);
	//if(pg_num_rows($res)!=0){ 
	if($reg=pg_fetch_array($res)){;
		//$res=mysql_query($sql, $Conn);
		//if($fila = mysql_fetch_array($res, MYSQL_ASSOC)){
				$codigo=$reg["codigo"];
				$nombre=utf8_decode($reg["nombre"]);
				$direccion=utf8_decode($reg["direccion"]);
				$nomenclatura=utf8_decode($reg["nomenclatura"]);
				$ruc=$reg["ruc"];
				$directorio=$reg["directorio"];
			    $nombre_directorio=$reg["nombre_directorio"];
                $empresa_padre=$reg["empresa_padre"];
                $tipo=$reg["tipo"];
	}
}
	

?>

<div class="divdatos_form">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
<tr>
	  <td width="116" align="right">Codigo :</td>
	  <td colspan='2' align="left">
	  <input type="text" disabled="disabled" class="txtcodigo" name="cod" id="cod" size="10" maxlength="60" value="<?php echo $codigo; ?>"  />	  </td>
</tr>

<tr>
	<td width='116' align='right'>RUC :</td>
	<td colspan='2' align='left'>
		<input name='ruc' id='ruc' type='text' class="txtruc"  size='13' maxlength='13' value='<?php echo $ruc;?>' required="required"/>	</td>
</tr>
<tr>
	<td width='116' align='right'>Nombre :</td>
	<td colspan='2' align='left'>
		<input name='nombre' id='nombre' type='text' class="txttextoma" size='30' maxlength='120' value='<?php echo $nombre;?>' required="required"/>	</td>
</tr>
<tr>
	<td width='116' align='right'>Direccion :</td>
	<td colspan='2' align='left'>
		<input name='direccion' id='direccion' type='text' class="txttextoma" maxlength='250' size='40' value='<?php echo $direccion;?>' required="required"/>	</td>
</tr>
<tr>
	<td width='116' align='right'>Abreviatura :</td>
	<td colspan='2' align='left'>
		<input name='nomenclatura' id='nomenclatura' class="txttextoma" type='text' maxlength='10'  size='30' value='<?php echo $nomenclatura;?>' >	</td>
</tr>
<tr>
	<td width='116' align='right'>Tipo :</td>
	<td colspan='2' align='left'>
	<select name="tipo" id="tipo" class="txttextoma" size="1" ">
      <option value="-1">-- Seleccione Tipo de empresa---</option>
      	 <?php $sql="select codigo,nombre from gd_tipo_contenedor where tipo_empresa='SI' order by nombre";
			$res=pg_query($conn,$sql);
			while ($reg=pg_fetch_array($res))
			{ ?>
      			<option <?php if($reg["codigo"]==$tipo) { echo "selected='selected'";}?> 
            	value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option>
      <?php } ?>
    </select>
	</td>
<tr>
	<td width='116' align='right'>Entidad padre :</td>
	<td colspan='2' align='left'>
	<select name="empresa_padre" id="empresa_padre" class="txttextoma" size="1" ">
      <option value="-1">-- Seleccione la Empresa---</option>
      <?php $sql="select codigo,nombre from gd_empresa where 
      codigo in(select cod from sis_accesos_rol_usuario ('".$_SESSION["gd_usuario"]."','gd_empresa_tipo','')) 
      and tipo in(select codigo from gd_tipo_contenedor where empresa_padre='SI') order by nombre";
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
<td align='right'>Directoio : </td>
	  <td colspan='4' align='left'>
	  <input name='nombre_directorio' id='nombre_directorio' style="width:85%" class="txttextoma" type="text"  size="35" disabled="disabled" 
		value='<?php echo utf8_decode($nombre_directorio); ?>' required="required"/>
		<input name='directorio' id='directorio' type="hidden" value='<?php echo $directorio; ?>' />
		<?php if($directorio==''){ ?>
      	<a id="cmd_buscar_esta" href='javascript:void(0)' title='Buscar Directorio' onClick="abrir_busqueda('directorio')">
	   	<img src='img/botones/ico-lupa.png' width='24' height='18'  style=" background:#EAEAEA;"
		onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';">	  
      	</a>
      	<?php } ?>
	  </td>
  </tr>
<tr>
	<td width='116' align='right'></td>
	<td colspan='2' align='left'>
		<input type='hidden' name='codigo' id="codigo" value='<?php echo $codigo;?>'>	</td>
</tr>
</table>
 </div>
<?php //} //fin if($_GET["direc"]) 
//else{	
//	if($_GET["op"]=="zona"){include("selec_zona.php");} 
	//if($_GET["op"]=="empresa"){include("selec_empresa.php");}
//}//fin else{//else de if($_GET["direc"])
?>


