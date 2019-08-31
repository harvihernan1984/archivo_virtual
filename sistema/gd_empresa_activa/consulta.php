<?php
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "Por favor inicie sesion"; return false;}
//consulta todos los empleados

//muestra los datos consultados
//onSubmit='return validar()'
//direc 0=cancelar o buscado, 1=primero, 2=anterior, 3=siguiente, 4=ultimo
if(ISSET($_GET["direc"])){
?>
<table width="589"  class="Estilo_tabla" id='tabla'>
  	<tr>
	  <td width="85"  align="right">Empresa :</td>
	  <td colspan="3" align="left" >
		<select name="empresa" id="empresa" style="width:400px" size="1"  onchange="carga_combo('empresa',new Array('periodo'))">
			<?php $sql="select codigo,nombre from atf_empresa order by nombre";
			$res=pg_query($conn,$sql);
			while ($reg=pg_fetch_array($res))
			{ ?>	<option <?php if($reg["codigo"]===$_SESSION["empresa_act"]) { echo "selected='selected'";}?> 
			        value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> <?php } ?>
		</select>	  </td>
  	</tr>
     
	<tr>
	  <td align="right">Periodo : </td>
	  <td colspan="3"><div id="divperiodo">
	  	<select name="periodo" id="periodo" style="width:400px" size="1" >
			<?php $sql="select codigo,nombre from atf_periodo where empresa='".$_SESSION["empresa_act"]."' order by nombre";
			$res=pg_query($conn,$sql);
			while ($reg=pg_fetch_array($res))
			{ ?>	<option <?php if($reg["codigo"]===$_SESSION["periodo_act"]) { echo "selected='selected'";}?> 
			        value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> <?php } ?>
		</select></div>
	  </td>
  </tr>
	<tr>
	<td><input name="codigo" id="codigo" type="hidden" value="<?php echo $codigo; ?>" /></td>
	<td width="44"></td>
	<td width="181"></td>
	<td width="259"></td>
</tr>
</table>
<?php } //fin if($_GET["direc"]) 
else{	
	if($_GET["op"]=="empresa"){include("selec_empresa.php");}
}//fin else{//else de if($_GET["direc"])
?>