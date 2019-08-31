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
$padre=$_POST["txt_padre"];
if ($padre==""){$padre=$_SESSION["gd_directorio_ini"];}
unset($campos);
$campos=explode("|",$txt_directorio);//
unset($codigos);
for($i=0;$i<count($campos);$i++){
	$datos=explode(";",$campos[$i]);
	$codigos[$i]=$datos[1];
}
//$codigos[0]=zona,[1]=distrito,[2]=uni_ope,[3]=gd_bodega,[4]=contenerdor1,[5]=contenedor2,[n]=contenedorN 
for($i=0;$i<count($codigos);$i++){
		$contenedor=$codigos[$i];
}
///CARGAMOS LOS DATOS DEL PADRE
//CARGAMOS LOS DATOS DEL ELEMENTO 
if($evento=='EDIT'){
	$codigo=$item;
	$sql="select con.*,coalesce((select codigo from gd_contenedor where codigo=con.contenedor_padre),'') as padre
	,coalesce((select nombre from gd_contenedor where codigo=con.contenedor_padre),'') as nombre_padre from gd_contenedor con where  con.codigo='".$codigo."'  ";
	//echo $sql;
	$res=pg_query($conn,$sql);
	//if(pg_num_rows($res)!=0){ 
	if($reg=pg_fetch_array($res)){;
		//$res=mysql_query($sql, $Conn);
		//if($fila = mysql_fetch_array($res, MYSQL_ASSOC)){
				$codigo=$reg["codigo"];
				$contenedor=$reg["padre"];
				$nombre_contenedor=$reg["nombre_padre"];
				$nombre=$reg["nombre"];
				$descripcion=$reg["descripcion"];
				$custodio=$reg["custodio"];
				$tipo=$reg["tipo"];
				$estado=$reg["estado"];
	}
}

?>
<table width="100%" border="0" cellpadding="0" cellspacing="0" class="tb_hclinica"   >
  <tr>
    <td align="right">Contendor  : </td>
    <td align="left">
	 <input type="text" disabled="disabled" size="40" value="<?php echo $nombre_contenedor; ?>" />
	 <input name="contenedor" id="contenedor" type="hidden" value="<?php echo $contenedor; ?>" />	 </td>
  </tr>
  <tr>
    <td align="right">Nombre  : </td>
    <td align="left">
	 <input  type="text"id="nombre" name="nombre"  size="40"  maxlength="50" value="<?php echo $nombre;?>" onblur="u_case(this.id)"/></td>
    </tr>
  <tr>
    <td align="right">Descripcion :</td>
    <td align="left">
	 <input  type="text"id="descripcion" name="descripcion"  size="40"  maxlength="80" value="<?php echo $descripcion;?>" onblur="u_case(this.id)"/>	 </td>
  </tr>
  <tr>
    <td align="right">Custodio : </td>
    <td align="left">
	  <input  type="text"id="custodio" name="custodio"  size="40"  maxlength="50" value="<?php echo $custodio;?>" onblur="u_case(this.id)"/>	 </td>
  </tr>
  <tr>
    <td align="right">Tipo : </td>
    <td align="left">
	<select id="tipo" name="tipo" style="width:100px;">
			<option value="-1">-- Seleccione  ---</option>
				<?php $sql="select codigo,nombre from gd_tipo_contenedor where codigo in(SELECT unnest(string_to_array(hijos,',')) as tipos FROM gd_tipo_contenedor where codigo=(select tipo from gd_contenedor where codigo='".$padre."')) order by nombre";
				$res=pg_query($conn,$sql);
				while ($reg=pg_fetch_array($res))
				{ ?> <option <?php if($reg["codigo"]==$tipo) { echo "selected='selected'";}?> value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> 
				<?php } ?>
	</select>	</td>
  </tr>
  <tr>
    <td align="right">Estado : </td>
    <td align="left">
	<select id="estado" name="estado" style="width:100px;">
		<option <?php if($estado=='A'){echo "selected='selected'";} ?> value="A">Activo</option>	
		<option <?php if($estado=='P'){echo "selected='selected'";} ?> value="P">Pasivo</option>	
		<option <?php if($estado=='I'){echo "selected='selected'";} ?> value="I">Intermedio</option>	
	</select>	</td>
  </tr>
  <tr>
    <td align="right"><input type="hidden" id="codigo" name="codigo"  size="15" value="<?php echo $codigo;?>" />      </td>
    <td align="left" ></td>
    </tr>
</table>



