<?php //require_once("../../conexion.php"); 

$empresa=$_POST["empresa"];
if($filtro_fecha=="-1"){
	$msg= "Seleccione  una Empresa para continuar...";
	echo "<script>mensaje('".$msg."');</script>";
	return false;
}
$tipo_filtro=$_POST["tipo_filtro"];
$tipo_documento=$_POST["tipo_documentos"];
//$empresa=$_POST["empresa"];
$txt_filtro=f_sin_sql($txt_filtro);
unset($campos);
$campos=explode(",",$tipo_filtro);
$filtro="";
	//$filtro=f_genera_filtro($direc,$codigo," and ");
	//$filtro=" AND UPPER(CONCAT(".$tipo_filtro.")) LIKE '%".$txt_filtro."%'";
//if($txt_filtro!=""){$filtro=" and upper(".f_concatena($campos).") like upper('%".$txt_filtro."%')";}

$limite_reg="OFFSET (".$_POST["txt_pagina_act"] ." -1) * (".$_POST["limite_reg"].") limit  ". $_POST["limite_reg"];
$contenedor=$_POST["codigo_folder"];

///FILTRO PARA TIPO DE DOCUMENTO
$filtro_x_tipo_doc="";
if($tipo_documento!='-1'){$filtro_x_tipo_doc=" and gd_doc.tipo='".$tipo_documento."'";}
$filtro=$filtro_x_tipo_doc.$filtro;
//FILTRO PARA EMPRESA
$filtro_x_empresa="";
if($empresa!='-1'){$filtro_x_empresa=" and gd_doc.empresa='".$empresa."'";}
$filtro=$filtro_x_empresa.$filtro;
$filtro_x_contendor="";
if($contenedor!=""){$filtro_x_contendor=" and gd_doc.contenedor='".$contenedor."'";}
$filtro=$filtro_x_contendor.$filtro;

$sql="SELECT (count(gd_doc.*) /  ".$_POST["limite_reg"]." ) + 1 as total_paginas, count(gd_doc.*) as total_doc,  
(select get_numero(valor) from sis_configuracion where codigo='NUM_EXP' and tipo='CONF') as limte_reg_conf
FROM gd_documento gd_doc where gd_doc.borrado='N' and gd_doc.empresa in(select cod from sis_accesos_rol_usuario ('".$_SESSION["gd_usuario"]."','gd_empresa_inf','')) ".$filtro;
if($exportando=="SI"){$limite_reg="";}
$res=pg_query( $conn,$sql);
$reg=pg_fetch_array($res);
$total_pg=$reg["total_paginas"];
$total_doc=$reg["total_doc"];
$limte_reg_conf=$reg["limte_reg_conf"];
$_SESSION["gd_msg_exportando"]='SI';
$_SESSION["gd_exportando_numero"]=0;
$_SESSION["gd_exportando_limite"]=0;
if($exportando=="SI"){
	if($total_doc>$limte_reg_conf && $limte_reg_conf!=0 ){
    	$_SESSION["gd_msg_exportando"]='NO';
    	$_SESSION["gd_exportando_numero"]=$total_doc;
		$_SESSION["gd_exportando_limite"]=$limte_reg_conf;
    }
}
//echo $filtro;
//echo "hola";
?>
<style type="text/css">
        #fm{
            margin:0;
            padding:10px 30px;
        }
        .ftitle{
            font-size:14px;
            font-weight:bold;
            padding:5px 0;
            margin-bottom:10px;
            border-bottom:1px solid #ccc;
        }
        .fitem{
            margin-bottom:5px;
        }
        .fitem label{
            display:inline-block;
            width:80px;
        }
        .fitem input{
            width:160px;
        }
		.fila_tabla td{
        	<?php if($exportando=="SI"){ echo "border:#000 solid 1px;";} ?>
			
		}
</style>
<div class="divgrid"   >
<table width="988" border="0" cellpadding="0" cellspacing="0"   id="tabla_opciones"   >
		 <thead>
		 <?php if($exportando=="SI"){ ?>
		 <tr id="fila_op_titulo"  >
		  <th colspan="15" style="background:none;"  align="center" ><em style="font-size:16px;">INVENTARIO DE DOCUMENTOS</em></th>
		  </tr>
		  <tr id="fila_op_titulo"  >
		  <th colspan="15" style="background:none;"  align="center" >&nbsp;</th>
		  </tr>
		   <?php } ?>		  
		    <tr id="fila_op_titulo" style="background:#CCCCCC; font-size:8px;"  >
		  <th width="43" rowspan="2"  >N. CAJA </th>
		  <th width="52" rowspan="2" >N. EXPEDIENTE </th>
  	    	<th width="109" rowspan="2" >PRODUCTO DOCUMENTAL </th>
  	    	<th width="181" rowspan="2" >CONTENIDO ASUNTO </th>
  	    	<th colspan="2" >FECHAS EXPEDIENTES </th>
  	    	<th colspan="6" >ESTADO DEL DOCUMENTO FISICO O DIGITAL </th>
  	    	<th width="157" rowspan="2" >UBICACION EXPEDIENTE </th>
  	    	<th width="32" rowspan="2" >DATOS DEL RESPO NSABLE </th>
  	    	<th width="54" rowspan="2" >OBSERV ACIONES</th>
		    </tr>
		    <tr id="fila_op_titulo" style="background:#CCCCCC; font-size:8px;"  >
		      <th >APERTURA</th>
	          <th width="43" >CIERRE</th>
	          <th width="28" >N. FOJAS </th>
	          <th width="61" >TIPO CONTENEDOR </th>
	          <th width="50" >ORIGINAL O COPIA </th>
	          <th width="40" >ESTADO</th>
	          <th width="48" >LEGIBI LIDAD              </th>
	          <th width="38" >DIGITALI ZACION</th>
	       </tr>

	</thead>
			<tbody>
		<?php 
		$sql="select 
(select nombre from gd_contenedor where codigo=(select contenedor_padre from gd_contenedor where codigo=gd_doc.contenedor)) as caja, 
codificacion  as expediente,
(select nombre from gd_tipo_documento where codigo=gd_doc.tipo) as producto_documental,
gd_get_datos_documentos_campos(gd_doc.datos_documento,gd_doc.tipo) as contenido,
'' as apertura,
'' as cierre,
coalesce((select sum(fojas) from gd_documento_anexo where documento=gd_doc.codigo and borrado='N'),0) as fojas,
(select nombre from gd_tipo_contenedor where codigo=(select tipo from gd_contenedor where codigo=gd_doc.contenedor)) as tipo_contenedor,
'' as original_copia,
'' as estado,
'' as legibilidad,
case when (select count(*) from gd_documento_anexo where documento=gd_doc.codigo and borrado='N') > 0 then 'SI' else 'NO' end as digitalizacion,
get_directorio_documento(gd_doc.contenedor) as ubicacion,
'' as responsable,
'' as observacion
from gd_documento gd_doc where gd_doc.borrado='N' and gd_doc.empresa in(select cod from sis_accesos_rol_usuario ('".$_SESSION["gd_usuario"]."','gd_empresa_inf',''))  ".$filtro." order by  cast(gd_doc.contenedor as integer),cast(gd_doc.codigo as integer) ".$limite_reg;
		//echo $sql;
		$num_reg=0;
		$res=pg_query( $conn,$sql);
		while ($fila = pg_fetch_array($res)) {$num_reg++;
		?>
		<tr id="fila_op" class="fila_tabla"    >
		<td width="43"  align="left" ><?php echo $fila["caja"]; ?></td>
		<td width="52" align="left"  ><?php echo $fila["expediente"]; ?></td>
		<td width="109" align="left"  ><?php echo $fila["producto_documental"]; ?></td>
		<td width="181" align="left"  ><?php echo $fila["contenido"]; ?></td>
		<td width="52" align="left"  ><?php echo $fila["apertura"]; ?></td>
		<td width="43" align="left"  ><?php echo $fila["cierre"]; ?></td>
		<td width="28" align="center" ><?php echo $fila["fojas"]; ?></td>
		<td width="61" align="left"  ><?php echo $fila["tipo_contenedor"]; ?></td>
		<td width="50" align="left"  ><?php echo $fila["original_copia"]; ?></td>
		<td width="40" align="left"  ><?php echo $fila["estado"]; ?></td>
		<td width="48" align="left"  ><?php echo $fila["legibilidad"]; ?></td>
		<td width="38" align="left"  ><?php echo $fila["digitalizacion"]; ?></td>
		<td width="157" align="left"  ><?php echo $fila["ubicacion"]; ?></td>
		<td width="32" align="left"  ><?php echo $fila["responsable"]; ?></td>
		<td width="54" align="left"  ><?php echo $fila["observacion"]; ?></td>
		</tr>
		<?php }//for($i=1;$i<=20;$i++){ ?>
		</tbody>
</table>	
<?php if($exportando!="SI"){ ?>
  <script>$("#txt_paginas").html(<?php echo "'".$_POST["txt_pagina_act"]." de ".$total_pg."'" ; ?>);$("#txt_total_pagina").attr('value','<?php echo $total_pg; ?>');</script>
 <?php }?>
</div>

