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
$txt_directorio=$_POST["txt_directorio"];
unset($campos);
$campos=explode("|",$txt_directorio);//
$datos_zona=explode(";",$campos[0]);//// implica que el vector campos solo tiene un elemento zona;??
$zona=$datos_zona[1];
///CARGAMOS LOS DATOS DEL PADRE
$codigo='';
$sql=" select nombre from gd_zona where codigo='".$zona."'";
//echo $sql;
$res=pg_query($conn,$sql);
//if(pg_num_rows($res)!=0){ 
if($reg=pg_fetch_array($res)){
		$nombre_zona=$reg["nombre"];
}

//CARGAMOS LOS DATOS DEL ELEMENTO 
if($evento=='EDIT'){
	$codigo=$item;
	$sql="select * from gd_distrito where codigo='".$codigo."'  ";
	//echo $sql;
	$res=pg_query($conn,$sql);
	//if(pg_num_rows($res)!=0){ 
	if($reg=pg_fetch_array($res)){;
		//$res=mysql_query($sql, $Conn);
		//if($fila = mysql_fetch_array($res, MYSQL_ASSOC)){
				$codigo=$reg["codigo"];
				$nombre=$reg["nombre"];
	}
}

	

?>


<table width="428"  class="Estilo_tabla" id='tabla'>
	  <tr>
		  <td width="99"  align="right">Zona :</td>
		  <td colspan="3" align="left" >
		  <input type="text" disabled="disabled" size="40" value="<?php echo $nombre_zona; ?>" />
		  <input name="zona" id="zona" type="hidden" value="<?php echo $zona; ?>" />
		  </td>
	  </tr>
	  <tr>
		<td  align="right">Nombre :</td>
		<td colspan="3" align="left" ><input type="text" name="nombre" id="nombre" maxlength="150" size="40" value="<?php echo $nombre; ?>" /> </td>
	  </tr>	   
	<tr>
		<td><input name="codigo" id="codigo" type="hidden" value="<?php echo $codigo; ?>" /></td>
		<td width="63"></td>
		<td width="163"></td>
		<td width="93"></td>
	</tr>
</table>



