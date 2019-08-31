<?php
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "por favor inicie seccion"; return false;}
$carpeta=$_GET["carpeta"];
?>
<script>
function establecer(){
		$("#div_cargar").css('visibility','visible');
		var ca=$("#carpeta").attr('value');
		$.ajax({ 
				type: 'POST',
				async: false,
				data: $('#form').serialize(), 
				url: ca+"guardar.php",  
				success: function(data) {  
					$("#resul_emp").html(data); 
					$("#div_cargar").css('visibility','hidden');
				}  
		});

}


</script>
<form   method='post' id='form' name='form'>
<input type='hidden' id='carpeta' name='carpeta' value='<?php echo $carpeta; ?>'>
<input type='hidden' id='nombre_form' name='nombre_form' value='ESTABLECER EMPRESA ACTIVA'>
<input type='hidden' id='ancho_form' name='ancho_form' value='550'>
<input type='hidden' id='alto_form' name='alto_form' value='150'>
<div id="winVP" style="position: relative; top:-65px; height: 800px; border: #cecece 1px solid; margin: 10px;"></div> 
<div  id="frm"  style="width: 400px; height: 300px;">
	<div align="left" id="encabezad" style=" position:relative; " > 
	<table class='tableestilo'>
		<tr>
		<td  width='36' align='right'><a id="cmd_establecer" href='javascript:void(0)' title='Establecer' onClick="establecer();">
		<div align="left" style="width:110px;height:32px;background:#EAEAEA;border-radius:5px; border:#AAAAAA solid;border-width:2px;" 
		onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';" >
		<img src='<?php echo $directorio; ?>/img/botones/48px-Crystal_Clear_action_apply.png' width='32' height='32' >
		<span style="color:#0000AA;  position:relative; left:0px; top:-13px; font-size:12px;">Establecer</span>
		</div>
		</a></td>
		</tr>
	</table>
	</div>
	<div id="datos" style="position:relative; " >	
	
	</div> 
	<div id="resul_emp"></div>
</div>

</form>

