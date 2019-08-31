<?php 
$evento=$_POST["evento_contenido"];
$item=$_POST["item_contenido"];
?>

 <form id="form_windows" name="form_windows">
		<input type="hidden" id="opcion_windows" name="opcion_windows" value=""/>
		<input type="hidden" id="accion_windows" name="accion_windows" value=""/>
        <input type="hidden" id="evento_windows" name="evento_windows" value="<?php echo $evento;?>"/>
        <input type="hidden" id="item_windows" name="item_windows" value="<?php echo $item;?>"/>
<input  type="hidden" id="alto_windows" name="alto_windows" value="300"/>
<input  type="hidden" id="ancho_windows" name="ancho_windows" value="500"/>
	<div id="datos" >	
	
	</div> 
</form>


