	
<script>
 function inicio(){
 	$("#txt_ubicaion").attr('value','');
	$("#txt_directorio").attr('value','');
	$('#region_center').panel({title:'Inicio'});
 	MuestraDatos_contenido();
 }
 function guardar_ori(){
 	$("#op_guardar").attr('value','ORI');
	var op=$("#opcion_contenido").attr('value');
	$("#opcion_windows").attr('value',op);
	guardar();
 }
  function guardar_dest(){
 	$("#op_guardar").attr('value','DEST');
	var op=$("#opcion_contenido").attr('value');
	$("#opcion_windows").attr('value',op);
	guardar();
 }
 function atras(){
 	$("#txt_ubicaion").attr('value','atras');
	$("#txt_tipo_contenedor").attr('value','');
	//$("#txt_directorio").attr('value','');
 	MuestraDatos_contenido();
 }
  function atras_dest(){
 	$("#txt_ubicaion_dest").attr('value','atras');
	$("#txt_tipo_contenedor_dest").attr('value','');
	//$("#txt_directorio").attr('value','');
 	MuestraDatos_contenido_dir('consulta_dest','datos_contenido_destino');
 }
 function abrir_contenido(ubicacion,padre,nombre,tipo){
 	var dire=$("#txt_directorio").attr('value');
	if (dire==''){var new_dir=ubicacion + ";" + padre; }
	else{ var new_dir=dire+ "|" + ubicacion + ";" + padre; }
	$("#txt_directorio").attr('value',new_dir);
	$("#txt_nombre").attr('value',nombre);
	$("#txt_ubicaion").attr('value',ubicacion);
	$("#txt_tipo_contenedor").attr('value',tipo);
	$("#txt_padre").attr('value',padre);
	$('#region_center').panel({title:ubicacion});
	MuestraDatos_contenido();
 }
  function abrir_contenido_dest(ubicacion,padre,nombre,tipo){
 	var dire=$("#txt_directorio_dest").attr('value');
	if (dire==''){var new_dir=ubicacion + ";" + padre; }
	else{ var new_dir=dire+ "|" + ubicacion + ";" + padre; }
	$("#txt_directorio_dest").attr('value',new_dir);
	$("#txt_nombre_dest").attr('value',nombre);
	$("#txt_ubicaion_dest").attr('value',ubicacion);
	$("#txt_tipo_contenedor_dest").attr('value',tipo);
	$("#txt_padre_dest").attr('value',padre);
	$('#region_center_dest').panel({title:ubicacion});
	MuestraDatos_contenido_dir('consulta_dest','datos_contenido_destino');
 }
 function editar_contenido(opcion,id){
 		$("#accion_contenido").attr('value','ventana');
		$("#evento_contenido").attr('value','EDIT');
		$("#opcion_contenido_windows").attr('value',opcion);
		$("#item_contenido").attr('value',id);
		MuestraForm(opcion);
  }
  function nuevo_contenido(){
 		var op=$("#txt_opcion").attr('value');
		if(op==''){op="gd_contenedor";}
		$("#accion_contenido").attr('value','ventana');
		$("#evento_contenido").attr('value','NEW');
		$("#opcion_contenido_windows").attr('value',op);
		$("#item_contenido").attr('value','');
		MuestraForm(op);
 
 }
function RefrescaDatos_contenido(){
	$("#txt_ubicaion").attr('value','refres');
	MuestraDatos_contenido();
}
function RefrescaDatos_contenido_dest(){
	$("#txt_ubicaion_dest").attr('value','refres');
	MuestraDatos_contenido_dir('consulta_dest','datos_contenido_destino');
}
function recibir(){
	var objeto_n='';
	var objeto='';
	var separador='';
	$("#columnas_dest input:checkbox").each(function (index) {
			if($(this).is(':checked')){
				objeto_n=$(this).attr('id');
				objeto=objeto_n.replace('item_dest','');
				//separador='|';
				$("#columnas_ori").append($('#objeto_dest'+objeto).clone());
				//$('#objeto'+objeto).remove();
				$("#columnas_dest").find('#objeto_dest'+objeto).remove();
				$('#objeto_dest'+objeto+' input').each(function (index) {
					if($(this).attr('id')=='codigo_dest[]'){
						$(this).attr('id', 'codigo_dest_movido[]');
						$(this).attr('name', 'codigo_dest_movido[]');
					}
				});
			}
	});
}
function enviar(){
	var objeto_n='';
	var objeto='';
	var separador='';
	$("#columnas_ori input:checkbox").each(function (index) {
			if($(this).is(':checked')){
				objeto_n=$(this).attr('id');
				objeto=objeto_n.replace('item_ori','');
				//separador='|';
				$("#columnas_dest").append($('#objeto_ori'+objeto).clone());
				//$('#objeto'+objeto).remove();
				$("#columnas_ori").find('#objeto_ori'+objeto).remove();
				$('#objeto_ori'+objeto+' input').each(function (index) {
					if($(this).attr('id')=='codigo_ori[]'){
						$(this).attr('id', 'codigo_ori_movido[]');
						$(this).attr('name', 'codigo_ori_movido[]');
					}
				});
			}
	});
}
function check_dest_all(){
	if ($('#chk_dest_all').is(":checked"))
	{
		$("#columnas_dest input:checkbox").each(function (index) {
			$(this).prop( "checked", true );
		});
	}
	else{
		$("#columnas_dest input:checkbox").each(function (index) {
			$(this).prop( "checked", false );
		});
	}
}
function check_ori_all(){
	if ($('#chk_ori_all').is(":checked"))
	{
		$("#columnas_ori input:checkbox").each(function (index) {
			$(this).prop( "checked", true );
		});
	}
	else{
		$("#columnas_ori input:checkbox").each(function (index) {
			$(this).prop( "checked", false );
		});
	}
}
</script>

	<div align="left" id="encabezad" >
			<input  type="hidden" id="op_guardar" name="op_guardar" value="" />
			<input  type="hidden" id="txt_directorio" name="txt_directorio" value="" />
			<input  type="hidden" id="txt_nombre" name="txt_nombre" value="" />
			<input  type="hidden" id="txt_directorio_nombre" name="txt_directorio_nombre" value="" />
			<input  type="hidden" id="txt_ubicaion" name="txt_ubicaion" value="" />
			<input  type="hidden" id="txt_padre" name="txt_padre" value="" />
			<input  type="hidden" id="txt_actual" name="txt_actual" value="" />
			<input  type="hidden" id="txt_opcion" name="txt_opcion" value="" />
			<input  type="hidden" id="txt_tipo_contenedor" name="txt_tipo_contenedor" value="" />
			<input  type="hidden" id="txt_directorio_dest" name="txt_directorio_dest" value="" />
			<input  type="hidden" id="txt_nombre_dest" name="txt_nombre_dest" value="" />
			<input  type="hidden" id="txt_directorio_nombre_dest" name="txt_directorio_nombre_dest" value="" />
			<input  type="hidden" id="txt_ubicaion_dest" name="txt_ubicaion_dest" value="" />
			<input  type="hidden" id="txt_padre_dest" name="txt_padre_dest" value="" />
			<input  type="hidden" id="txt_actual_dest" name="txt_actual_dest" value="" />
			<input  type="hidden" id="txt_opcion_dest" name="txt_opcion_dest" value="" />
			<input  type="hidden" id="txt_tipo_contenedor_dest" name="txt_tipo_contenedor_dest" value="" />
			<input type="hidden" id="opcion_windows" name="opcion_windows" value=""/>
			<input type="hidden" id="accion_windows" name="accion_windows" value=""/>
        	
	</div>
	<div>
			<div  style="border:1px solid #ccc;width:49%;height:750px;float:left;margin:2px;">
				<div id="toolbar" class="datagrid-toolbar" style=" position:relative; ">
					<span class="l-btn-text">Origen</span>
					<a id="cmd_guardar_origen" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="guardar_ori()" plain="true" href="javascript:void(0)" >
						<span class="l-btn-left l-btn-icon-left">
						<span class="l-btn-text">Guardar</span>
						<span class="l-btn-icon guardar"> </span>
						</span>
					</a>
					<a id="cmd_atras" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="atras()" plain="true" href="javascript:void(0)" >
						<span class="l-btn-left l-btn-icon-left">
						<span class="l-btn-text">Atras</span>
						<span class="l-btn-icon back"> </span>
						</span>
					</a>
					<a id="cmd_enviar" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="enviar()" plain="true" href="javascript:void(0)" >
						<span class="l-btn-left l-btn-icon-left">
						<span class="l-btn-text">Enviar</span>
						<span class="l-btn-icon player_fwd"> </span>
						</span>
					</a>
					<span class="l-btn-text">Seleccionar todo</span>
					<input type="checkbox" id="chk_ori_all" name="chk_ori_all" value="1" onchange="check_ori_all()" />
					<label  for="chk_ori_all" title="Seleccionar todo" ><span></span></label>
				</div>
				<div id="toolbar_ubicacion" class="datagrid-toolbar" style=" position:relative; ">Ubicacion:</div>
        		<div style="border:none;width:100%;height:700px;overflow:auto;">
					<div id="datos_contenido"></div>
				</div>
    		</div>
    		<div  style="border:1px solid #ccc;width:49%;height:750px;float:left;margin:2px;">
				<div id="toolbar_dest" class="datagrid-toolbar" style=" position:relative; ">
					<span class="l-btn-text">Destino</span>
					<a id="cmd_guardar_dest" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="guardar_dest()" plain="true" href="javascript:void(0)" >
						<span class="l-btn-left l-btn-icon-left">
						<span class="l-btn-text">Guardar</span>
						<span class="l-btn-icon guardar"> </span>
						</span>
					</a>
					<a id="cmd_atras" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="atras_dest()" plain="true" href="javascript:void(0)" >
						<span class="l-btn-left l-btn-icon-left">
						<span class="l-btn-text">Atras</span>
						<span class="l-btn-icon back"> </span>
						</span>
					</a>
					<a id="cmd_recibir" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="recibir()" plain="true" href="javascript:void(0)" >
						<span class="l-btn-left l-btn-icon-left">
						<span class="l-btn-text">Enviar</span>
						<span class="l-btn-icon player_rew"> </span>
						</span>
					</a>
					<span class="l-btn-text">Seleccionar todo</span>
					<input type="checkbox" id="chk_dest_all" name="chk_dest_all" value="1" onchange="check_dest_all()" />	
					<label  for="chk_dest_all" title="Seleccionar todo" ><span></span></label>
				</div>
				<div id="toolbar_ubicacion_dest" class="datagrid-toolbar" style=" position:relative; ">Ubicacion:</div>
        		<div style="border:none;width:100%;height:700px;overflow:auto;">
				<div id="datos_contenido_destino"><?php include('consulta_dest.php'); ?></div>
				</div>
    		</div>
	</div> 
    

