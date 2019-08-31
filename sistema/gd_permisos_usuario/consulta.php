<?php //require_once("../../conexion.php"); 
$txt_ubicacion=$_POST["txt_ubicaion"];
$tipo_vista=$_POST["tipo_vista"];
//imagen para zona 48px-Crystal_Clear_app_kfm_home
//echo $txt_ubicacion;
if(!isset($_POST["txt_ubicaion"])){
		$sql="Select co.codigo,co.nombre,tp.imagen,co.tipo  from gd_contenedor co inner join gd_tipo_contenedor tp on co.tipo=tp.codigo where  
		co.contenedor_padre='".$_SESSION["gd_directorio_ini"]."' order by nombre";
		echo $sql;
		$opcion="gd_bodega";
		$txt_title="Directorio";
		$contenido="contenedor";
}
else{ 
	$txt_ubicacion=$_POST["txt_ubicaion"];
	$txt_padre=$_POST["txt_padre"];
	$txt_directorio=$_POST["txt_directorio"];
	$txt_nombre=$_POST["txt_nombre"];
	$txt_directorio_nombre=$_POST["txt_directorio_nombre"];
	$txt_tipo_contenedor=$_POST["txt_tipo_contenedor"];
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
			$salida= "<script>$('#txt_directorio').attr('value','".$directorio_bodega."');$('#toolbar_ubicacion').html('Ubicacion :".$txt_directorio_nombre."');
			$('#txt_directorio_nombre').attr('value','".$txt_directorio_nombre."');$('#txt_padre').attr('value','".$txt_padre."');</script>";
			
	}
	if($txt_ubicacion=="refres"){
			if(count($campos)<1){$txt_ubicacion="";$directorio_bodega="";$txt_title="/";
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
			$salida= "<script>$('#txt_directorio').attr('value','".$directorio_bodega."');$('#toolbar_ubicacion').html('Ubicacion :".$txt_directorio_nombre."');
			$('#txt_directorio_nombre').attr('value','".$txt_directorio_nombre."');</script>";
	}
	if($txt_ubicacion==''){
			//$contenido="zona";
				//$contenedor=explode(";",$campos[(count($campos)-1)]);//gd_bodega
				$sql="Select co.codigo,co.nombre,tp.imagen,co.tipo  from gd_contenedor co inner join gd_tipo_contenedor tp on co.tipo=tp.codigo
				where  co.contenedor_padre='".$_SESSION["gd_directorio_ini"]."' order by nombre";
				//echo $sql;
				$opcion="gd_contenedor";
				$txt_title="/";
				$contenido="contenedor";
				echo "<script>$('#region_center').panel({title:'".$txt_title."'});$('#txt_actual').attr('value','".$contenido."');$('#txt_opcion').attr('value','".$opcion."');</script>";
				if($salida!=""){echo $salida;}
	}
	else{			
			if($txt_ubicacion=="contenedor" ){
				// implica que el vector campos tiene dos elementos zona;??|distrito;??|unidad_operativa;??|procesos;??
				$contenedor=explode(";",$campos[(count($campos)-1)]);//gd_bodega
				$sql="Select co.codigo,co.nombre,tp.imagen,co.tipo  from gd_contenedor co inner join gd_tipo_contenedor tp on co.tipo=tp.codigo
				where  co.contenedor_padre='".$contenedor[1]."' order by nombre";
				//echo $sql;
				$opcion="gd_contenedor";
				$txt_title="Directorio/";
				$contenido="contenedor";
				$imagen="estantes.png";
			}
			if($txt_ubicacion=="contenedor" and $txt_tipo_contenedor=='FO'){
				// implica que el vector campos tiene dos elementos zona;??|distrito;??|unidad_operativa;??|procesos;??
				$zona=explode(";",$campos[0]);//
				$distrito=explode(";",$campos[1]);//
				$uni_ope=explode(";",$campos[2]);//
				$proceso=explode(";",$campos[3]);//gd_bodega
				$contenedor=explode(";",$campos[(count($campos)-1)]);//gd_bodega
				$sql="Select codigo,nombre_doc as nombre, 'pdf.png' as imagen, tipo from gd_documento 	where  contenedor='".$contenedor[1]."' order by nombre";
				//echo $sql;
				$opcion="gd_documento";
				$txt_title="Directorio/Documentos";
				$contenido="documentos";
				$imagen="estantes.png";
			}
		echo "<script>$('#region_center').panel({title:'".$txt_title."'});$('#txt_actual').attr('value','".$contenido."');$('#txt_opcion').attr('value','".$opcion."');</script>";
			if($salida!=""){echo $salida;}
			else{
					if($txt_directorio_nombre==''){$txt_directorio_nombre=$txt_nombre;}
					else{$txt_directorio_nombre=$txt_directorio_nombre."|".$txt_nombre;}
					echo "<script>$('#toolbar_ubicacion').html('Ubicacion :".$txt_directorio_nombre."');$('#txt_directorio_nombre').attr('value','".$txt_directorio_nombre."');</script>";
			}
	}
}
?>
<style>
#contenedor {
   width: 100%;
   max-width: 1170px;
   min-width: 100px;
   margin: 20px auto;
}
#columnas {
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
.unidad #img_p {
   width: 90px;
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
  width: 20px;
   height:20px;
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
<?php  if($tipo_vista=='ICONO'){ ?>
<div id="contenedor">
<div id="columnas">
	<?php $res=pg_query($conn,$sql);
	while ($reg=pg_fetch_array($res)) {?>
    <div class="unidad">
	<a href="javascript:void(0)" title="Editar Elemento" onclick="editar_contenido('<?php echo $opcion; ?>','<?php echo $reg["codigo"];?>')">
		<img id="img_edit" src="img/botones/editar.png" />
	</a>
	<?php  if($muestra_borrar=='SI'){ ?>
	<a href="javascript:void(0)" title="Borrar Elemento"  onclick="borra_contenido('<?php echo $contenido; ?>','<?php echo $reg["codigo"];?>')">
		<img id="img_delete" src="img/botones/eliminar.png" />
	</a>
	<?php  } //FIN if($muestra_borrar=='SI'){ ?>
	<a href="javascript:void(0)"
	<?php  if($opcion=='gd_contenedor'){ ?>onclick="abrir_contenido('<?php echo $contenido; ?>','<?php echo $reg["codigo"];?>','<?php echo $reg["nombre"];?>','<?php echo $reg["tipo"];?>')" <?php }?>
	<?php  if($opcion=='gd_documento'){ ?>onclick="editar_documento('<?php echo $reg["codigo"];?>'')" <?php }?>
	>
	
	<div>
	<img id="img_p" src="img/botones/<?php echo $reg["imagen"];?>" />
   <p><?php echo $reg["nombre"];?></p></div>
   </a></div>
   <?php } // fin while ($reg=pg_fetch_array($res)) ?>
</div>
<?php } // FIN if($tipo_vista=='ICONO'){ ?>
<?php  if($tipo_vista=='LISTA'){ ?>
<div>
<?php $res=pg_query($conn,$sql);
			
			while ($reg=pg_fetch_array($res)) {?>
				<div class='icono_listado'    >
							<a id='cmd_edit' href="javascript:void(0)" title="Editar Elemento" onclick="editar_contenido('<?php echo $opcion; ?>','<?php echo $reg["codigo"];?>')">
							<img id="img_edit" src="img/botones/editar.png" />
							</a>
							<?php  if($muestra_borrar=='SI'){ ?>
							<a href="javascript:void(0)" title="Borrar Elemento"  onclick="borra_contenido('<?php echo $contenido; ?>','<?php echo $reg["codigo"];?>')">
							<img id="img_delete" src="img/botones/eliminar.png" />
							</a>
							<?php  } //FIN if($muestra_borrar=='SI'){ ?>
						    <a id='cmd_folder' style='text-decoration:none;' href='javascript:void(0)'
							<?php  if($opcion=='gd_contenedor'){ ?>onClick="abrir_contenido('<?php echo $contenido; ?>','<?php echo $reg["codigo"];?>','<?php echo $reg["nombre"];?>','<?php echo $reg["tipo"];?>')" <?php }?>
							<?php  if($opcion=='gd_documento'){ ?>onclick="editar_documento('<?php echo $reg["codigo"];?>'')" <?php }?>
							>
							<img id="img_obj" src='img/botones/<?php echo $reg["imagen"];?>' width='20' height='20' ><?php echo $reg["nombre"];?></a>
				</div>
<?php } //FIN while ($reg=pg_fetch_array($res))?>
</div>
<?php } //FIN if($tipo_vista=='LISTA'){ ?>
