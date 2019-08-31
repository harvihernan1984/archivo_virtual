<?php
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "Por favor inicie sesion"; return false;}
//consulta todos los empleados

//muestra los datos consultados
//onSubmit='return validar()'
//direc 0=cancelar o buscado, 1=primero, 2=anterior, 3=siguiente, 4=ultimo
if(ISSET($_GET["direc"])){
	$direc=$_GET["direc"];
	if($_GET["codigo"]){$codigo=$_GET["codigo"];}
	else{$codigo="";}
	$filtro=f_genera_filtro($direc,$codigo," and ");
	if($direc!="5"){
		$sql="SELECT * FROM gd_bodega where empresa='".$_SESSION["empresa_act"]."' ".$filtro ;
		//echo $sql;
		$res=pg_query($conn,$sql);
		if ( $reg=pg_fetch_array($res))
		{ 	$codigo=$reg["codigo"];
			$nombre=$reg["nombre"];
			$descripcion=$reg["descripcion"];
			$zona=$reg["zona"];
			$distrito=$reg["distrito"];
			$unidad_operativa=$reg["unidad_operativa"];
		}
		else{if($direc=="2" ){echo "No hay mas registros"; return false;}
			if($direc=="3" ){echo "No hay mas registros"; return false;}
		}
	}
	
	?>
	<table width="510"  class="Estilo_tabla" id='tabla'>
	  <tr>
		  <td  align="right">Codigo : </td>
		  <td colspan="3" align="left" ><input type="text" disabled="disabled" name="cod" id="cod" size="10" maxlength="60" value="<?php echo $codigo; ?>"  /></td>
	  </tr>
	  
	  <tr>
	    <td  align="right">Zona : </td>
	    <td colspan="3" align="left" >
		<select name="zona" id="zona" style="width:90%" size="1" onchange="carga_combo('zona',new Array('distrito','unidad_operativa'))">
				<option value="-1">-- Seleccione Zona ---</option>
				<?php $sql="select codigo,nombre from gd_zona where (codigo=(select zona from usuario where codigo='".$_SESSION["usuario"]."') or (select zona from usuario where codigo='".$_SESSION["usuario"]."')='-1' ) order by nombre";
				$res=pg_query($conn,$sql);
				while ($reg=pg_fetch_array($res))
				{ ?> <option <?php if($reg["codigo"]==$zona) { echo "selected='selected'";}?> value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> 
				<?php } ?>
			</select>		</td>
      </tr>
	  <tr>
	    <td  align="right">Distrito : </td>
	    <td colspan="3" align="left" >
		<div id="divdistrito">
		  <select name="distrito" id="distrito" style="width:90%" size="1" onchange="carga_combo('distrito',new Array('unidad_operativa'))" >
				<option value="-1">-- Seleccione Distrito ---</option>
				<?php $sql="select codigo,nombre from gd_distrito where zona='".$zona."' order by nombre";
				$res=pg_query($conn,$sql);
				while ($reg=pg_fetch_array($res))
				{ ?> <option <?php if($reg["codigo"]==$distrito) { echo "selected='selected'";}?> value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> 
				<?php } ?>
			</select></div>		</td>
      </tr>
	  <tr>
	    <td  align="right">Unid. Ope. : </td>
	    <td colspan="3" align="left" >
		<div id="divunidad_operativa">
		  <select name="unidad_operativa" id="unidad_operativa" style="width:90%" size="1" >
				<option value="-1">-- Seleccione Unidad operativa ---</option>
				<?php $sql="select codigo,nombre from gd_unidad_operativa where zona='".$zona."' and distrito='".$distrito."' order by nombre";
				$res=pg_query($conn,$sql);
				while ($reg=pg_fetch_array($res))
				{ ?> <option <?php if($reg["codigo"]==$unidad_operativa) { echo "selected='selected'";}?> value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> 
				<?php } ?>
			</select></div>		</td>
      </tr>
	  <tr>
	    <td  align="right">Archivo de  :</td>
	    <td colspan="3" align="left" ><input type="text" name="nombre" id="nombre" maxlength="99" size="50" value="<?php echo $nombre; ?>" /></td>
      </tr>
	  <tr>
		  <td  align="right">Descripcion : </td>
		  <td colspan="3" align="left" ><textarea id="descripcion" name="descripcion" maxlength="290" style="width:97%;" ><?php echo $descripcion; ?></textarea></td>
	  </tr>
	   <tr>
		  <td  align="right">&nbsp;</td>
		  <td colspan="3" align="left" >&nbsp; </td>
	  </tr>
	<tr>
		<td><input name="codigo" id="codigo" type="hidden" value="<?php echo $codigo; ?>" /></td>
		<td></td>
		<td></td>
		<td></td>
	</tr>
	</table>
<?php } //fin if($_GET["direc"]) 
else{//else de if($_GET["direc"]) rovincia canton
	if($_GET["op"]=="zona" or $_GET["op"]=="distrito")
	{include("selec_zona.php");} 
}//fin else{//else de if($_GET["direc"])
?>		
			