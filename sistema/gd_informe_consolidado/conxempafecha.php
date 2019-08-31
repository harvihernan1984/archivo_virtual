<?php //require_once("../../conexion.php"); 

$filtro_fecha=$_POST["fecha_filtro_fin"];
if(f_validateDateEs($filtro_fecha)==false){ $filtro_fecha="";}
if($filtro_fecha==""){
	$msg= "Seleccione hasta que fecha requiere el informe";
	echo "<script>mensaje('".$msg."');</script>";
	return false;
}
$tipo_filtro=$_POST["tipo_filtro"];
$tipo_documentos=$_POST["tipo_documentos"];
$empresa=$_POST["empresa"];
$txt_filtro=f_sin_sql($txt_filtro);
unset($campos);
$campos=explode(",",$tipo_filtro);
$filtro="";
	//$filtro=f_genera_filtro($direc,$codigo," and ");
	//$filtro=" AND UPPER(CONCAT(".$tipo_filtro.")) LIKE '%".$txt_filtro."%'";
//if($txt_filtro!=""){$filtro=" and upper(".f_concatena($campos).") like upper('%".$txt_filtro."%')";}

$limite_reg="OFFSET (".$_POST["txt_pagina_act"] ." -1) * (".$_POST["limite_reg"].") limit  ". $_POST["limite_reg"];

///FILTRO PARA TIPO DE DOCUMENTO
$filtro_x_empresa="";
if($empresa!='-1'){$filtro_x_empresa=" and codigo='".$empresa."'";}
$filtro=$filtro_x_empresa.$filtro;

$filtro_tipo_doc="";
if($tipo_documentos!='-1'){
	$filtro_tipo_doc=" and tipo='".$tipo_documentos."'";
}

$sql="SELECT (count(*) /  ".$_POST["limite_reg"]." ) + 1 as total_paginas  FROM gd_empresa where borrado='N' and codigo in(select cod from sis_accesos_rol_usuario ('".$_SESSION["gd_usuario"]."','gd_empresa_inf','')) ".$filtro;
if($exportando=="SI"){$limite_reg="";}
$res=pg_query( $conn,$sql);
$reg=pg_fetch_array($res);
$total_pg=$reg["total_paginas"];
//echo $filtro;
$col_spam=3;
$sql2="SELECT count(*) as cant FROM gd_tipo_documento ".$filtro_para_tipo; 
$res2=pg_query( $conn,$sql2);
$fila2 = pg_fetch_array($res2);
$col_spam=$col_spam + $fila2["cant"];
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
</style>
<div class="divgrid"   >
<table width="100%" border="0" cellpadding="0" cellspacing="0"   id="tabla_opciones"   >
		 <thead>
		 <?php if($exportando=="SI"){ ?>
		 <tr id="fila_op_titulo"  >
		  <th colspan="<?php echo $col_spam; ?>" style="background:none; font-size:20px; font-style:italic;"  align="center" >Informe de Inventario Consolidado</th>
		  </tr>
		  <tr id="fila_op_titulo"  >
		  <th colspan="<?php echo $col_spam; ?>" style="background:none;"  align="center" ><em style="font-size:14px;">Hasta  el <?php echo $filtro_fecha; ?></em></th>
		  </tr>
		   <tr id="fila_op_titulo"  >
		  <th colspan="<?php echo $col_spam; ?>" style="background:none;"  align="center" >&nbsp;</th>
		  </tr>
		  <?php } ?>
		    <tr id="fila_op_titulo" style="background:#CCCCCC;"  >
		  <th width="460"  >NOMBRE EMPRESA</th>
		   <th width="133" >DOCUMENTOS REGISTRADOS</th>
		  <th width="133" >DOCUMENTOS CON ANEXOS</th>
            <?php $sql2="SELECT codigo, nombre, abreviatura FROM gd_tipo_documento ".$filtro_para_tipo." order by nombre"; 
            	//echo $sql2;
            	$res2=pg_query( $conn,$sql2);
            	while ($fila2 = pg_fetch_array($res2)) { ?>
                <th width="50" ><?php echo $fila2["abreviatura"]; ?></th>
              <?php  } ?>
  	    	</tr>
			</thead>
			<tbody>
		<?php 
		$sql="  select codigo,nombre, (select count(*) from gd_documento where gd_empresa.codigo=empresa and gd_empresa.borrado='N' and gd_documento.borrado='N' ".$filtro_tipo_doc." and cast(fecha_registro as date) <= cast('".$filtro_fecha."' as date) ) as cantidad_doc ,
  (select count(*) from gd_documento where gd_empresa.codigo=empresa and gd_empresa.borrado='N' and gd_documento.borrado='N'  ".$filtro_tipo_doc." and cast(fecha_registro as date) <= cast('".$filtro_fecha."' as date) and codigo in(select documento from gd_documento_anexo where documento=gd_documento.codigo and empresa=gd_empresa.codigo) ) as cantidad_con_anexo
from gd_empresa where borrado='N' and codigo in(select cod from sis_accesos_rol_usuario ('".$_SESSION["gd_usuario"]."','gd_empresa_inf','')) ".$filtro."order by  nombre ".$limite_reg;
		//echo $sql; cast('".$filtro_fecha."' as date)
		$num_reg=0;
		$res=pg_query( $conn,$sql);
		while ($fila = pg_fetch_array($res)) {$num_reg++;
		?>
		<tr id="fila_op" class="fila_tabla"    >
		<td width="460"  ><?php echo $fila["nombre"]; ?></td>
		<td width="100" align="center"  ><?php echo $fila["cantidad_doc"]; ?></td>
		<td width="100" align="center"  ><?php echo $fila["cantidad_con_anexo"]; ?></td>
        <?php $sql2="SELECT (select count(*) from gd_documento where empresa='".$fila["codigo"]."' and tipo=gd_tipo_documento.codigo and borrado='N' 
        and cast(fecha_registro as date) <= cast('".$filtro_fecha."' as date) ) as cant FROM gd_tipo_documento ".$filtro_para_tipo." order by nombre"; 
               //echo $sql2;
            	$res2=pg_query( $conn,$sql2);
            	while ($fila2 = pg_fetch_array($res2)) {?>
                <td width="50" align="center"  ><?php echo $fila2["cant"]; ?></td>
              <?php  } ?>
		</tr>
		<?php }//for($i=1;$i<=20;$i++){ ?>
		</tbody>
</table>	
<?php if($exportando!="SI"){ ?>
  <script>$("#txt_paginas").html(<?php echo "'".$_POST["txt_pagina_act"]." de ".$total_pg."'" ; ?>);$("#txt_total_pagina").attr('value','<?php echo $total_pg; ?>');</script>
 <?php }?>
</div>

