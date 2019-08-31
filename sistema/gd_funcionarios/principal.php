	<div align="left" id="encabezad" >
		<div id="toolbar" class="datagrid-toolbar" style=" position:relative; ">
			<a id="cmd_nuevo" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="nuevo()" plain="true" href="javascript:void(0)" >
			<span class="l-btn-left l-btn-icon-left">
			<span class="l-btn-text">Nuevo</span>
			<span class="l-btn-icon add"> </span>
			</span>
			</a>
			<a id="cmd_nuevo" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="filtrar()" plain="true" href="javascript:void(0)" >
			<span class="l-btn-left l-btn-icon-left">
			<span class="l-btn-text">Buscar</span>
			<span class="l-btn-icon buscar2"> </span>
			</span>
			</a>
			<input class="textbox" type="text" id="txt_buscar" name="txt_buscar" onKeyPress="BuscaEnter(event)"  />
			<span class="l-btn-text">Filtrar por:</span>
             <select id="tipo_filtro" name="tipo_filtro">
             	<option selected="selected">cedula,nombre,apellido,direccion</option>
                <option>cedula</option>
                <option>apellido</option>
				<option>nombre</option>
                <option>direccion</option>
             </select>
             <span class="l-btn-text">Registros :</span>
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



