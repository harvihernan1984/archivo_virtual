<?php 
require_once("conexion.php");
$evento=$_POST["evento_windows"];
$item=$_POST["item_windows"];
$estado="1";
$mostrar="SI";
if($evento=='EDIT'){
	$codigo=$item;
	$sql="SELECT us.*,pe.apellido || ' ' || pe.nombre as nombre_persona,us.directorio, get_directorio(us.directorio) as nombre_directorio from 
	sis_usuario us inner join gd_persona pe on us.persona=pe.codigo where  us.codigo='".$codigo."' ";
	//echo $sql;
	$res=pg_query($conn,$sql);
	//if(pg_num_rows($res)!=0){ 
	if($reg=pg_fetch_array($res)){;
		//$res=mysql_query($sql, $Conn);
		//if($fila = mysql_fetch_array($res, MYSQL_ASSOC)){
			$codigo=$reg["codigo"];
			$nombre=$reg["nombre"];
			$persona=$reg["persona"];
			$nom_persona=$reg["nombre_persona"];
			$directorio=$reg["directorio"];
			$nombre_directorio=$reg["nombre_directorio"];
			$tipo=$reg["tipo"];
			$rol=$reg["rol"];
			$empresa=$reg["empresa"];
			$estado=$reg["estado"];
			$mostrar="NO";
	}
}

?>
<div class="divdatos_form">
<table width="100%" border="0" cellspacing="0" cellpadding="0">
	<tr>
		<td width='100' align='right'>Nombre :</td>
		<td colspan='2' align='left'>
			<input name='nombre' id='nombre' type='text'  size='30' value='<?php echo $nombre; ?>' >	</td>
	    <td colspan="2" align='left'>
		<input name='estado' id="estado" type="checkbox" <?php if($estado=="1"){echo "checked='checked'";}?> value="1" />
		<label for="estado"><span></span></label>Usuario Activo</td>
  </tr>
	<tr>
		<td width='100' align='right'>Persona :</td>
		<td colspan='4' align='left'>
		<input name='nom_persona' id='nom_persona' class="txttextdir" type="text"  disabled="disabled" 
		value='<?php echo utf8_decode($nom_persona); ?>' >
		<input name='persona' id='persona' type="hidden" value='<?php echo $persona; ?>' />
		<?php if($mostrar=="SI"){ ?>
		<a id="cmd_buscar_esta" href='javascript:void(0)' title='Buscar Persona' onClick="abrir_busqueda('persona')">
	   	<img src='<?php echo $directorio; ?>/img/botones/ico-lupa.png' width='24' height='18'  style=" background:#EAEAEA;"
		onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';">	  </a>
		<?php } ?>	  </td>
    </tr>
	<tr>
		<td width='100' align='right'>Clave :</td>
		<td width="120" align='left'>
	  <input name='clave' id='clave' type='password' maxlength="15"  size='10' value='' ></td>
	    <td width="111" align='right'>Confirmar :</td>
	    <td width="120" align='left'>
	  <input name='clave2' id='clave2' type='password' maxlength="15" size='10' value='' ></td>
	    <td width="69" align='left'>
	  <input name='act' id="act" type="checkbox" value="1" /><label for="act"><span></span></label>Setear</td>
	</tr>
	<tr>
	  <td align='right'>Rol Usuario :  </td>
	  <td colspan='4' align='left'>
		<select name="rol" id="rol" class="txttextoma" size="1" >
			<option value="-1">-- Seleccione Rol ---</option>
			<?php $sql="select codigo,nombre from sis_rol_usuario where
            codigo in(select cod from sis_accesos_rol_usuario ('".$_SESSION["gd_usuario"]."','sis_rol_usuario_tipo',''))
            order by nombre";
			$res=pg_query($conn,$sql);
			while ($reg=pg_fetch_array($res))
			{ ?> <option <?php if($reg["codigo"]==$rol) { echo "selected='selected'";}?> 
			 value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> 
			<?php } ?>
		</select>
      </td>
	</tr>
	<tr>
	  <td align='right'>Empresa : </td>
	  <td colspan='4' align='left'>
			<select name="empresa" id="empresa" class="txttextoma" size="1" onchange="res_busca_directorio('')" >
					<option value="-1">-- Seleccione Tipo ---</option>
					<?php $sql="select codigo,nombre from gd_empresa where
                    codigo in(select cod from sis_accesos_rol_usuario ('".$_SESSION["gd_usuario"]."','gd_empresa','')) order by nombre";
					$res=pg_query($conn,$sql);
					while ($reg=pg_fetch_array($res))
					{ ?> <option <?php if($reg["codigo"]==$empresa) { echo "selected='selected'";}?> value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> 
					<?php } ?>
			</select>  </td>
	</tr>
	<tr>
	  <td align='right'>Directoio Activo : </td>
	  <td colspan='4' align='left'>
	  <input name='nombre_directorio' id='nombre_directorio' class="txttextdir" type="text"   disabled="disabled" 
		value='<?php echo utf8_decode($nombre_directorio); ?>' />
		<input name='directorio' id='directorio' type="hidden" value='<?php echo $directorio; ?>' >
		<a id="cmd_buscar_esta" href='javascript:void(0)' title='Buscar Directorio' onClick="abrir_busqueda('directorio')">
	   	<img src='img/botones/ico-lupa.png' width='24' height='18'  style=" background:#EAEAEA;"
		onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';">	  </a>
	  </td>
  </tr>
<tr>
		<td width='145' align='right'></td>
		<td align='left'>
			<input type='hidden' name='codigo' id="codigo" value='<?php	echo $codigo; ?>'>
			<input type='hidden' name='opcion'  id="opcion" value='<?php echo $op; ?>'>	</td>
	    <td align='left'>&nbsp;</td>
	    <td align='left'>&nbsp;</td>
	    <td align='left'>&nbsp;</td>
	</tr>
</table>
 </div>
