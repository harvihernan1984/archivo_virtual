<?php include("./conexion.php"); ?>
<!DOCTYPE html>
<html>
<head>
	<meta charset="UTF-8">
	<title>CZ4-Archivo-Virtual</title>
	<link rel="stylesheet" type="text/css" href="themes/default/easyui.css">
	<link rel="stylesheet" type="text/css" href="themes/default/datagrid.css">
	<link rel="stylesheet" type="text/css" href="themes/default/validatebox.css">
	
	<link rel="stylesheet" type="text/css" href="themes/icon.css">
	<link rel="stylesheet" type="text/css" href="themes/demo.css">
	<link rel="stylesheet" type="text/css" href="img/iconos_modulo.css">
	<link href="css/check.css" rel="stylesheet" type="text/css" />
	<!--<script type="text/javascript" src="js/easyloader.js"></script>-->
	<script type="text/javascript" src="js/jquery.min.js"></script>
	<script type="text/javascript" src="js/jquery.easyui.min.js"></script>
<!--	//yooooooooooooooooooooo-->
<link  href="css/jquery-ui-1.8.6.css" rel="Stylesheet" />
<link  href="css/datos_form.css" rel="Stylesheet" />
<!--<link  rel="stylesheet" href="css/base/jquery.ui.all.css">-->
<script src="js/jquery_browser.js"></script>
<script src="js/jquery.ui.core.dtpk.js"></script>
<script src="js/jquery.ui.datepicker-es.js"></script>
<script src="js/jquery.ui.datepicker.js"></script>
<script src="js/funciones.js"></script>

	
	

<script>
	//// FUNCIONES PARA VENTANAS 
var guardando=false; //variable que idenfica si se esta realizando un proceso de almacenado
	function MuestraForm(op){
		$("#opcion_windows").attr('value',op);
    	var ref=$("#ref_contenido").attr('value');
		$("#accion_windows").attr('value','ventana');
		$.ajax({ 
				type: 'POST',
				async: true, 
				data: $('#form_windows_center').serialize(),
				url: "open_windows.php",  
				success: function(data) { 
					$('#principal_windows').html(data);
					var alto_win=$("#alto_windows").attr('value');
					var ancho_win=$("#ancho_windows").attr('value');
					$('#principal_windows').window({
							title:ref,
							width:ancho_win,
    						height:alto_win,
    						modal:true
					});			
					$('#principal_windows').window('open');
					MuestraDatos(op);
					
				}  
		});
	}
	function MuestraFormAccion(op,ac){
		$("#opcion_windows").attr('value',op);
    	var ref=$("#ref_contenido").attr('value');
		$("#accion_windows").attr('value','ventana');
		$.ajax({ 
				type: 'POST',
				async: true, 
				data: $('#form_windows_center').serialize(),
				url: "open_windows.php",  
				success: function(data) { 
					$('#principal_windows').html(data);
					var alto_win=$("#alto_windows").attr('value');
					var ancho_win=$("#ancho_windows").attr('value');
					$('#principal_windows').window({
							title:ref,
							width:ancho_win,
    						height:alto_win,
    						modal:true
					});			
					$('#principal_windows').window('open');
					MuestraDatosAccion(op,ac);
					
				}  
		});
	}
	function MuestraForm2(op){
		$("#opcion_windows").attr('value',op);
		$("#accion_windows").attr('value','ventana');
	}
	function MuestraDatos(op){
		$("#opcion_windows").attr('value',op);
		$("#accion_windows").attr('value','item');
		$.ajax({ 
				type: 'POST',
				async: true, 
				data: $('#form_windows').serialize()+ "&"+$('#form_windows_center').serialize(),
				url: "datos_windows.php",  
				success: function(data) { 
					$('#datos').html(data);
					//setInterval(function () {validar_obj('form_windows');}, 3000);
				}  
		});
	}
	function MuestraDatosAccion(op,ac){
		$("#opcion_windows").attr('value',op);
		$("#accion_windows").attr('value',ac);
		$.ajax({ 
				type: 'POST',
				async: true, 
				data: $('#form_windows').serialize()+ "&"+$('#form_windows_center').serialize(),
				url: "datos_windows.php",  
				success: function(data) { 
					$('#datos').html(data);
					//setInterval(function () {validar_obj('form_windows');}, 3000);
				}  
		});
	}
   function mensaje(txt){
		$.messager.show({title:'Mensaje del Sistema', width: 400, height: 'auto',	msg:txt});
		//$.messager.show('Mensaje del Sistema',txt,'info');
//		$('#dlg_mensaje').html(txt);
	//	$('#dlg').dialog('open');
	}
	
	///// FUNCIONES PARA CONTENIDO
	function Muestrac_Contenido_principal(op,ref){
		$("#opcion_contenido").attr('value',op);
		$("#opcion_contenido_windows").attr('value','');
		$("#accion_contenido").attr('value','principal');
    	$("#ref_contenido").attr('value',ref);
		$('#region_center').panel({title:ref});
		$.ajax({ 
				type: 'POST',
				async: true, 
				data: $('#form_windows_center').serialize(),
				url: "open_contenido.php",  
				success: function(data) { 
					$('#div_seccion_central').html(data);
					MuestraDatos_contenido();
				}  
		});
	}
	function MuestraDatos_contenido(){
		$("#accion_contenido").attr('value','consulta');
		$("#gif_cargando").css('visibility','visible');
		$.ajax({ 
				type: 'POST',
				async: true, 
				data: $('#form_windows_center').serialize(),
				url: "datos_contenido.php",  
				success: function(data) { 
					$('#datos_contenido').html(data);
					//setInterval(function () {validar_obj('form_windows_center');}, 3000);
					$("#gif_cargando").css('visibility','hidden');
				}  
		});
	}
	function MuestraDatos_contenido_dir(dest,div){
		$("#accion_contenido").attr('value',dest);
		$("#gif_cargando").css('visibility','visible');
		$.ajax({ 
				type: 'POST',
				async: true, 
				data: $('#form_windows_center').serialize(),
				url: "datos_contenido.php",  
				success: function(data) { 
					$('#'+div).html(data);
					//setInterval(function () {validar_obj('form_windows_center');}, 3000);
					$("#gif_cargando").css('visibility','hidden');
				}  
		});
	}
</script>
<script>
//funciones de paginado
function  pagina_previa(){
	var pg_act=new Number($("#txt_pagina_act").attr('value'));
	if( pg_act>1){
		pg_act	= pg_act -1;
		$("#txt_pagina_act").val(pg_act);
		filtrar();
	}
}
function  pagina_siguiente(){
	var pg_act=new Number($("#txt_pagina_act").attr('value'));
	var pg_total=new Number($("#txt_total_pagina").attr('value'));
	if( pg_act<pg_total){
		pg_act	= pg_act  + 1;
		$("#txt_pagina_act").val(pg_act);
		filtrar();
	}
}

</script>
<!--FUNCIONES PARA FORMULARIO DE BUSQUEDA-->
<script>
	  function  abrir_busqueda(op){
		$("#accion_windows").attr('value','buscar'); 
		$('#dlg_buscar').window('open');
		$('#filtro_busca').attr('value','');
		$("#op_filtro_busca").attr('value',op);
		$("#gif_cargando_busqueda").css('visibility','visible');
		$.ajax({ 
				type: 'POST',
				async: true, 
				data: $('#form_windows_center').serialize() + "&"+$('#form_windows').serialize(),
				url: "datos_windows.php?op="+op,  
				success: function(data) { 
					$('#datos_busqueda').html(data);
					//filtrar_busqueda();
					$("#gif_cargando_busqueda").css('visibility','hidden');
					//setInterval(function () {validar_obj('form_windows');}, 3000);
				}  
		});
	}
	function  abrir_busqueda_contenido(op){
		$("#accion_contenido").attr('value','buscar'); 
    	$("#accion_windows").attr('value','buscar');
    	$("#opcion_windows").attr('value',$("#opcion_contenido").attr('value'));
		$('#dlg_buscar').window('open');
		$('#filtro_busca').attr('value','');
		$("#op_filtro_busca").attr('value',op);
		$("#gif_cargando_busqueda").css('visibility','visible');
		$.ajax({ 
				type: 'POST',
				async: true, 
				data: $('#form_windows_center').serialize(),
				url: "datos_contenido.php?op="+op,  
				success: function(data) { 
					$('#datos_busqueda').html(data);
					//filtrar_busqueda();
					$("#gif_cargando_busqueda").css('visibility','hidden');
					//setInterval(function () {validar_obj('form_windows');}, 3000);
				}  
		});
	}
	
	function filtrar_busqueda(){
		$("#gif_cargando_busqueda").css('visibility','visible');
		$("#accion_windows").attr('value','buscar'); 
		//var txt_busca = $('#filtro_busca').attr('value');
		//alert(txt_busca);
		var datos= $('#form_windows_center').serialize() + "&"+$('#form_windows').serialize() + "&"+$('#form_windows_buscar').serialize();
		$.ajax({ 
				type: 'POST',
				async: true, 
				data: datos,
				url: "datos_windows.php",  
				success: function(data) { 
					$('#datos_busqueda').html(data);
					$("#gif_cargando_busqueda").css('visibility','hidden');
					//setInterval(function () {validar_obj('form_windows');}, 3000);
				}  
		});
	}
	function cerrar_busqueda(){
		$('#dlg_buscar').window('close');
    	$('#filtro_busca').val(''); 
    	$('#datos_busqueda').html('');
	}
	function FiltroEnter(evt){
		//asignamos el valor de la tecla a keynum
		if ( $("#txt_pagina_act").length ) {
  				//alert('');
				$('#txt_pagina_act').attr('value',1);
			}
		if(window.event){// IE
			keynum = evt.keyCode;
		}else{
			keynum = evt.which;
			keychar=evt.keyCode;
		}
		//comprobamos si se encuentra en el rango
		if(keynum==13){
			filtrar_busqueda();
		}
	}
</script>
<!--FUNCIONES PARA CARGAR COMBOS-->
<script>
	function carga_combo(id,vector){
	 $("#accion_windows").attr('value','selec');
	 //for(i=0;i<vector.length;i++){
	 if(vector.length>0){
			MuestraDatosCombo(id,vector);
		}
	}
	function MuestraDatosCombo(padre,hijo){
		$("#div_cargar").css('visibility','visible');
		var vector = new Array();
		for(i=1;i<hijo.length;i++){vector[i-1]=hijo[i];}
		$.ajax({ 
				type: 'POST',
				async: true, 
				data: $('#form_windows').serialize(),
				url: "datos_windows.php?op="+padre+"&hijo="+hijo[0],  
				success: function(data) { 
					$('#div'+hijo[0]).html(data);
					$("#div_cargar").css('visibility','hidden');
					if(vector.length> 0){carga_combo(padre,vector);}
				}
			});
	}
	function auto_select(obj_ori,obj_new){
		$("#"+obj_ori+" select").each(function (index) {
				var val_atc=$(this).val();
				var obj_atc=$(this).attr("id");
				$("#"+obj_new+" select").each(function (index) {
					if($(this).attr("id")==obj_atc){
						$(this).val(val_atc);
					}
				});
				
 		});	


	}
</script>
<!--FUNCIONES PARA CARGAR COMBOS-->
<script>
var aux_guardar=false;
function validar_obj_form(obj){
		var resul=0;
		$("#"+obj+" input").each(function (index) { // aqui estan los numeros de cedula	
        	if($(this).attr('id')!=null){
        		if($(this).attr('required')=='required'){if($(this).val()==''){resul++;$(this).addClass("texto_invalido");}}
				if($(this).hasClass("txtdate")==true){ // input para fechas
                	var d = $(this).val();
                    if(valida_fechaddmmyyyy(d)==false){resul++;$(this).addClass("texto_invalido");}
             	}
            	if($(this).hasClass("txtmail")){ // input para textos minuscula
                	var d = $(this).val();
            		if(valida_mail_basico(d)==false){resul++;$(this).addClass("texto_invalido");}
                }
            	if($(this).hasClass("txttelefono")){ // input para textos minuscula
                	var d = $(this).val();
            		if(valida_num_telefono(d)==false){resul++;$(this).addClass("texto_invalido");}
                }
			}//FIN if($(this).attr('id')!=null){
       	});
		if(resul==0){return true;}
		else{ return false;}
	}

                 
function nuevo(){
		var op = $("#opcion_contenido").attr('value');
		$("#accion_contenido").attr('value','ventana');
		$("#evento_contenido").attr('value','NEW');
		MuestraForm(op);
	}
function guardar(){
		if(aux_guardar==false){
        	//alert(validar_obj_form('form_windows'));
			if(validar_obj_form('form_windows')==false || validar_obj_form('form_windows_center')==false){
            	mensaje('Existen campos que no estan correctamente ingresados<br>Por favor corrijalos para continuar...'); 
            	return false;
            }
        	aux_guardar=true;
			$("#accion_windows").attr('value','guardar');
			$.ajax({ 
					type: 'POST',
					async: true, 
					data: $('#form_windows').serialize() + "&"+$('#form_windows_center').serialize(),
					url: "acciones_windows.php",  
					success: function(data) { 
						$('#sis_resultado').html(data);
						aux_guardar=false;
					}  
			});
		}else{mensaje('Se esta ejecutando un proceso...<br> Espere un momento por favor... ');}
	}
	function editar(id){
		var op = $("#opcion_contenido").attr('value');
		$("#accion_contenido").attr('value','ventana');
		$("#evento_contenido").attr('value','EDIT');
		$("#item_contenido").attr('value',id);
		MuestraForm(op);
	}
	function filtrar(){
		MuestraDatos_contenido();
	}
	function filtrar_reg(){
		if ( $("#txt_pagina_act").length ) {
  				// hacer algo aqu si el elemento existe
				$('#txt_pagina_act').attr('value',1);
		}
		MuestraDatos_contenido();
	}
	function BuscaEnter(evt){
		//asignamos el valor de la tecla a keynum
		if ( $("#txt_pagina_act").length ) {
  				// hacer algo aqu si el elemento existe
				$('#txt_pagina_act').attr('value',1);
		}
		if(window.event){// IE
			keynum = evt.keyCode;
		}else{
			keynum = evt.which;
			keychar=evt.keyCode;
		}
		//comprobamos si se encuentra en el rango
		if(keynum==13){
			filtrar();
		}
	}
</script>
<script>
var px=0;
var py=0;
var poc="";
var form_act="";
$(document)
.focusin(function(e){
 	if(e.target.id!=null){
		if(e.target.id.indexOf("fecha")!=-1){
			$("#"+e.target.id).datepicker({dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true, yearRange: '-100:+10'});
        	//$("#"+e.target.id).mask("99/99/9999");
        	//$("#"+e.target.id).addClass("simple-field-data-mask-selectonfocus");
        	$("#"+e.target.id).keypress(function(e) { return solofecha(e) ;});
			if($("#"+e.target.id).val()!=''){$("#"+e.target.id).removeClass("texto_invalido");}
		}
    	if($("#"+e.target.id).hasClass("txtnumero")){$("#"+e.target.id).keypress(function(e) { return soloInt(e);});}
    	if($("#"+e.target.id).hasClass("txttelefono")){$("#"+e.target.id).keypress(function(e) { return soloInt(e);});}
    	if($("#"+e.target.id).hasClass("txtcedula")){$("#"+e.target.id).keypress(function(e) { return soloInt(e);});}
    	if($("#"+e.target.id).hasClass("txtruc")){$("#"+e.target.id).keypress(function(e) { return soloInt(e);});}
    	if($("#"+e.target.id).hasClass("txtruc")){$("#"+e.target.id).blur(function() { cal_cedula_ruc(e.target.id,'PP');});}	
    	if($("#"+e.target.id).hasClass("txtcedula")){$("#"+e.target.id).blur(function() { cal_cedula_ruc(e.target.id,'PN');});}
    	if($("#"+e.target.id).hasClass("txttextonomb")){$("#"+e.target.id).keypress(function(e) { return soloNombres(e);});}
    	if($("#"+e.target.id).hasClass("txttextonomb")){$("#"+e.target.id).blur(function() { u_case(e.target.id);});}
		if($("#"+e.target.id).hasClass("txttextoma")){$("#"+e.target.id).blur(function() { u_case(e.target.id);});}
    	if($("#"+e.target.id).hasClass("txttextomi")){$("#"+e.target.id).blur(function() { l_case(e.target.id);});}
    	if($("#"+e.target.id).hasClass("txtmail")){$("#"+e.target.id).blur(function() { l_case(e.target.id);});}
	}
 })
.focusout(function(e){
 	if(e.target.id!=null){
		if(e.target.id.indexOf("fecha")!=-1){
			$("#"+e.target.id).datepicker({dateFormat: 'dd/mm/yy', changeMonth: true, changeYear: true, yearRange: '-100:+10'});
			if($("#"+e.target.id).attr('required')=='required'){
        		if($("#"+e.target.id).val()==''){$("#"+e.target.id).addClass("texto_invalido");}
            }
		}
		if($("#"+e.target.id).attr('required')=='required'){	
				if($("#"+e.target.id).val()==''){$("#"+e.target.id).addClass("texto_invalido");}
    			else{$("#"+e.target.id).removeClass("texto_invalido");}
    	}
	}
 });
 $(document).ready(function() {
    $("form").keypress(function(e) {
        if (e.which == 13) {return false; }	 
    });
	 $("#frm").resizable(); 	
}).keypress(function(e) {
 	 if(e.which==39){return false;} //anulamos apostrofe
	 //if(e.which==47){return false;} //anulamos eslas /
	 if(e.which==92){return false;} //anulamos eslas \
 	 //if($("#"+e.target.id).is("input[type=tel]")){$("#"+e.target.id).keypress(function(e) { return soloInt(e);});}
});

</script>
<script >
     // function anular(e) {
      //    tecla = (document.all) ? e.keyCode : e.which;
      //    return (tecla != 13);
     //} */
</script>
<style>
a:link   
{   
 text-decoration:none;   
} 
.form-login-heading {
			font:30px 'Myriad Pro',sans-serif;
			color:#6699FF;
			margin: 0;
			left:0;
		}
</style>
</head>
<body class="easyui-layout" style="width:100%;height:100%;">

	<div data-options="region:'north',border:false" style="height:70px;background:#FFFFFF;padding:10px">
		<div align="center" style="position:fixed; top:2px; left:0; margin-left:5px; color:#AAAAAA;">
        	<a href="http://www.salud.gob.ec/" target="_blank" title="Pagina del MSP" >
       	<img src="img/LOGO_msp.png" width="70" height="60" border="0"/>
        	</a>        
		</div>
		<h2 class="form-login-cabecera" style="margin-left: 70px;margin-bottom:0px;">Sistema de Inventario Documental</h2>
    	<h3 class="form-login-cabecera" style="margin-left: 70px;margin-bottom:0px;margin-top:-3px;"><?php  echo "Usuario: ".$_SESSION["nombre_usuario"]." Empresa: ".$_SESSION["gd_nombre_empresa_act"]; ?></h3>
    	<h3 class="form-login-cabecera" style="margin-left: 70px;margin-bottom:0px;margin-top:0px;"><?php echo "Roll: ".$_SESSION["gd_rol_usuario"]; ?></h3>
    
		<div align="center" style=" position:fixed; top:4px;  right:0; margin-right:10px; color:#AAAAAA;">
        	<a href="salir.php" title="Salir del Sistema" >
       	<img src="img/botones/salir.png" width="48" height="48" border="0"/>
        	</a>        
		</div>
		<div align="center" style=" position:fixed; top:4px;  right:0; margin-right:65px; color:#AAAAAA;">
        	<a href="javascript:void(0)" title="Cambiar Clave" onClick="Muestrac_Contenido_principal('gd_cambiar_clave','Cambiar Clave');"  >
       	<img src="img/botones/clave.png" width="48" height="48" border="0"/>
        	</a>        
		</div>
		
	</div>
	<div data-options="region:'west',split:true,title:'Menu'" style="width:200px;padding:10px;">
<!--	inicio menu-->
	<!--<div class="easyui-panel" style="padding:0px">-->
		<!--<ul class="easyui-tree" data-options="url:'menu/menu.php',method:'get',animate:true"></ul>-->
	<!--</div>-->
<!--	fin de menu-->
	<?php $sql="SELECT * from sis_genera_menu('".$_SESSION["gd_rol"]."','-1',0,'".$directorio."')"; ?>
	<ul id="tt" class="easyui-tree">
        <?php 
			$res=pg_query($conn,$sql);
			while ($reg=pg_fetch_array($res))
			{ echo $reg["res"]; } 
			?>
	</ul>	
	</div>
	<div data-options="region:'east',split:true,collapsed:true,title:'Opciones'" style="width:100px;padding:10px;">
		
		
	</div>
	<div id="dlg" class="easyui-dialog" title="Mensaje del Sistema" data-options="modal:true,iconCls:'icon-save',closed:true" style="width:400px;height:200px;padding:10px">
		<div id="dlg_mensaje"></div>
	</div>
	
	<div data-options="region:'south',border:false" style="height:30px;background:#CCCCCC;padding:10px;">Sistema  desarrollado por Hernan Veliz.</div>
	<div id="region_center" data-options="region:'center',title:'Center'" style="background-image:url(img/logo_inventario.jpg); background-repeat: no-repeat;background-position: bottom right;  ">
	
		<form id="form_windows_center" name="form_windows_center">
		<input type="hidden" id="opcion_contenido" name="opcion_contenido" value=""/>
		<input type="hidden" id="opcion_contenido_windows" name="opcion_contenido_windows" value=""/>
		<input type="hidden" id="accion_contenido" name="accion_contenido" value=""/>
        <input type="hidden" id="evento_contenido" name="evento_contenido" value=""/>
        <input type="hidden" id="item_contenido" name="item_contenido" value=""/>
        <input type="hidden" id="ref_contenido" name="ref_contenido" value=""/>
		<input type="hidden" id="op_filtro_busca" name="op_filtro_busca"  />
		<div id="div_seccion_central" >		
		</div>
        <div id="sis_resultado">
		
		</div>
		
		</form>
       
		<div id="prueba_ventana"></div>
		<div id="principal_windows" class="easyui-window" title="Ventana" data-options="modal:true,iconCls:'icon-save',closed:true" style="width:500px;height:200px;padding:10px;"><strong></strong>
		</div>
		 
		<div id="dlg_buscar" class="easyui-window" title="Buscar" data-options="modal:true,iconCls:'icon-save',minimizable:false,closed:true" 
		style="width:700px;height:400px;padding:10px">
					<div align="left" id="encabezad" >
						<form id="form_windows_buscar" name="form_windows_buscar"  >
						<div id="toolbar" class="datagrid-toolbar" style=" position:relative; ">
							<a id="cmd_nuevo" class="easyui-linkbutton l-btn l-btn-small l-btn-plain" onClick="filtrar_busqueda()" plain="true" href="javascript:void(0)" >
							<span class="l-btn-left l-btn-icon-left">
								<span class="l-btn-text">Buscar</span>
								<span class="l-btn-icon buscar2"></span>
							</span>
							</a>
							<input type="text"  id="filtro_busca" name="filtro_busca" style=" width:70%; "  onKeyPress="FiltroEnter(event)"  value="" />
							<span id="gif_cargando_busqueda" class="l-btn-icon cargando_mini"> </span>
						</div>
						</form>
					</div>
					<div id="datos_busqueda" >	
					</div> 

		</div>
		
	</div>

</body>
</html>
