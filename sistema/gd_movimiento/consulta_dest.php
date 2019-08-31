<?php //require_once("../../conexion.php"); 
$txt_ubicacion=$_POST["txt_ubicaion_dest"];
$tipo_vista=$_POST["tipo_vista_dest"];
$txt_ubicacion='';
$tipo_vista='ICONO';
//imagen para zona 48px-Crystal_Clear_app_kfm_home
//echo $txt_ubicacion;
if(!isset($_POST["txt_ubicaion_dest"])){
		$sql="Select co.codigo,co.nombre,tp.imagen,co.tipo  from gd_contenedor co inner join gd_tipo_contenedor tp on co.tipo=tp.codigo
		 where borrado='N' and  co.contenedor_padre='".$_SESSION["gd_directorio_ini"]."' order by nombre";
		//echo $sql;
		$opcion="gd_movimiento";
		$txt_title="Directorio";
		$contenido="contenedor";
}
else{ 
	$txt_ubicacion=$_POST["txt_ubicaion_dest"];
	$txt_padre=$_POST["txt_padre_dest"];
	$txt_directorio=$_POST["txt_directorio_dest"];
	$txt_nombre=$_POST["txt_nombre_dest"];
	$txt_directorio_nombre=$_POST["txt_directorio_nombre_dest"];
	$txt_tipo_contenedor=$_POST["txt_tipo_contenedor_dest"];
	$contenido="contenedor";
	$txt_title="/";
	$salida="";
	$muestra_borrar="NO";
	unset($campos);
	$campos=explode("|",$txt_directorio);//
	//echo count($campos);
	if($txt_ubicacion=="atras"){
			if(count($campos)<=1){$txt_ubicacion="";$directorio_bodega="";$txt_title="/";
				$txt_directorio_nombre="";
				unset($campos);
			}
			else{
					$num_elemento=count($campos);
					//echo "elemento=".$num_elemento;
					$campo=$campos[$num_elemento-2];
					$elemento1=explode(";",$campo);
					$txt_ubicacion=$elemento1[0];
					$txt_padre=$elemento1[1];
					$separador="";
					$separador2="";
					$directorio_bodega="";
					for($i=0;$i<($num_elemento -1);$i++){
						$txt_title=$txt_ubicacion;
						$directorio_bodega=$directorio_bodega.$separador.$campos[$i];
						$elemento1=explode(";",$campos[$i]);
						$txt_title=$txt_title.$separador2.$elemento1[0];
						$separador="|";
						$separador2="/";
					}
					$separador="";
					$nombres=explode("|",$txt_directorio_nombre);//
					$txt_directorio_nombre="";
					for($i=0;$i<(count($nombres) -1);$i++){
						$txt_directorio_nombre=$txt_directorio_nombre.$separador.$nombres[$i];
						$separador="|";
					}
					unset($campos[$num_elemento -1]);
					//echo "-|".count($campos);
			}
			$salida= "<script>$('#txt_directorio_dest').attr('value','".$directorio_bodega."');$('#toolbar_ubicacion_dest').html('Ubicacion :".$txt_directorio_nombre."');
			$('#txt_directorio_nombre_dest').attr('value','".$txt_directorio_nombre."');$('#txt_padre_dest').attr('value','".$txt_padre."');</script>";
			
	}
	if($txt_ubicacion=="refres"){
			if(count($campos)<1){$txt_ubicacion="";$directorio_bodega="";$txt_title="Zona/";
				$txt_directorio_nombre="";
			}
			else{
					$num_elemento=count($campos);
					//echo "elemento=".$num_elemento;
					$campo=$campos[$num_elemento-1];
					$elemento1=explode(";",$campo);
					$txt_ubicacion=$elemento1[0];
					$txt_padre=$elemento1[1];
					$separador="";
					$separador2="";
					for($i=0;$i<($num_elemento );$i++){
						$txt_title=$txt_ubicacion;
						$directorio_bodega=$directorio_bodega.$separador.$campos[$i];
						$elemento1=explode(";",$campos[$i]);
						$txt_title=$txt_title.$separador2.$elemento1[0];
						$separador="|";
						$separador2="/";
					}
					$separador="";
					$nombres=explode("|",$txt_directorio_nombre);//
					$txt_directorio_nombre="";
					for($i=0;$i<(count($nombres));$i++){
						$txt_directorio_nombre=$txt_directorio_nombre.$separador.$nombres[$i];
						$separador="|";
					}
			}
			$salida= "<script>$('#txt_directorio_dest').attr('value','".$directorio_bodega."');$('#toolbar_ubicacion_dest').html('Ubicacion :".$txt_directorio_nombre."');
			$('#txt_directorio_nombre_dest').attr('value','".$txt_directorio_nombre."');</script>";
	}
	if($txt_ubicacion==''){
			//$contenido="zona";
				//$contenedor=explode(";",$campos[(count($campos)-1)]);//gd_bodega
				$sql="Select co.codigo,co.nombre,tp.imagen,co.tipo  from gd_contenedor co inner join gd_tipo_contenedor tp on co.tipo=tp.codigo
				where  borrado='N' and  co.contenedor_padre='".$_SESSION["gd_directorio_ini"]."' order by nombre";
				//echo $sql;
				$opcion="gd_contenedor";
				$txt_title="/";
				$contenido="contenedor";
				echo "<script>$('#txt_actual_dest').attr('value','".$contenido."');$('#txt_opcion_dest').attr('value','".$opcion."');</script>";
				if($salida!=""){echo $salida;}
	}
	else{			
			if($txt_ubicacion=="contenedor" ){
				// implica que el vector campos tiene dos elementos zona;??|distrito;??|unidad_operativa;??|procesos;??
				$contenedor=explode(";",$campos[(count($campos)-1)]);//gd_bodega
				$sql="Select co.codigo,co.nombre,tp.imagen,co.tipo  from gd_contenedor co inner join gd_tipo_contenedor tp on co.tipo=tp.codigo
				where  borrado='N' and  co.contenedor_padre='".$contenedor[1]."' order by nombre";
				//echo $sql;
				$opcion="gd_contenedor";
				$txt_title="Directorio/";
				$contenido="contenedor";
				$imagen="estantes.png";
			}
			$existe_ext = stripos('FO,FI,AN,SM', $txt_tipo_contenedor);
			if($txt_ubicacion=="contenedor" and $existe_ext!==false){
				// implica que el vector campos tiene dos elementos zona;??|distrito;??|unidad_operativa;??|procesos;??
				$proceso=explode(";",$campos[3]);//gd_bodega
				$contenedor=explode(";",$campos[(count($campos)-1)]);//gd_bodega
				$sql="Select codigo,(select nombre from gd_tipo_documento where codigo=gd_documento.tipo )|| ' : ' ||
				(string_to_array((string_to_array(datos_documento,'|'))[1],';'))[2] as nombre , 'domuento16.png' as imagen, tipo from gd_documento 	
				where borrado='N' and  contenedor='".$contenedor[1]."' order by nombre";
				//echo $sql;
				$opcion="gd_documento";
				$txt_title="Directorio/Documentos";
				$contenido="documentos";
				$imagen="estantes.png";
			}
		echo "<script>$('#txt_actual_dest').attr('value','".$contenido."');$('#txt_opcion_dest').attr('value','".$opcion."');</script>";
			if($salida!=""){echo $salida;}
			else{
					if($txt_directorio_nombre==''){$txt_directorio_nombre=$txt_nombre;}
					else{$txt_directorio_nombre=$txt_directorio_nombre."|".$txt_nombre;}
					echo "<script>$('#toolbar_ubicacion_dest').html('Ubicacion :".$txt_directorio_nombre."');$('#txt_directorio_nombre_dest').attr('value','".$txt_directorio_nombre."');</script>";
			}
	}
}
?>
<style>
#contenedor_dest {
   width: 100%;
   max-width: 1170px;
   min-width: 100px;
   margin: 20px auto;
}
#columnas_dest {
   /*column-count: 5;*/
   column-gap: 15px;
   column-fill: auto;
}
.unidad {
   column-break-inside: avoid;
   background: #E9EBED;
   border: 2px solid #FFFFFF;
   box-shadow: 0 1px 3px rgba(20,20,20, 0.4);
   display: inline-block;
   margin: 0 5px 20px;
   padding: 10px;
   width:90px;
   vertical-align:top;
}
.unidad p {font-size:9px;}
.unidad #img_p {
   width: 50px;
   height:75px;
}
.unidad #img_edit {
   width: 24px;
   height:24px;
   position:relative;
}
.unidad #img_delete {
   width: 24px;
   height:24px;
   position:relative;
   float:right;
}
.icono_listado{
		float:left;
		margin-left:5px;
		margin-top:5px;
		line-height:16px;
		width:235px;
		height:25px;
		position: relative;
		background:#FFFFFF;
		border-radius:5px;
		border:none;
		border-width:2px;
		overflow: hidden;
		text-align:left;
		text-decoration:none;
		color:#0000AA;
		font-size:12px;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
.icono_listado  #img_edit{
 
   position:relative;
}
.icono_listado  #img_obj{
  width: 20px;
   height:20px;
   position:relative;
}
.icono_listado  #img_delete{
  width: 20px;
   height:20px;
   position:relative;
}

.icono_listado2:hover {
background:#CDCDCD;
}

</style>
<div id="contenedor_dest">
	<div id="columnas_dest">
		<?php $res=pg_query($conn,$sql);
		$f=0;
		while ($reg=pg_fetch_array($res)) {$f++;?>
		<div id="objeto_dest<?php echo $f; ?>" class="unidad">
		<input type="checkbox" id="item_dest<?php echo $f; ?>" name="item_dest<?php echo $f; ?>" value="1" />
		<label  for="item_dest<?php echo $f; ?>"><span></span></label>
		<input type="hidden" name="codigo_dest[]" id="codigo_dest[]" value="<?php echo $reg["codigo"].";".$reg["tipo"]; ?>"/>
		<input type="hidden" name="tipo_dest[]" id="tipo_dest[]" value="<?php echo $reg["tipo"]; ?>"/>
		<a href="javascript:void(0)" 
		<?php  if($opcion=='gd_contenedor'){ ?> 
		onclick="abrir_contenido_dest('<?php echo $contenido; ?>','<?php echo $reg["codigo"];?>','<?php echo $reg["nombre"];?>','<?php echo $reg["tipo"];?>')">
		<?php }?>
		<div align="center"><img id="img_p" src="img/botones/<?php echo $reg["imagen"];?>" />
	   <p><?php echo $reg["nombre"];?></p></div>
	   </a></div>
	   <?php } // fin while ($reg=pg_fetch_array($res)) ?>
	</div>
	<input type="hidden" name="num_item_dest" id="num_item_dest" value="<?php echo $f; ?>"/>
</div>
