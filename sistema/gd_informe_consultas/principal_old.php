<?php
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "por favor inicie seccion"; return false;}
$carpeta=$_GET["carpeta"];
?>

<form   method='post' id='form' name='form'>
<input type='hidden' id='carpeta' name='carpeta' value='<?php echo $carpeta; ?>'>
<input type='hidden' id='nombre_form' name='nombre_form' value='Modulos'>
<input type='hidden' id='ancho_form' name='ancho_form' value='550'>
<input type='hidden' id='alto_form' name='alto_form' value='400'>
<div id="winVP" style="position: relative; top:-65px; height: 800px; border: #cecece 1px solid; margin: 10px;"></div> 
<div  id="frm"  style="width: 400px; height: 300px;">
	<div align="left" id="encabezad" style=" position:relative; " > 
		<table class='tableestilo'>
			<tr>
				<td width="36" align='left'  >
				<a id="cmd_nuevo"  href='javascript:void(0)'   title='Nuevo' onClick="nuevo()" >
					<img  src='<?php echo $directorio; ?>/img/botones/nuevo.gif' width='36px' height='33px' style=" background:#EAEAEA;" 
					onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';" ></a></td>
				<td width='36' align='right'>
					<a id="cmd_guardar" href='javascript:void(0)' title='Guardar' onClick="guardar()">
				<img src='<?php echo $directorio; ?>/img/botones/guardar.png' width='36' height='33'   style=" background:#EAEAEA;" 
				    onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';" ></a></td>
				<td width='36' align='right'><a id="cmd_editar" href='javascript:void(0)' title='Editar' onClick="editar()">
					<img src='<?php echo $directorio; ?>/img/botones/editar.png' width='36' height='33'  style=" background:#EAEAEA;"
					onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';"></a></td>
				<td en width='36' align='right'><a id="cmd_cancelar" href='javascript:void(0)' title='Cancelar' onClick="cancelar()">
					<img src='<?php echo $directorio; ?>/img/botones/cancelar.png' width='36' height='33'  style=" background:#EAEAEA;"
					onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';"></a></td>
				<td width='36' align='right'><a id="cmd_borrar" href='javascript:void(0)' title='Borrar' onClick="borrar()">
					<img src='<?php echo $directorio; ?>/img/botones/eliminar.gif' width='36' height='33'  style=" background:#EAEAEA;"
					onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';"></a></td>
				<td width='36' align='right'><a id="cmd_buscar" href='javascript:void(0)' title='Buscar' onClick="buscar('')">
				<img src='<?php echo $directorio; ?>/img/botones/ico-lupa.png' width='36' height='33'  style=" background:#EAEAEA;"
					onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';"></a></td>
				<td width='10' align='right'>&nbsp;</td>
				<td width='36' align='right'><a id="cmd_primero" href='javascript:void(0)' title='Primero' onClick="primero()">
				<img src='<?php echo $directorio; ?>/img/botones/primero.gif' width='36' height='33'  style=" background:#EAEAEA;"
				onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';"></a></td>
				<td width='36' align='right'><a id="cmd_anterior" href='javascript:void(0)' title='Anterior' onClick="anterior()">
					<img src='<?php echo $directorio; ?>/img/botones/anterior.gif' width='36' height='33'  style=" background:#EAEAEA;"
					onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';"></a></td>
				<td width='36' align='right'><a id="cmd_siguiente" href='javascript:void(0)' title='Siguiente' onClick="siguiente()">
					<img src='<?php echo $directorio; ?>/img/botones/siguiente.gif' width='36' height='33'  style=" background:#EAEAEA;"
					onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';"></a></td>
				<td width='36' align='right'><a id="cmd_ultimo" href='javascript:void(0)' title='Ultimo' onClick="ultimo()">
					<img src='<?php echo $directorio; ?>/img/botones/ultimo.gif' width='36' height='33'  style=" background:#EAEAEA;"
					onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';"></a></td>
				
				
			</tr>
		</table>
	</div>
	<div id="datos" style="position:relative; " >	
	
	</div> 
	
</div>

</form>

