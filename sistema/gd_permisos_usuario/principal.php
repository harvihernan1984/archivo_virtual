<script>
 function inicio(){
 	$("#txt_ubicaion").attr('value','');
	$("#txt_directorio").attr('value','');
	$('#region_center').panel({title:'Inicio'});
 	MuestraDatos_contenido();
 }
 function atras(){
 	$("#txt_ubicaion").attr('value','atras');
	$("#txt_tipo_contenedor").attr('value','');
	//$("#txt_directorio").attr('value','');
 	MuestraDatos_contenido();
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
 function editar_contenido(opcion,id){
 		$("#accion_contenido").attr('value','ventana');
		$("#evento_contenido").attr('value','EDIT');
		$("#opcion_contenido_windows").attr('value',opcion);
		$("#item_contenido").attr('value',id);
		MuestraForm(opcion);
 
 }
  function nuevo_contenido(){
 		$("#accion_contenido").attr('value','ventana');
		$("#evento_contenido").attr('value','NEW');
		$("#opcion_contenido_windows").attr('value',op);
		$("#item_contenido").attr('value','');
		MuestraForm(op);
 }
  function editar_documento(id){
 		$("#accion_contenido").attr('value','ventana');
		$("#evento_contenido").attr('value','EDIT');
		$("#opcion_contenido_windows").attr('value',op);
		$("#item_contenido").attr('value','');
		MuestraForm(op);
 
 }
function RefrescaDatos_contenido(){
	$("#txt_ubicaion").attr('value','refres');
	MuestraDatos_contenido();
}
</script>
	<div align="left" id="encabezad" >
		<div id="toolbar" class="datagrid-toolbar" style=" position:relative; ">
			<a id="cmd_inicio" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="inicio()" plain="true" href="javascript:void(0)" >
			<span class="l-btn-left l-btn-icon-left">
			<span class="l-btn-text">Inicio</span>
			<span class="l-btn-icon folderhome2"> </span>
			</span>
			</a>
			<a id="cmd_atras" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="atras()" plain="true" href="javascript:void(0)" >
			<span class="l-btn-left l-btn-icon-left">
			<span class="l-btn-text">Atras</span>
			<span class="l-btn-icon back"> </span>
			</span>
			</a>
			<a id="cmd_nuevo" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="nuevo_contenido()" plain="true" href="javascript:void(0)" >
			<span class="l-btn-left l-btn-icon-left">
			<span class="l-btn-text">Nuevo</span>
			<span class="l-btn-icon add"> </span>
			</span>
			</a>
			<input  type="hidden" id="txt_directorio" name="txt_directorio" value="" />
			<input  type="hidden" id="txt_nombre" name="txt_nombre" value="" />
			<input  type="hidden" id="txt_directorio_nombre" name="txt_directorio_nombre" value="" />
			<input  type="hidden" id="txt_ubicaion" name="txt_ubicaion" value="" />
			<input  type="hidden" id="txt_padre" name="txt_padre" value="" />
			<input  type="hidden" id="txt_actual" name="txt_actual" value="" />
			<input  type="hidden" id="txt_opcion" name="txt_opcion" value="" />
			<input  type="hidden" id="txt_tipo_contenedor" name="txt_tipo_contenedor" value="" />
			<span class="l-btn-text">Vista</span>
			<select id="tipo_vista" name="tipo_vista">
				<option value="ICONO">Iconos</option>
				<option value="LISTA">Lista</option>
			</select>
            <span id="gif_cargando" class="l-btn-icon cargando_mini"> </span>
		</div>
		<div id="toolbar_ubicacion" class="datagrid-toolbar" style=" position:relative; ">Ubicacion:</div>
	</div>
	<div id="datos_contenido" >	
	
	</div> 



