<script type="text/javascript">

		function editar_busqueda(id,contenedor){
		var op = $("#opcion_contenido").attr('value');
		$("#contenedor_documento").attr('value',contenedor);
		$("#accion_contenido").attr('value','ventana');
		$("#evento_contenido").attr('value','EDIT');
		$("#item_contenido").attr('value',id);
		MuestraForm(op);
	}
	function exportar(){
		$("#accion_contenido").attr('value','exportar_excel');
		
		$("#gif_cargando").css('visibility','visible');
		$.ajax({ 
				type: 'POST',
				async: true, 
				data: $('#form_windows_center').serialize(),
				url: "datos_contenido.php",  
				success: function(data) { 
					$('#sis_resultado').html(data);
					//setInterval(function () {validar_obj('form_windows_center');}, 3000);
					$("#gif_cargando").css('visibility','hidden');
				}  
		});
		
	}
	function exportar_pdf(){
		$("#accion_contenido").attr('value','exportar_pdf');
		
		$("#gif_cargando").css('visibility','visible');
		$.ajax({ 
				type: 'POST',
				async: true, 
				data: $('#form_windows_center').serialize(),
				url: "datos_contenido.php",  
				success: function(data) { 
					$('#sis_resultado').html(data);
					//setInterval(function () {validar_obj('form_windows_center');}, 3000);
					$("#gif_cargando").css('visibility','hidden');
				}  
		});
		
	}
	function res_busca_folder(id){
		$("#gif_cargando").css('visibility','visible');
		$("#accion_contenido").attr('value','selec_directorio'); 
		$.ajax({ 
				type: 'POST',
				async: false, 
				data: $('#form_windows_center').serialize(),
				url: "datos_contenido.php?op=directorio&codigo="+id,  
				success: function(data) {  
					$('#sis_resultado').html(data);
					cerrar_busqueda(); 
					$("#gif_cargando").css('visibility','hidden');
				}  
		});

	}
	function limpia_folder(){
    	$('#name_folder').attr('value','');
    	$('#codigo_folder').attr('value','');
    }
</script>
	<input type="hidden" id="opcion_windows" name="opcion_windows" value=""/>
	<input type="hidden" id="accion_windows" name="accion_windows" value=""/>
	<div align="left" id="encabezad" >
		<div id="toolbar" class="datagrid-toolbar" style=" position:relative; ">
			<a id="cmd_excel" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="exportar()" plain="true" href="javascript:void(0)" >
			<span class="l-btn-left l-btn-icon-left">
			<span class="l-btn-text">EXCEL</span>
			<span class="l-btn-icon excel"> </span>
			</span>
			</a>
			<a id="cmd_pdf" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="exportar_pdf()" plain="true" href="javascript:void(0)" >
			<span class="l-btn-left l-btn-icon-left">
			<span class="l-btn-text">PDF</span>
			<span class="l-btn-icon pdf"> </span>
			</span>
			</a>
			<a id="cmd_procesar" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="filtrar()" plain="true" href="javascript:void(0)" >
			<span class="l-btn-left l-btn-icon-left">
			<span class="l-btn-text">procesar</span>
			<span class="l-btn-icon app_kservices"> </span>
			</span>
			</a>
			<span class="l-btn-text">Opciones  :</span>
			<select id="opcion_informe" name="opcion_informe" style="width:300px;" onchange="filtrar_reg()">
             	<option value="-1" selected="selected">--Seleccione--</option>conxempafecha
				<option value="con_inv_2017" >Inventario desde el 2017</option>
				<option value="con_inv_2017afecha">Inventario desde el 2017 a fecha</option>
				<!--<option value="conxempentrefecha" >Por Empresas Seleccionadas entre fechas</option>-->
             </select>
			 <span class="l-btn-text">De</span>
			 <input  type="text" name="fecha_filtro_ini" id="fecha_filtro_ini"  style="width:80px;" />
			 <span class="l-btn-text"> a </span>
			 <input  type="text" name="fecha_filtro_fin" id="fecha_filtro_fin"  style="width:80px;" />
             <span class="l-btn-text">Reg.</span>
             <select id="limite_reg" name="limite_reg" onchange="filtrar_reg()">
             	<option selected="selected" value="10">10</option>
                <option value="50">50</option>
                <option value="100">100</option>
             </select>
			 <a id="cmd_nuevo" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="pagina_previa()" plain="true" href="javascript:void(0)" >
					<span class="l-btn-text"><</span>
			 </a>
			 <a id="cmd_nuevo" class="easyui-linkbutton l-btn l-btn-small l-btn-plain"  href="javascript:void(0)" >
						<span  id="txt_paginas" class="l-btn-text"> 0 de 10 </span>
			 </a>
			 <a id="cmd_nuevo" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="pagina_siguiente()" plain="true" href="javascript:void(0)" >
						<span class="l-btn-text">></span>
			 </a>
			 <input  type="hidden"  id="txt_total_pagina" name="txt_total_pagina" value="1" />
			 <input  type="hidden"  id="txt_pagina_act" name="txt_pagina_act" value="1" />
             <span id="gif_cargando" class="l-btn-icon cargando_mini"> </span>
		</div>
		<div id="toolbar" class="datagrid-toolbar" style=" position:relative; ">
		 	<span class="l-btn-text">Empresas :</span>
			<select id="empresa" name="empresa" style="width:100px;" onchange="filtrar_reg()">
             	<option value="-1" selected="selected">Todas</option>
           		  <?php $sql="select codigo,nombre from gd_empresa where borrado='N' and codigo in(select cod from sis_accesos_rol_usuario ('".$_SESSION["gd_usuario"]."','gd_empresa_inf','')) order by nombre";
					$res=pg_query($conn,$sql);
					while ($reg=pg_fetch_array($res))
					{ ?> <option <?php if($reg["codigo"]==$rol) { echo "selected='selected'";}?> 
					 value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> 
					<?php } ?>
             </select>
			 <span class="l-btn-text">Tipo Documento :</span>
			<select id="tipo_documentos" name="tipo_documentos" style="width:100px;" onchange="filtrar_reg()">
             	<option value="-1" selected="selected">Todos</option>
           		  <?php $sql="select codigo,nombre from gd_tipo_documento order by nombre";
					$res=pg_query($conn,$sql);
					while ($reg=pg_fetch_array($res))
					{ ?> <option <?php if($reg["codigo"]==$rol) { echo "selected='selected'";}?> 
					 value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> 
					<?php } ?>
             </select>
        	<span class="l-btn-text">Folder :</span>
        	
        	<input  type="text" name="name_folder" id="name_folder" disabled="disabled"  style="width:300px;" />
        	<input  type="hidden" name="codigo_folder" id="codigo_folder" />
			<a id="cmd_buscar_folder" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onClick="abrir_busqueda_contenido('directorio')" plain="true" href="javascript:void(0)" >
			<span class="l-btn-left l-btn-icon-left">
			<span class="l-btn-text">Buscar folder</span>
			<span class="l-btn-icon buscar2"> </span>
			</span>
			</a>
        	<a id="cmd_limpiar" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onClick="limpia_folder()" plain="true" href="javascript:void(0)" >
			<span class="l-btn-left l-btn-icon-left">
			<span class="l-btn-text">Limpiar folder</span>
			<span class="l-btn-icon action_reload"> </span>
			</span>
            </a>
		</div>
	</div>
	<div id="datos_contenido" >	
	
	</div> 



