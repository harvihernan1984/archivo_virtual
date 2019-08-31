<script type="text/javascript">

		function formatProgress(value){
	    	if (value){
		    	var s = '<div style="width:100%;border:1px solid #ccc">' +
		    			'<div style="width:' + value + '%;background:#cc0000;color:#fff">' + value + '%' + '</div>'
		    			'</div>';
		    	return s;
	    	} else {
		    	return '';
	    	}
		}
		var editingId;
		function edit(){
			if (editingId != undefined){
				$('#tg').treegrid('select', editingId);
				return;
			}
			var row = $('#tg').treegrid('getSelected');
			if (row){
				editingId = row.id
				$('#tg').treegrid('beginEdit', editingId);
			}
		}
		function save(){
			if (editingId != undefined){
				var t = $('#tg');
				t.treegrid('endEdit', editingId);
				editingId = undefined;
				var persons = 0;
				var rows = t.treegrid('getChildren');
				for(var i=0; i<rows.length; i++){
					var p = parseInt(rows[i].persons);
					if (!isNaN(p)){
						persons += p;
					}
				}
				var frow = t.treegrid('getFooterRows')[0];
				frow.persons = persons;
				t.treegrid('reloadFooter');
			}
		}
		function cancel(){
			if (editingId != undefined){
				$('#tg').treegrid('cancelEdit', editingId);
				editingId = undefined;
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
        	<?php if(f_valida_acceso_rol('gd_tipo_contenedor',$conn)==true){ ?>
			<a id="cmd_nuevo" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="nuevo()" plain="true" href="javascript:void(0)" >
			<span class="l-btn-left l-btn-icon-left">
			<span class="l-btn-text">Nuevo</span>
			<span class="l-btn-icon add"> </span>
			</span>
			</a>
        	<?php } //FIN if(f_valida_acceso_rol('gd_tipo_contenedor',$conn)==true) ?>
			<a id="cmd_nuevo" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onclick="filtrar()" plain="true" href="javascript:void(0)" >
			<span class="l-btn-left l-btn-icon-left">
			<span class="l-btn-text">Buscar</span>
			<span class="l-btn-icon buscar2"> </span>
			</span>
			</a>
			<input class="textbox" type="text" id="txt_buscar" name="txt_buscar" onKeyPress="BuscaEnter(event)"  />
             <span class="l-btn-text">Filtrar por:</span>
             <select id="tipo_filtro" name="tipo_filtro">
             	<option selected="selected">codigo,nombre</option>
                <option>codigo</option>
               	<option>nombre</option>
             </select>
             <span class="l-btn-text">Reg. presentados</span>
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



