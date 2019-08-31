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
if ($contenedor==""){$contenedor=$_SESSION["gd_directorio_ini"];}
///CARGAMOS LOS DATOS DEL PADRE
//CARGAMOS LOS DATOS DEL ELEMENTO 
if($evento=='EDIT'){
	$codigo=$item;
	$sql="select con.*,coalesce((select codigo from gd_contenedor where codigo=con.contenedor_padre),'') as padre
	,coalesce((select nombre from gd_contenedor where codigo=con.contenedor_padre),'') as nombre_padre
	,coalesce((select nombre from gd_tipo_contenedor where codigo=con.tipo),'') as nombre_tipo_contenedor
	 from gd_contenedor con where  con.codigo='".$codigo."'  ";
	//echo $sql;
	$res=pg_query($conn,$sql);
	//if(pg_num_rows($res)!=0){ 
	if($reg=pg_fetch_array($res)){;
		//$res=mysql_query($sql, $Conn);
		//if($fila = mysql_fetch_array($res, MYSQL_ASSOC)){
				$codigo=$reg["codigo"];
				$contenedor=$reg["padre"];
				$nombre_contenedor=$reg["nombre_padre"];
				$nombre=utf8_decode($reg["nombre"]);
				$descripcion=utf8_decode($reg["descripcion"]);
				$custodio=($reg["custodio"]);
				$nombre_tipo_contenedor=$reg["nombre_tipo_contenedor"];
				$tipo=$reg["tipo"];
				$estado=$reg["estado"];
	}
}
//cargamos en dos vectores los tipos de documentos que existen
unset($vet_cod_tipo); //vector almacena codigos de tipos de objetos
unset($vet_nomb_tipo); // vector alamcenar los nombres de los tipos de objetos
$sql="select codigo,nombre from gd_tipo_contenedor where codigo in(SELECT unnest(string_to_array(hijos,',')) as tipos FROM gd_tipo_contenedor where codigo=(select tipo from gd_contenedor where codigo='".$padre."')) order by nombre";
$res=pg_query($conn,$sql);
$i=0;
$es_folder="N"; // variable pasa saber si el tipo de objeto que existe es un folder 
while ($reg=pg_fetch_array($res)){$vet_cod_tipo[$i]=$reg["codigo"];$vet_nomb_tipo[$i]=$reg["nombre"];$i++; if($reg["codigo"]=='FO'){$es_folder="S";}}


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
	 <input  type="text"id="nombre" disabled="disabled" name="nombre"  size="40"  maxlength="50" value="<?php echo $nombre;?>" onblur="u_case(this.id)"/></td>
    </tr>
  <tr>
    <td align="right">Descripcion :</td>
    <td align="left">
	 <input  type="text"id="descripcion" disabled="disabled"  name="descripcion"  size="40"  maxlength="80" value="<?php echo $descripcion;?>" onblur="u_case(this.id)"/>	 </td>
  </tr>
  <?php  if($es_folder=='S'){?>
  <tr>
    <td align="right">Custodio : </td>
    <td align="left"> <input  type="text" disabled="disabled"   size="40" value="<?php echo $custodio;?>" />	 </td>
  </tr>
<?php  } // FIN if($es_folder=='S'){?>
  <tr>
    <td align="right">Tipo : </td>
    <td align="left"> 	 <input  type="text" disabled="disabled"   size="40" value="<?php echo $nombre_tipo_contenedor;?>" /></td>
  </tr>
  
  <tr>
    <td align="right"></td>
    <td align="left" ></td>
    </tr>
</table>



