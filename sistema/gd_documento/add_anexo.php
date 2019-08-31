<?php 
//require_once("../../conexion.php");
$docu=$_POST["codigo"];	
$num_anexos=$_POST["num_anexos"];
$emp=$_SESSION["empresa_act"];
//echo $directorio;
?>
<div id="div_anexo<?php echo $num_anexos;?>">
<iframe  name="iframe<?php echo $num_anexos;?>" id="iframe<?php echo $num_anexos;?>" 
width="99%"  frameborder="0" scrolling="no" style="height:26px;border:none; overflow:hidden;" 
src="<?php  echo $directorio;?>/gestion_documental/archivo/documento.php?empresa=<?php  echo $emp;?>&documento=<?php  echo $docu;?>&codigo=&error="	/>
</div>

