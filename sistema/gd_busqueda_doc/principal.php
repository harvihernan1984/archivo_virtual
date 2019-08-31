<script type="text/javascript">

		function editar_busqueda(id,contenedor){
		var op = $("#opcion_contenido").attr('value');
		$("#contenedor_documento").attr('value',contenedor);
		$("#accion_contenido").attr('value','ventana');
		$("#evento_contenido").attr('value','EDIT');
		$("#item_contenido").attr('value',id);
		MuestraForm(op);
	}
	function  registrar_consulta(url,idanexo){
		
		if(aux_guardar==false){
			aux_guardar=true;
			$("#item_anexo").attr('value',idanexo);
			$("#accion_windows").attr('value','guardar');
			$.ajax({ 
				type: 'POST',
				async: true, 
				data: $('#form_windows').serialize() + "&"+$('#frm_op').serialize(),
				url: "acciones_windows.php",  
				success: function(data) {  
					$('#sis_resultado').html(data);
					$("#div_cargar").css('visibility','hidden');
					window.open(url, '_blank');
					aux_guardar=false;
				}  
			});
		}
	}
</script>
<style type="text/css">
        #fm{
            margin:0;
            padding:10px 30px;
        }
        .ftitle{
            font-size:14px;
            font-weight:bold;
            padding:5px 0;
            margin-bottom:10px;
            border-bottom:1px solid #ccc;
        }
        .fitem{
            margin-bottom:5px;
        }
        .fitem label{
            display:inline-block;
            width:80px;
        }
        .fitem input{
            width:160px;
        }
</style>
	<div align="left" id="encabezad" >
		<div id="toolbar" class="datagrid-toolbar" style=" position:relative; ">
			<a id="cmd_nuevo" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="filtrar()" plain="true" href="javascript:void(0)" >
			<span class="l-btn-left l-btn-icon-left">
			<span class="l-btn-text">Buscar</span>
			<span class="l-btn-icon buscar2"> </span>
			</span>
			</a>
			<input type="hidden" id="contenedor_documento" name="contenedor_documento" />
			<input class="textbox" type="text" id="txt_buscar" name="txt_buscar" onKeyPress="BuscaEnter(event)"  />
			 <span class="l-btn-text">Tipo Documento:</span>
             <select id="tipo_documentos" name="tipo_documentos" style="width:100px;" onchange="filtrar_reg()">
             	<option value="-1" selected="selected">Todos</option>
           		  <?php $sql="select codigo,nombre from gd_tipo_documento order by nombre";
					$res=pg_query($conn,$sql);
					while ($reg=pg_fetch_array($res))
					{ ?> <option <?php if($reg["codigo"]==$rol) { echo "selected='selected'";}?> 
					 value="<?php echo $reg["codigo"];?>" ><?php echo $reg["nombre"];?> </option> 
					<?php } ?>
             </select>
             <span class="l-btn-text">Filtrar por:</span><span class="datagrid-toolbar" style=" position:relative; ">
             <select id="tipo_filtro" name="tipo_filtro">
               <option value="codificacion,origen,datos_documento" selected="selected">Todos</option>
               <option value="codificacion" >codificacion</option>
               <option value="origen" >origen</option>
               <option value="datos_documento" >datos_documento</option>
             </select>
             </span><span class="l-btn-text">Reg. presentados</span>
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
	</div>
	<div id="datos_contenido" >	
	
	</div> 



