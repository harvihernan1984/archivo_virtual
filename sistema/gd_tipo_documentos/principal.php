	<div align="left" id="encabezad" >
		<div id="toolbar" class="datagrid-toolbar" style=" position:relative; ">
        	<?php if(f_valida_acceso_rol('gd_tipo_documento',$conn)==true){ ?>
			<a id="cmd_nuevo" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="nuevo()" plain="true" href="javascript:void(0)" >
			<span class="l-btn-left l-btn-icon-left">
			<span class="l-btn-text">Nuevo</span>
			<span class="l-btn-icon add"> </span>
			</span>
			</a>
        	<?php } // fin if(f_valida_acceso_rol('gd_tipo_contenedor',$conn)==true){ ?>
			<a id="cmd_nuevo" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="filtrar()" plain="true" href="javascript:void(0)" >
			<span class="l-btn-left l-btn-icon-left">
			<span class="l-btn-text">Buscar</span>
			<span class="l-btn-icon buscar2"> </span>
			</span>
			</a>
			<input class="textbox" type="text" id="txt_buscar" name="txt_buscar" onKeyPress="BuscaEnter(event)"  />
             <span class="l-btn-text">Filtrar por:</span>
             <select id="tipo_filtro" name="tipo_filtro">
             	<option selected="selected">nombre</option>
             </select>
             <span class="l-btn-text">Reg. presentados</span>
             <select id="limite_reg" name="limite_reg" onchange="filtrar()">
             	<option selected="selected" value="LIMIT 100">100 (recomendado)</option>
                <option value="LIMIT 500">500</option>
                <option value="LIMIT 1000">1000</option>
                <option value=" ">TODO</option>
             </select>
             <span id="gif_cargando" class="l-btn-icon cargando_mini"> </span>
		</div>
	</div>
	<div id="datos_contenido" >	
	
	</div> 



