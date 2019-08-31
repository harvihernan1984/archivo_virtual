<?php 
$codigo=$_GET["codigo"];
$empresa=$_POST["empresa"];
if ($codigo !=''){$sql="select codigo, get_directorio(codigo) as nombre_directorio from gd_contenedor where codigo='".$codigo."'";	}
else{$sql="SELECT directorio as codigo, get_directorio(directorio) as nombre_directorio FROM gd_empresa where codigo='".$empresa."'";	}
$res=pg_query($conn,$sql);
$reg=pg_fetch_array($res);
$nombre=$reg["nombre_directorio"];
$codigo_pro=$reg["codigo"];
echo "
<script type=''>
	$('#directorio').attr('value','".$codigo_pro."');
	$('#nombre_directorio').attr('value','".$nombre."');
</script>
";
?> 

