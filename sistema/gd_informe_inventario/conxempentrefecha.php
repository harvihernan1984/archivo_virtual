<?php //require_once("../../conexion.php"); 

$filtro_fecha_fin=$_POST["fecha_filtro_fin"];
$filtro_fecha_ini=$_POST["fecha_filtro_ini"];
if($filtro_fecha_fin=="" or $filtro_fecha_ini=="" ){
	$msg= "Seleccione  las fechas del rango del informe";
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

$sql="SELECT (count(*) /  ".$_POST["limite_reg"]." ) + 1 as total_paginas  FROM gd_empresa where codigo<>'0' ".$filtro;
if($exportando=="SI"){$limite_reg="";}
$res=pg_query( $conn,$sql);
$reg=pg_fetch_array($res);
$total_pg=$reg["total_paginas"];
//echo $filtro;

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
<table width="593" border="0" cellpadding="0" cellspacing="0"   id="tabla_opciones"   >
		 <thead>
		 <?php if($exportando=="SI"){ ?>
		 <tr id="fila_op_titulo"  >
		  <th colspan="2" style="background:none;"  align="center" ><em style="font-size:16px;">Informe de Consultas de Documentos Consolidado por Empresa</em></th>
		  </tr>
		  <tr id="fila_op_titulo"  >
		  <th colspan="2" style="background:none;"  align="center" >
		  <em style="font-size:14px;">Desde <?php echo $filtro_fecha_fin; ?> hasta  el <?php echo $filtro_fecha_fin; ?></em></th>
		  </tr>
		   <tr id="fila_op_titulo"  >
		  <th colspan="2" style="background:none;"  align="center" >&nbsp;</th>
		  </tr>
		  <?php } ?>
		    <tr id="fila_op_titulo" style="background:#CCCCCC;"  >
		  <th width="460"  >NOMBRE EMPRESA</th>
		  <th width="133" >CONSULTAS REALIZADAS</th>
  	    	</tr>
			</thead>
			<tbody>
		<?php 
		$sql="select nombre, 
(select count(*) from gd_registro_consultas 
where usuario in(select codigo from sis_usuario where empresa= gd_empresa.codigo )
and cast(fecha_hora as date) >= cast('".$filtro_fecha_ini."' as date) and cast(fecha_hora as date) <= cast('".$filtro_fecha_fin."' as date)
) as consultas 
from gd_empresa where codigo<>'0' ".$filtro."order by  nombre ".$limite_reg;
		//echo $sql;
		$num_reg=0;
		$res=pg_query( $conn,$sql);
		while ($fila = pg_fetch_array($res)) {$num_reg++;
		?>
		<tr id="fila_op" class="fila_tabla"    >
		<td width="460"  ><?php echo $fila["nombre"]; ?></td>
		<td width="133" align="center"  ><?php echo $fila["consultas"]; ?></td>
		</tr>
		<?php }//for($i=1;$i<=20;$i++){ ?>
		</tbody>
</table>	
<?php if($exportando!="SI"){ ?>
  <script>$("#txt_paginas").html(<?php echo "'".$_POST["txt_pagina_act"]." de ".$total_pg."'" ; ?>);$("#txt_total_pagina").attr('value','<?php echo $total_pg; ?>');</script>
 <?php }?>
</div>

