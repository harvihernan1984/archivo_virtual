<?php 
$evento=$_POST["evento_contenido"];
$item=$_POST["item_contenido"];
?>
<script>
function asigan_cod_item(obj,cod){
	var padre=$("#"+obj).parent().parent().attr('id');
		$("#"+padre+" input").each(function (index) {
			if($(this).attr("id")=='codigo_val'){
            	if($(this).attr("value")==''){
					$(this).attr("value",cod);
				}
            }
        });
}
function renombra_obj_atr(){
		$("#frm_op input").each(function (index) {
        	var new_nombre=$(this).attr("id") + "_atr";
        	$(this).attr("id",new_nombre);
        	$(this).attr("name",new_nombre); 
        });
		$("#frm_op select").each(function (index) {
        	var new_nombre=$(this).attr("id") + "_atr";
        	$(this).attr("id",new_nombre);
        	$(this).attr("name",new_nombre); 
        });
}

function guardar_val_item(obj){
	if (guardando==false ){
		guardando=true;
    	$("#item_tributo").attr('value',obj);
		var fila=$("#"+obj).parent().parent().attr('id');
		$("#frm_op").html($("#"+fila).clone());
		auto_select(fila,'frm_op');
    	renombra_obj_atr();
		$("#accion_windows").attr('value','guardar');
		var aux='no entro';
		$.ajax({ 
			type: 'POST',
			async: true, 
			data: $('#form_windows').serialize() + "&"+$('#frm_op').serialize(),
			url: "acciones_windows.php?op=at",  
			success: function(data) {  
				$('#sis_resultado').html(data);
				$("#div_cargar").css('visibility','hidden');
				guardando=false;
			}  
		});
	} else{mensaje('El sistema aun esta procesando... Espere un momento por favor...');}
}
function addfila_val_item(fila){
	var num_op=new Number($("#num_op").attr('value'));
	num_op=num_op+1;
	$("#num_op").attr('value',num_op);
	//alert(num_op);
	var new_fila="<tr id='fila_op"+num_op+"' >" + $("#"+fila).html() + "</tr>";
	$("#tabla_opciones").append(new_fila);
	$("#fila_op"+num_op+" a").each(function (index) {
		if($(this).attr("id")=='cmd_guarda_val_item'){cod2=$(this).attr("id",'cmd_guarda_val_item'+num_op);}
 	    if($(this).attr("id")=='cmd_borra_val_item'){cod2=$(this).attr("id",'cmd_borra_val_item'+num_op);}
 	});	
	$("#fila_op"+num_op+" input").each(function (index) {
		$(this).removeClass( "textbox-invalid" );
 	});	
	
}
function borra_val_item(obj){
	var padre=$("#"+obj).parent().parent().attr('id');
	$("#"+padre+" input").each(function (index) {
		if($(this).attr("id")=='codigo_val'){
			if($(this).attr("value")==''){
				$("#"+padre).remove();
			}
			else{
					var cod=$(this).attr("value");
					$.messager.confirm('Mensaje del sistema', 'Esta seguro de borrar el atributo del documento... ?', function(r){
						if (r){
							$("#accion_windows").attr('value','guardar');
							$("#item_tributo").attr('value',cod);
							$.ajax({ 
									type: 'POST',
									async: true, 
									data: $('#form_windows').serialize(),
									url: "acciones_windows.php?op=bt", 
									success: function(data) { 
										$('#sis_resultado').html(data);
										$("#"+padre).remove();
									}  
							});
						}
					});
			}
			
			
			//cod2=$(this).attr("id",'cmd_guarda_val_item'+num_op);
		}
 	});


}
</script>
 <form id="form_windows" name="form_windows" novalidate>
		<input type="hidden" id="opcion_windows" name="opcion_windows" value=""/>
		<input type="hidden" id="accion_windows" name="accion_windows" value=""/>
        <input type="hidden" id="evento_windows" name="evento_windows" value="<?php echo $evento;?>"/>
        <input type="hidden" id="item_windows" name="item_windows" value="<?php echo $item;?>"/>
		<input type="hidden" id="item_tributo" name="item_tributo" value=""/>
<input  type="hidden" id="alto_windows" name="alto_windows" value="500"/>
<input  type="hidden" id="ancho_windows" name="ancho_windows" value="600"/>
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
 <form style="visibility:hidden;" id="frm_op" name="frm_op"></form>

