<?php //require_once("../../conexion.php"); 
$txt_ubicacion=$_POST["txt_ubicaion"];
$tipo_vista=$_POST["tipo_vista"];
//imagen para zona 48px-Crystal_Clear_app_kfm_home
//echo $txt_ubicacion;
if(!isset($_POST["txt_ubicaion"])){
		$sql="Select co.codigo,co.nombre,co.descripcion,tp.imagen,co.tipo,tp.borrable,
				case when strpos('FO,FI,AN,SM', co.tipo) > 0 then (select count(*) from gd_documento where contenedor=co.codigo and borrado='N') 
				else (select count(*) from gd_contenedor where contenedor_padre=co.codigo and borrado='N') end as hijos   
				from gd_contenedor co inner join gd_tipo_contenedor tp on co.tipo=tp.codigo where  		
				co.borrado='N' and co.contenedor_padre='".$_SESSION["gd_directorio_activo"]."' order by nombre";
		//echo $sql;
		$opcion="gd_contenedor";
		$txt_title=$_SESSION["gd_directorio_activo_raiz"];
		$contenido="contenedor";
}
else{ 
	$txt_ubicacion=$_POST["txt_ubicaion"];
	$txt_padre=$_POST["txt_padre"];
	$txt_directorio=$_POST["txt_directorio"];
	$txt_nombre=$_POST["txt_nombre"];
	$txt_directorio_nombre=$_POST["txt_directorio_nombre"];
	$txt_tipo_contenedor=$_POST["txt_tipo_contenedor"];
	$txt_buscar=$_POST["txt_buscar"];
	$contenido="contenedor";
	$txt_title="/";
	$salida="";
	$muestra_borrar="NO";
	unset($campos);
	$campos=explode("|",$txt_directorio);//
	//echo count($campos);
	if($txt_ubicacion=="atras"){
			if(count($campos)<=1){$txt_ubicacion="";$directorio_bodega="";$txt_title="/";$txt_padre="";
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
				//colacamos filtro de busqueda
					if($txt_buscar!=""){$filtro_buscar=" AND upper(co.nombre) LIKE upper('%".$txt_buscar."%')";}
				///fin de filtro busqueda
				$sql="Select co.codigo,co.nombre,co.descripcion,tp.imagen,co.tipo,tp.borrable,
				case when strpos('FO,FI,AN,SM', co.tipo) > 0 then (select count(*) from gd_documento where contenedor=co.codigo and borrado='N') 
				else (select count(*) from gd_contenedor where contenedor_padre=co.codigo and borrado='N') end as hijos  
				 from gd_contenedor co inner join gd_tipo_contenedor tp on co.tipo=tp.codigo
				where  co.borrado='N' and  co.contenedor_padre='".$_SESSION["gd_directorio_activo"]."'  ".$filtro_buscar." order by co.nombre";
				//echo $sql;
				$opcion="gd_contenedor";
				$txt_title=$_SESSION["gd_directorio_activo_raiz"];
				$contenido="contenedor";
				echo "<script>$('#region_center').panel({title:'".$txt_title."'});$('#txt_actual').attr('value','".$contenido."');$('#txt_opcion').attr('value','".$opcion."');</script>";
				if($salida!=""){echo $salida;}
	}
	else{			
			if($txt_ubicacion=="contenedor" ){
				// implica que el vector campos tiene dos elementos zona;??|distrito;??|unidad_operativa;??|procesos;??
				//colacamos filtro de busqueda
					if($txt_buscar!=""){$filtro_buscar=" AND upper(co.nombre) LIKE upper('%".$txt_buscar."%')";}
				///fin de filtro busqueda
				$contenedor=explode(";",$campos[(count($campos)-1)]);//gd_bodega
				$sql="Select co.codigo,co.nombre,co.descripcion,tp.imagen,co.tipo,tp.borrable,
				case when strpos('FO,FI,AN,SM', co.tipo) > 0 then (select count(*) from gd_documento where contenedor=co.codigo and borrado='N') 
				else (select count(*) from gd_contenedor where contenedor_padre=co.codigo and borrado='N') end as hijos  
				from gd_contenedor co inner join gd_tipo_contenedor tp on co.tipo=tp.codigo
				where  co.borrado='N' and  co.contenedor_padre='".$contenedor[1]."'   ".$filtro_buscar." order by co.nombre";
				//echo $sql;
				$opcion="gd_contenedor";
				$txt_title=$_SESSION["gd_directorio_activo_raiz"]."/";
				$contenido="contenedor";
				$imagen="estantes.png";
			}
    		$existe_ext = stripos('FO,FI,AN,SM', $txt_tipo_contenedor);
			if($txt_ubicacion=="contenedor" and $existe_ext!==false){
				// implica que el vector campos tiene dos elementos zona;??|distrito;??|unidad_operativa;??|procesos;??
				//colacamos filtro de busqueda
					if($txt_buscar!=""){$filtro_buscar=" AND upper(datos_documento) LIKE upper('%".$txt_buscar."%')";}
				///fin de filtro busqueda
				//				$zona=explode(";",$campos[0]);//
				//$distrito=explode(";",$campos[1]);//
				//$uni_ope=explode(";",$campos[2]);//
				//$proceso=explode(";",$campos[3]);//gd_bodega
				$contenedor=explode(";",$campos[(count($campos)-1)]);//gd_bodega
				$sql="Select codigo,substring((select abreviatura from gd_tipo_documento where codigo=gd_documento.tipo )|| ' : ' ||
				(string_to_array((string_to_array(datos_documento,'|'))[1],';'))[2] from 1 for 50) as nombre , 'domuento16.png' as imagen, tipo, 'S' as borrable, '' as descripcion,
				(select count(*) FROM gd_documento_anexo where documento=gd_documento.codigo and borrado='N') as hijos
				from gd_documento where  borrado='N' and contenedor='".$contenedor[1]."'    ".$filtro_buscar."  order by nombre";
				//echo $sql;
				$opcion="gd_documento";
				$txt_title=$_SESSION["gd_directorio_activo_raiz"]."/Documentos";
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
   border:#CCCCCC dotted 2px;
}
.unidad p {font-size:9px;}
.unidad #img_p {
   width: 50px;
   height:75px;
}
.unidad #img_edit {
   width: 16px;
   height:16px;
   position:relative;
   border:#CCCCCC dotted 2px;
}
.unidad #img_edit:hover{ border:#666666 solid 2px;}
.unidad #img_delete {
   width: 16px;
   height:16px;
   position:relative;
   float:relative;
   border:#CCCCCC dotted 2px;
}
.unidad  #txt_hijos{
   color:#0000FF;
   height:20px;
   float:right;
}
.unidad #img_delete:hover {
	background:#666666;
	border:#666666 solid 2px;
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
		font-size:10px;
		text-overflow: ellipsis;
		white-space: nowrap;
	}
.icono_listado  #img_edit{
  width: 16px;
   height:16px;
   position:relative;
}
.icono_listado  #img_obj{
  width: 16px;
   height:16px;
   position:relative;
}
.icono_listado  #img_delete{
  width: 16px;
   height:16px;
   position:relative;
}
.icono_listado  #txt_hijos{
	 color:#0000FF;
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
	<?php  if($reg["borrable"]=='S'){ ?>
	<a href="javascript:void(0)" title="Borrar Elemento"  onclick="borra_contenido('<?php echo $opcion; ?>','<?php echo $reg["codigo"];?>')">
		<img id="img_delete" src="img/botones/eliminar.png" />
	</a>
	<?php  } //FIN if($muestra_borrar=='SI'){ ?>
	 <span id="txt_hijos" ><?php echo "(".$reg["hijos"].")"; ?></span>
	<a href="javascript:void(0)"  title="<?php echo $reg["nombre"]." &#13;".$reg["descripcion"];?>" 
	<?php  if($opcion=='gd_contenedor'){ ?> 
			onclick="abrir_contenido('<?php echo $contenido; ?>','<?php echo $reg["codigo"];?>','<?php echo $reg["nombre"];?>','<?php echo $reg["tipo"];?>')" >
	<?php }?>
	<?php  if($opcion=='gd_documento'){ ?>
			 onclick="editar_contenido('<?php echo $opcion; ?>','<?php echo $reg["codigo"];?>')" >
	<?php }?>
	
	
	<div align="center">
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
					<?php  if($reg["borrable"]=='S'){ ?>
					<a href="javascript:void(0)" title="Borrar Elemento"  onclick="borra_contenido('<?php echo $opcion; ?>','<?php echo $reg["codigo"];?>')">
					<img id="img_delete" src="img/botones/eliminar.png" />
					</a>
					<?php  } //FIN if($muestra_borrar=='SI'){ ?>
					<span id="txt_hijos" ><?php echo "(".$reg["hijos"].")"; ?></span>
					<?php  if($opcion=='gd_contenedor'){ ?> 
						<a id='cmd_folder' style='text-decoration:none;' href='javascript:void(0)'    title="<?php echo $reg["nombre"]." &#13;".$reg["nombre"];?>"
						onClick="abrir_contenido('<?php echo $contenido; ?>','<?php echo $reg["codigo"];?>','<?php echo $reg["nombre"];?>','<?php echo $reg["tipo"];?>')" >
					<?php }?>
					<?php  if($opcion=='gd_documento'){ ?> 
						<a id='cmd_folder' style='text-decoration:none;' href='javascript:void(0)'   title="<?php echo $reg["nombre"];?>"
						onClick="editar_contenido('<?php echo $opcion; ?>','<?php echo $reg["codigo"];?>')" >
					<?php }?>
					
					<img id="img_obj" src='img/botones/<?php echo $reg["imagen"];?>' width='20' height='20' ><?php echo $reg["nombre"];?></a>
				</div>
<?php } //FIN while ($reg=pg_fetch_array($res))?>
</div>
<?php } //FIN if($tipo_vista=='LISTA'){ ?>
