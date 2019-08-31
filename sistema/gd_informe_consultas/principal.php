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
</script>

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
				<option value="conxemp" >Por Empresas Seleccionadas</option>
				<option value="conxempafecha" >Por Empresas Seleccionadas a fecha</option>
				<option value="conxempentrefecha" >Por Empresas Seleccionadas entre fechas</option>
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
						<span  id="txt_paginas" class="l-btn-text"> 0 de 10</span>
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
			<select id="empresa" name="empresa" style="width:300px;" onchange="filtrar_reg()">
             	<option value="-1" selected="selected">Todas</option>
           		  <?php $sql="select codigo,nombre from gd_empresa where borrado='N' and codigo in(select cod from sis_accesos_rol_usuario ('".$_SESSION["gd_usuario"]."','gd_empresa_inf','')) order by nombre";
					$res=pg_query($conn,$sql);
					while ($reg=pg_fetch_array($res))
					{ ?> <option <?php if($reg["codigo"]==$rol) { echo "selected='selected'";}?> 
					 value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> 
					<?php } ?>
             </select>
		</div>
	</div>
	<div id="datos_contenido" >	
	
	</div> 



