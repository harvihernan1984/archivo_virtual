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
$filtro=f_genera_filtro($direc,$codigo," and ");
if($direc!="5"){
	$sql="SELECT * FROM atf_empresa where tipo='MSP' ".$filtro ;
	//echo $sql;
	$res=pg_query($conn,$sql);
	if ( $reg=pg_fetch_array($res))
	{ 	$codigo=$reg["codigo"];
		$nombre=$reg["nombre"];
		$ruc=$reg["ruc"];
		$direccion=$reg["direccion"];
		$nomenclatura=$reg["nomenclatura"];
		
	}
	else{if($direc=="2" ){echo "No hay mas registros"; return false;}
		if($direc=="3" ){echo "No hay mas registros"; return false;}
	}
}

?>
<table width="510"  class="Estilo_tabla" id='tabla'>
  <tr>
	  <td width="101"  align="right">Codigo :</td>
	  <td colspan="3" align="left" >
	  	<input type="text" disabled="disabled" name="cod" id="cod" size="10" value="<?php echo $codigo; ?>" /> 		  </td>
  </tr>
  <tr>
	  <td  align="right">Nombre :</td>
	  <td colspan="3" align="left" ><input type="text" name="nombre" id="nombre" maxlength="150" size="50" value="<?php echo $nombre; ?>" /> </td>
  </tr>
   <tr>
	  <td  align="right">RUC :</td>
	  <td colspan="3" align="left" ><input type="text" name="ruc" id="ruc" maxlength="13" size="50" value="<?php echo $ruc; ?>" /> </td>
  </tr>
  <tr>
	  <td  align="right">Direccion :</td>
	  <td colspan="3" align="left" >
	  <input type="text" name="direccion" id="direccion" maxlength="290" size="50" value="<?php echo $direccion; ?>" /> </td>
  </tr>
  <tr>
    <td  align="right">Nomenclatura : </td>
    <td colspan="3" align="left" >
	<input type="text" name="nomenclatura" id="nomenclatura" size="10" maxlength="9" value="<?php echo $nomenclatura; ?>" />
	</td>
  </tr>
  
<tr>
	<td><input name="codigo" id="codigo" type="hidden" value="<?php echo $codigo; ?>" /></td>
	<td width="54"></td>
	<td width="168"></td>
	<td width="167"></td>
</tr>
</table>

			