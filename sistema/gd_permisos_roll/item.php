<?php 
require_once("conexion.php");
$evento=$_POST["evento_windows"];
$item=$_POST["item_windows"];
if($evento=='NEW'){return false;}
if($evento=='EDIT'){
	$codigo=$item;
	$sql="SELECT codigo,nombre from  sis_rol_usuario  where  codigo='".$codigo."' ";
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


<table class='Estilo_tabla' style="color:#990000;"  width='100%'>
<tr>
	<td width="68" align="right">Usuario :</td>
	<td colspan="2" align="left"><?php echo $nombre; ?>  </td>
</tr>
<tr class='registros'>
	<td colspan='2' style='width='405px'' align="center" >MODULO</td>
	<td align='center' width='107'>ACCESO</td>
</tr>
</table>
<div style="overflow:auto; height:auto; width:auto;">
<table class='Estilo_tabla'  width='100%'>
<?php 	$sql="select mo.codigo,sis_mi_acendencia(mo.codigo) as nombre, coalesce((select acceso from sis_modulos_roll where modulo=mo.codigo and roll='".$codigo."'),'0') as acceso
from sis_modulos as mo where mo.codigo<> '-1' and tipo='I'  order by nombre";
		//echo $sql;
		$res=pg_query($conn,$sql);
		while ($reg=pg_fetch_array($res))
		{ ?>	
		<tr class='registros'  style="background-color:#f0f0f0;" onMouseOver="this.style.backgroundColor='#999999'; " onMouseOut="this.style.backgroundColor='#f0f0f0';">
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


