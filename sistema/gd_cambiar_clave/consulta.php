<?php
$opcion=$_POST["opcion_contenido"];
$evento=$_POST["evento_contenido"];
$item=$_POST["item_contenido"];
if(ValidaUsuario()==false){echo "<script type=''> alert('Por favor inicie sesion');</script>"; return false;}
//consulta todos los empleados

//muestra los datos consultados
//onSubmit='return validar()'
$sql="SELECT *,(select apellido || ' ' || nombre from gd_persona where codigo=sis_usuario.persona) as nom_persona FROM sis_usuario where codigo='".$_SESSION["gd_usuario"]."'";
$res=pg_query($conn,$sql);
$codigo="";
$nombre="";
$persona="";
$nom_persona="";
$op="";
if ($reg=pg_fetch_array($res))
{ 	$codigo=$reg["codigo"];
	$nombre=$reg["nombre"];
	$persona=$reg["persona"];
	$nom_persona=$reg["nom_persona"];
}
	

?>
 <form id="form_windows" name="form_windows">
		<input type="hidden" id="opcion_windows" name="opcion_windows" value="<?php echo $opcion;?>"/>
		<input type="hidden" id="accion_windows" name="accion_windows" value=""/>
        <input type="hidden" id="evento_windows" name="evento_windows" value="<?php echo $evento;?>"/>
        <input type="hidden" id="item_windows" name="item_windows" value="<?php echo $item;?>"/>
<input  type="hidden" id="alto_windows" name="alto_windows" value="500"/>
<input  type="hidden" id="ancho_windows" name="ancho_windows" value="600"/>
<table width="464" class='Estilo_tabla'>
<tr>
  <td align='right'>&nbsp;</td>
  <td colspan='2' align='left'>&nbsp;</td>
</tr>
<tr>
	<td width='180' align='right'>Nombre :</td>
	<td width="272" colspan='2' align='left'>
		<input name='nombre' id='nombre' type='text'  size='40' value='<?php echo $nombre; ?>' >	</td>
</tr>
<tr>
	<td width='180' align='right'>Persona :</td>
	<td colspan='2' align='left'><?php echo $nom_persona; ?><input name='persona' id='persona' type="hidden" value='<?php	echo $persona; ?>' >	</td>
</tr>
<tr>
	<td width='180' align='right'>Nueva Clave :</td>
	<td colspan='2' align='left'>
		<input name='clave' id='clave' type='password'  size='20' value='' >	</td>
</tr>
<tr>
	<td width='180' align='right'>Confirmar nueva. Clave :</td>
	<td colspan='2' align='left'>
		<input name='clave2' id='clave2' type='password'  size='20' value='' >	</td>
</tr>
<tr>
	<td width='180' align='right'>Clave Anterior:</td>
	<td colspan='2' align='left'>
		<input name='clave3' id='clave3' type='password'  size='20' value='' >	</td>
</tr>
<tr>
	<td width='180' align='right'></td>
	<td colspan='2' align='left'>
		<input type='hidden' name='codigo' id="codigo" value='<?php	echo $codigo; ?>'>
		<input type='hidden' name='opcion'  id="opcion" value='<?php echo $op; ?>'>	</td>
</tr>
</table>
</form>