<?php
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "por favor inicie seccion"; return false;}
$carpeta=$_GET["carpeta"];
?> 
<form   method='post' id='form' name='form'>
<input type='hidden' id='carpeta' name='carpeta' value='<?php echo $carpeta; ?>'>
<input type='hidden' id='nombre_form' name='nombre_form' value='Permisos de Acceso'>
<input type='hidden' id='ancho_form' name='ancho_form' value='730'>
<input type='hidden' id='alto_form' name='alto_form' value='450'>
<!--<div align="center" style="width: 900px; height: 479px;" >-->
<div id="winVP" style="position: relative; top:-65px; height: 800px; border: #cecece 1px solid; margin: 10px;"></div> 
<div  id="frm"  style="width: 685px; height: 400px; ">
	<div align="left" id="encabezad" >
		<table class='estilo_tabla' >
			<tr>
				<td width='36' align='right'>
					<a id="cmd_guardar2" href='javascript:void(0)' title='Guardar' onClick="guardar()">
				<img src='<?php echo $directorio; ?>/img/botones/guardar.png' width='36' height='33'   style=" background:#EAEAEA;" 
				    onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';" ></a></td>
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
	<div id="datos"  style="height:350px;">	
		<samp style="left: 10px;"></samp>
	</div> 
</div>
<!--</div>-->
</form>

