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
	$sql="select * from gd_persona where codigo='".$codigo."'  ";
	//echo $sql;
	$res=pg_query($conn,$sql);
	//if(pg_num_rows($res)!=0){ 
	if($reg=pg_fetch_array($res)){;
		//$res=mysql_query($sql, $Conn);
		//if($fila = mysql_fetch_array($res, MYSQL_ASSOC)){
				$codigo=$reg["codigo"];
				$cedula=$reg["cedula"];
				$nombre=utf8_decode($reg["nombre"]);
				$apellido=utf8_decode($reg["apellido"]);
				$direccion=utf8_decode($reg["direccion"]);
				$telefono=$reg["telefono"];
				$fecha_nac=$reg["fecha_nac"];
				$zona=$reg["zona"];
				$distrito=$reg["distrito"];
				$cargo=utf8_decode($reg["cargo"]);
				$empresa=$reg["empresa"];
				$area=$reg["area"];
                $correo=utf8_decode($reg["correo"]);
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
	<td width='116' align='right'><span style='color:#FF0000; font-size:12px;'>*</span>Cedula :</td>
	<td colspan='2' align='left'>
		<input name='cedula' id='cedula' class="txtcedula"  type='text' maxlength='10' value='<?php echo $cedula;?>' required="required"/>	</td>
</tr>
<tr>
	<td width='116' align='right'><span style='color:#FF0000; font-size:12px;'>*</span>Apellido :</td>
	<td colspan='2' align='left'>
		<input name='apellido' id='apellido' class="txttextonomb"  type='text'  maxlength='120' value='<?php echo $apellido;?>' required="required" /></td>
</tr>
<tr>
	<td width='116' align='right'><span style='color:#FF0000; font-size:12px;'>*</span>Nombre :</td>
	<td colspan='2' align='left'>
		<input name='nombre' id='nombre' class="txttextonomb"  type='text' maxlength='120' value='<?php echo $nombre;?>' required="required"/>	</td>
</tr>
<tr>
	<td width='116' align='right'><span style='color:#FF0000; font-size:12px;'>*</span>Direccion :</td>
	<td colspan='2' align='left'>
		<input name='direccion' id='direccion' class="txttextoma" type='text'maxlength='250'  value='<?php echo $direccion;?>' required="required"/>	</td>
</tr>
<tr>
	<td width='116' align='right'><span style='color:#FF0000; font-size:12px;'>*</span>Correo :</td>
	<td colspan='2' align='left'>
		<input name='correo' id='correo' class="txtmail"  type='text'  maxlength='120'   value='<?php echo $correo;?>' required="required"/>	</td>
</tr>
<tr>
	<td width='116' align='right'><span style='color:#FF0000; font-size:12px;'>*</span>Telefono :</td>
	<td colspan='2' align='left'>
		<input name='telefono' id='telefono' type='text' class="txttelefono" maxlength='10'  value='<?php echo $telefono;?>' required="required" />	</td>
</tr>
<tr>
	<td width='116' align='right'><span style='color:#FF0000; font-size:12px;'>*</span>Cargo :</td>
	<td colspan='2' align='left'>
		<input name='cargo' id='cargo' class="txttextoma" type='text' maxlength='100' value='<?php echo $cargo;?>' required="required"/>	</td>
</tr>
<tr style="display:none">
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


