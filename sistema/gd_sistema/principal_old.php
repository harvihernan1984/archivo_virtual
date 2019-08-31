<?php
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "<script type=''> alert('Por favor inicie sesion');</script>"; return false;}
$carpeta=$_GET["carpeta"];
$nform=$_SESSION["nform"];

?>
<script>
function guardar_clave(){
		var ca=$("#carpeta").attr('value');
		var co=$("#codigo").attr('value');
		//alert($('#form').serialize());
		$.ajax({ 
		 	type: 'POST',
			async: false, 
			data: $('#form').serialize(), 
            url: ca+"guardar.php",  
            success: function(data) {  
                if(data!="ok"){alert("Ocurrio un problema " + data);} 
				if(data=="ok"){
					alert('Datos guardados coerrectamente');
				}
				
            }  
        });
		
		Acciones(0);
	}
</script>
<form   method='post' id='form' name='form'>
<input type='hidden' id='carpeta' name='carpeta' value='<?php echo $carpeta; ?>'>
<input type='hidden' id='nombre_form' name='nombre_form' value='Cambiar clave'>
<input type='hidden' id='ancho_form' name='ancho_form' value='500'>
<input type='hidden' id='alto_form' name='alto_form' value='250'>
<!--<div align="center" style="width: 900px; height: 479px;" >-->
<div id="winVP" style="position: relative; top:-65px; height: 800px; border:none; margin: 10px;"></div>  
<div  id="frm" style="width: 555px; height: 279px; ">
	
	<div align="left" id="encabezad" >
		<table class='tableestilo'>
			<tr>
				<td width='36' align='right'>
					<a id="cmd_save" href='javascript:void(0)' title='Guardar' onClick="guardar_clave()">
					<img src='<?php echo $directorio; ?>/img/botones/guardar.png' width='36' height='33'   style=" background:#EAEAEA;" 
				    onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';" ></a>
				</td>
			</tr>
		</table>
	</div>
	<div id="datos" >	
	
	</div> 
</div>
<!--</div>-->
</form>

