<?php 
$evento=$_POST["evento_contenido"];
$item=$_POST["item_contenido"];
?>
<script>
function mostrar_atributos(){
		$("#accion_windows").attr('value','atributos_documento');
		$.ajax({ 
				type: 'POST',
				async: true, 
				data: $('#form_windows').serialize() + "&"+$('#form_windows_center').serialize(),
				url: "acciones_windows.php",  
				success: function(data) { 
					$("#atributos_documento").html(data); 
				}  
		});
}
function Addanexo(){
		$("#accion_windows").attr('value','add_anexo');
		var num_anexo=new Number($("#num_anexos").attr('value'));
		num_anexo=Number(num_anexo) + 1;
		$("#num_anexos").attr('value',num_anexo);
		$.ajax({ 
				type: 'POST',
				async: false,
				data: $('#form_windows').serialize() + "&"+$('#form_windows_center').serialize(),
				url: "datos_windows.php",  
				success: function(data) {  
					$("#anexos_documento").append(data); 
					//cerrar_busqueda(); 
					$("#div_cargar").css('visibility','hidden');
					
				}  
		});
}
function pregunta(txt){
		$('#dlg_mensaje').html(txt);
		$('#dlg').dialog("buttons: [{text:'Ok',iconCls:'icon-ok',handler:function(){alert('ok');}},{text:'Cancel',handler:function(){alert('cancel');;}}]");
		$('#dlg').dialog('open');
	}
function get_cod_docu(){
	var  res=$("#codigo_docu").attr('value');
	return res;
}
function guardar_anexo_desc(id){
		if(aux_guardar==false){
			aux_guardar=true;
			$("#item_anexo").attr('value',id);
			$("#accion_windows").attr('value','guardar');
			$.ajax({ 
				type: 'POST',
				async: true, 
				data: $('#form_windows').serialize() + "&"+$('#frm_op').serialize(),
				url: "acciones_windows.php?op=act",  
				success: function(data) {  
					$('#sis_resultado').html(data);
					$("#div_cargar").css('visibility','hidden');
					aux_guardar=false;
				}  
			});
		}else{mensaje('Se esta ejecutando un proceso...<br> Espere un momento por favor... ');}
}
function borrar_anexo(id){
	$("#item_anexo").attr('value',id);
	$("#accion_windows").attr('value','guardar');
	$.messager.confirm('Mensaje del Sistema', 'Esta seguro de Borrar el documento?...', function(r){
				if (r){
						$.ajax({ 
						type: 'POST',
						async: true, 
						data: $('#form_windows').serialize() + "&"+$('#frm_op').serialize(),
						url: "acciones_windows.php?op=borrar",  
						success: function(data) {  
							$('#sis_resultado').html(data);
							$("#div_cargar").css('visibility','hidden');
						}  
					});
				}
	});
}
</script>

 <form id="form_windows" name="form_windows">
		<input type="hidden" id="opcion_windows" name="opcion_windows" value=""/>
		<input type="hidden" id="accion_windows" name="accion_windows" value=""/>
        <input type="hidden" id="evento_windows" name="evento_windows" value="<?php echo $evento;?>"/>
        <input type="hidden" id="item_windows" name="item_windows" value="<?php echo $item;?>"/>
		<input type="hidden" id="item_anexo" name="item_anexo" value=""/>
<input  type="hidden" id="alto_windows" name="alto_windows" value="550"/>
<input  type="hidden" id="ancho_windows" name="ancho_windows" value="700"/>
	<div align="left" id="encabezad" >
		<div id="toolbar" class="datagrid-toolbar" style=" position:relative; top:-10px; left:-10px;  ">
			<a id="cmd_nuevo" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="guardar()" plain="true" href="javascript:void(0)" >
			<span class="l-btn-left l-btn-icon-left">
			<span class="l-btn-text">Guardar</span>
			<span class="l-btn-icon guardar"> </span>
			</span>
			</a>
		</div>
	</div>
	<div id="datos" >	
	
	</div> 
</form>


