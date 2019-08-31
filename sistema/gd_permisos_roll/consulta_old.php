<?php
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "<script type=''> alert('Por favor inicie sesion');	window.location='../vacio.php';</script>"; return false;}
//consulta todos los empleados

//muestra los datos consultados
//onSubmit='return validar()'
$direc=$_GET["direc"];
if($_GET["codigo"]){$codigo=$_GET["codigo"];}
else{$codigo="";}
$filtro=f_genera_filtro($direc,$codigo," and ");
if($direc!="5")//opcion de nuevo
{	$sql="SELECT *,(select apellido || ' ' || nombre from persona where usuario.persona=codigo) as nom_persona FROM usuario where (usuario='".$_SESSION["usuario"]."' or (select usuario from persona where codigo='".$_SESSION["usuario"]."')='-1') ".$filtro;
	$res=pg_query($conn,$sql);
	if ($reg=pg_fetch_array($res))
	{ 	$codigo=$reg["codigo"];
		$nombre=$reg["nombre"];
		$nom_persona=$reg["nom_persona"];
	}
	else{if($direc=="2" ){echo "No hay mas registros"; return false;}
		if($direc=="3" ){echo "No hay mas registros"; return false;}
	}
	
}
?>

<table class='Estilo_tabla' style="color:#990000;"  width='663'>
<tr>
	<td width="68" align="right">Usuario :</td>
	<td colspan="2" align="left"><?php echo $nombre." - ".$nom_persona ?>  </td>
</tr>
<tr class='registros'>
	<td colspan='2' style='width='405px'' align="center" >MODULO</td>
	<td align='center' width='107'>ACCESO</td>
</tr>
</table>
<div style="overflow:auto; height:300px;">
<table class='Estilo_tabla'  width='663'>
<?php 	$sql="select codigo,mi_acendencia(codigo) as nombre,coalesce((select acceso from mod_usuario where modulo=modulos.codigo and usuario='".$codigo."'),'0') as acceso 
		from modulos where tipo='I' and (codigo in(select modulo from mod_usuario where acceso='1' and usuario='".$_SESSION["usuario"]."') or (select usuario from persona where codigo='".$_SESSION["usuario"]."')='-1') order by nombre";
		$res=pg_query($conn,$sql);
		while ($reg=pg_fetch_array($res))
		{ ?>	
		<tr class='registros'  onMouseOver="this.style.backgroundColor='#999999'; " onMouseOut="this.style.backgroundColor='#f0f0f0';">
					<td colspan='2' style='width='405px'' align='left'><?php echo $reg["nombre"]; ?>
					<input type='hidden' name='mod<?php echo $reg["codigo"]; ?>' id="mod<?php echo $reg["codigo"]; ?>" value='<?php echo $reg["codigo"]; ?>'></td>
					<td align='center' width='107'><input type="checkbox" id="acceso<?php echo $reg["codigo"]; ?>" name="acceso<?php echo $reg["codigo"]; ?>" value="1"  
						<?php if($reg["acceso"]=='1'){ echo "checked='checked'";} ?>
					 />
					 <label for="acceso<?php echo $reg["codigo"]; ?>"><span></span></label>
			</td>
  		</tr>
		<?php } ?>

<tr><td colspan="3">
	<input type='hidden' name='codigo' id="codigo" value='<?php echo $codigo;?>'>
</td></tr>
</table>
<div>
