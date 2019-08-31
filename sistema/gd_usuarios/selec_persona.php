<?php 
$codigo=$_GET["codigo"];
$sql="select * from gd_persona where codigo='".$codigo."'";	
$res=pg_query($conn,$sql);
$reg=pg_fetch_array($res);
$nombre=$reg["apellido"]." ".$reg["nombre"];
$codigo_pro=$reg["codigo"];
echo "
<script type=''>
	$('#persona').attr('value','".$codigo_pro."');
	$('#nom_persona').attr('value','".$nombre."');
</script>
";
?> 

