<?php
require_once("../../conexion.php");
if(ValidaUsuario()==false){echo "por favor inicie seccion"; return false;}
$carpeta=$_GET["carpeta"];
?>

<form   method='post' id='form' name='form'>
<input type='hidden' id='carpeta' name='carpeta' value='<?php echo $carpeta; ?>'>
<input type='hidden' id='nombre_form' name='nombre_form' value='EMPRESA'>
<input type='hidden' id='ancho_form' name='ancho_form' value='550'>
<input type='hidden' id='alto_form' name='alto_form' value='240'>
<div id="winVP" style="position: relative; top:-65px; height: 800px; border: #cecece 1px solid; margin: 10px;"></div> 
<div  id="frm"  style="width: 400px; height: 300px;">
	<div align="left" id="encabezad" style=" position:relative; " > 
		<table class='tableestilo'>
			<tr>
				<td  width='36' align='right'><a id="cmd_nuevo" href='javascript:void(0)' title='Nuevo' onClick="nuevo();">
					<div align="left" style="width:90px;height:32px;background:#EAEAEA;border-radius:5px; border:#AAAAAA solid;border-width:2px;" 
                    			onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';" >
                    				<img src='<?php echo $directorio; ?>/img/botones/nuevo.gif' width='32' height='32' >
                    				<span style="color:#0000AA;  position:relative; left:0px; top:-13px; font-size:12px;">Nuevo</span>
                    			</div>
				</a></td>
				<td  width='36' align='right'><a id="cmd_guardar" href='javascript:void(0)' title='Guardar' onClick="guardar();">
					<div align="left" style="width:90px;height:32px;background:#EAEAEA;border-radius:5px; border:#AAAAAA solid;border-width:2px;" 
                    			onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';" >
                    				<img src='<?php echo $directorio; ?>/img/botones/guardar.png' width='32' height='32' >
                    				<span style="color:#0000AA;  position:relative; left:0px; top:-13px; font-size:12px;">Guardar</span>
                    			</div>
				</a></td>
				<td  width='36' align='right'><a id="cmd_editar" href='javascript:void(0)' title='Editar' onClick="editar();">
					<div align="left" style="width:90px;height:32px;background:#EAEAEA;border-radius:5px; border:#AAAAAA solid;border-width:2px;" 
                    			onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';" >
                    				<img src='<?php echo $directorio; ?>/img/botones/editar.png' width='32' height='32' >
                    				<span style="color:#0000AA;  position:relative; left:0px; top:-13px; font-size:12px;">Editar</span>
                    			</div>
				</a></td>
				<td  width='36' align='right'><a id="cmd_cancelar" href='javascript:void(0)' title='Cancelar' onClick="cancelar();">
					<div align="left" style="width:90px;height:32px;background:#EAEAEA;border-radius:5px; border:#AAAAAA solid;border-width:2px;" 
                    			onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';" >
                    				<img src='<?php echo $directorio; ?>/img/botones/cancelar.png' width='32' height='32' >
                    				<span style="color:#0000AA;  position:relative; left:0px; top:-13px; font-size:12px;">Cancelar</span>
                    			</div>
				</a></td>
				<td  width='36' align='right'><a id="cmd_buscar" href='javascript:void(0)' title='Buscar'	onClick="buscar('');">
					<div align="left" style="width:90px;height:32px;background:#EAEAEA;border-radius:5px; border:#AAAAAA solid;border-width:2px;" 
                    			onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';" >
                    				<img src='<?php echo $directorio; ?>/img/botones/ico-lupa.png' width='32' height='32' >
                    				<span style="color:#0000AA;  position:relative; left:0px; top:-13px; font-size:12px;">Buscar</span>
                    			</div>
				</a></td>
				<td width='10' align='right'>&nbsp;</td>
				<td id="col_primero" width='36' align='right'>
				<a id="cmd_primero" href='javascript:void(0)' title='Primero' onClick="primero();">
					<div align="center" style=" width:40px;background:#EAEAEA; border-radius:5px; border:#AAAAAA solid; border-width:2px;" 
                    onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';" >
                    <img src='<?php echo $directorio; ?>/img/botones/primero.png' width='24' height='24' >
                    </div>
				</a></td>
				<td  width='36' align='right'>
				<a id="cmd_anterior" href='javascript:void(0)' title='Anterior' onClick="anterior();">
					<div align="center" style=" width:40px;background:#EAEAEA; border-radius:5px; border:#AAAAAA solid; border-width:2px;" 
                    onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';" >
                    <img src='<?php echo $directorio; ?>/img/botones/anterior.png' width='24' height='24' >
                    </div>
				</a></td>
				<td  width='36' align='right'>
				<a id="cmd_siguiente" href='javascript:void(0)' title='Siguiente' onClick="siguiente();">
					<div align="center" style=" width:40px;background:#EAEAEA; border-radius:5px; border:#AAAAAA solid; border-width:2px;" 
                    onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';" >
                    <img src='<?php echo $directorio; ?>/img/botones/siguiente.png' width='24' height='24' >
                    </div>
				</a></td>
				<td  width='36' align='right'><a id="cmd_ultimo" href='javascript:void(0)' title='Ultimo' onClick="ultimo();">
					<div align="center" style=" width:40px;background:#EAEAEA; border-radius:5px; border:#AAAAAA solid; border-width:2px;" 
                    onMouseOver="this.style.backgroundColor='#999999';" onMouseOut="this.style.backgroundColor='#EAEAEA';" >
                    <img src='<?php echo $directorio; ?>/img/botones/ultimo.png' width='24' height='24' >
                    </div>
				</a></td>
				
				
			</tr>
		</table>
	</div>
	<div id="datos" style="position:relative; " >	
	
	</div> 
	
</div>

</form>

