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
	$sql="SELECT * FROM modulos where codigo<>'-1' ".$filtro ;
	//echo $sql;
	$res=pg_query($conn,$sql);
	if ( $reg=pg_fetch_array($res))
	{ 	$codigo=$reg["codigo"];
		$pagina=$reg["pagina"];	
		$nombre=$reg["nombre"];
		$tipo=$reg["tipo"];
		$padre=$reg["padre"];
		$directo=$reg["directo"];
		$dir_img=$reg["dir_img"];
		$orden=$reg["orden"];
		$referencia=$reg["referencia"];
	}
	else{if($direc=="2" ){echo "No hay mas registros"; return false;}
		if($direc=="3" ){echo "No hay mas registros"; return false;}
	}
}

?>
<table width="510"  class="Estilo_tabla" id='tabla'>
  <tr>
	  <td width="159"  align="right">Codigo :</td>
    <td width="60" align="left"><input type="text" disabled="disabled" name="cod" id="cod" size="10" maxlength="60" value="<?php echo $codigo; ?>"  /></td>
	  <td width="94" align="right">&nbsp;</td>
	  <td width="177" align="left">&nbsp;</td>
  </tr>
	<tr>
	  <td  align="right">Nombre :</td>
	  <td colspan="3" align="left" ><input type="text" name="nombre" id="nombre" maxlength="150" size="50" value="<?php echo $nombre; ?>" /> </td>
  </tr>
	<tr>
	  <td  align="right">Directorio :</td>
	  <td colspan="3" align="left" ><input type="text"  name="pagina" id="pagina" maxlength="250" size="50" value="<?php echo $pagina; ?>" /> </td>
  </tr>
  <tr>
	  <td  align="right">Orden :</td>
	  <td colspan="3" align="left" ><input type="text"  name="orden" id="orden" maxlength="250" size="50" value="<?php echo $orden; ?>" /> </td>
  </tr>

  <tr>
	  <td  align="right">Tipo :</td>
	  <td colspan="3" align="left" >
	  	<select name="tipo" id="tipo" style="width:240px" size="1" >
	  		<option <?php if($tipo=="I"){echo 'selected="selected"';} ?> value="I">Item </option> 
			<option <?php if($tipo=="M"){echo 'selected="selected"';} ?> value="M">Menu </option> 
	  	</select>
	  </td>
  </tr>
  <tr>
	  <td  align="right">Padre :</td>
	  <td colspan="3" align="left" >
	  	<select name="padre" id="padre" style="width:240px" size="1" >
	  		<option <?php if($padre=="-1"){echo 'selected="selected"';} ?> value="-1">PRINCIPAL</option>
			<?php $sql="select codigo,mi_acendencia(codigo) as nombre from modulos where codigo<>'-1' and tipo='M' and codigo<>'".$codigo."' order by nombre";
			$res=pg_query($conn,$sql);
			while ($reg=pg_fetch_array($res))
			{ ?>	<option <?php if($reg["codigo"]==$padre) { echo "selected='selected'";}?> value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> <?php } ?>
	  	</select>
	  </td>
  </tr>
  	<tr>
	  <td align="right">Acceso Directo :</td>
	  <td colspan="3" align="left" >
	  <input  type="checkbox" name="directo" id="directo"  value="1"  <?php if($directo=="1"){echo "checked='checked'";} ?> />
	  <label for="directo"><span></span></label>
	   </td>
  </tr>
	<tr>
	  <td  align="right">Imagen Boton :</td>
	  <td colspan="3" align="left" ><input type="text"  name="dir_img" id="dir_img" maxlength="250" size="50" value="<?php echo $dir_img; ?>" /> </td>
  </tr>
  <tr>
	  <td  align="right">Referencia :</td>
	  <td colspan="3" align="left" ><input type="text"  name="referencia" id="referencia" maxlength="250" size="50" value="<?php echo $referencia; ?>" /> </td>
  </tr>
<tr>
	<td><input name="codigo" id="codigo" type="hidden" value="<?php echo $codigo; ?>" /></td>
	<td></td>
	<td></td>
	<td></td>
</tr>
</table>
			
			
